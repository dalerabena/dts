<?php

namespace App\Http\Controllers;

use App\Document;
use App\DocumentAttachment;
use App\RefPriority;
use App\User;
use App\History;
use Illuminate\Http\Request;
use Auth;
use DB;
use Hashids;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $documents = Document::when(isset($request->reference_number), function($query) use($request) {
                        $query->where('reference_number', 'like', '%' . $request->reference_number . '%');
                    })->when(isset($request->subject), function($query) use($request) {
                        $query->where('subject', 'like', '%' . $request->subject . '%');
                    })->when(isset($request->date_created), function($query) use($request) {
                        $query->where('created_at', 'like', '%' . $request->date_created . '%');
                    })->when(isset($request->priority), function($query) use($request) {
                        $query->where('priority', '=', $request->priority);
                    })->when(isset($request->status), function($query) use($request) {
                        $query->where('status', '=', $request->status);
                    })->get();

        $priorities = RefPriority::all()->pluck('desc', 'id');
        $status = [
            0 => 'Open',
            1 => 'Closed'
        ];

        $arr = [
            'documents' => $documents,
            'priorities' => $priorities,
            'status' => $status
        ];

        return view('documents.index', $arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $priorities = RefPriority::all()->pluck('desc', 'id');
        $users = User::all()->pluck('name', 'id');

        $arr = [
            'priorities' => $priorities,
            'users' => $users
        ];

        return view('documents.create', $arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validation = $this->validate($request, [
            'reference_number' => 'required',
            'subject' => 'required',
            'details' => 'required',
            'priority' => 'required',
            'comments' => 'required',
            // 'attachment' => 'required'
        ]);

        if ($validation) {
            DB::beginTransaction();

            try {
                $document = Document::create([
                    'user_id' => Auth::id(),
                    'reference_number' => $request->reference_number,
                    'subject' => $request->subject,
                    'detail' => $request->details,
                    'priority' => $request->priority,
                    'comment' => $request->comments
                ]);

                if (!is_null($request->attachment)) {
                    foreach ($request->attachment as $key => $attachment) {
                        $filename = $attachment->getClientOriginalName();
                        $path = $attachment->store('attachments');
                        DocumentAttachment::create([
                            'document_id' => $document->id,
                            'filename' => $filename,
                            'path' => $path
                        ]);
                    }
                }

            } catch (\ValidationException $e) {
                DB::rollback();
                $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. Error 1');
                return redirect()->route('home');
            }

            try {
                $history = History::create([
                    'document_id' => $document->id,
                    'action' => 0,
                    'action_by' => Auth::id()
                ]);
            } catch (\ValidationException $e) {
                DB::rollback();
                $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. Error 2');
                return redirect()->route('documents.show', [Hashids::encode($document->id)]);
            }

            DB::commit();
        }

        $request->session()->flash('alert-success', '<strong>Success!</strong> New document has been added.');
        return redirect()->route('documents.show', [Hashids::encode($document->id)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Hashids::decode($id)[0];
        $document = Document::find($id);
        $document_status = $document->history()->orderBy('created_at', 'desc')->first()->action;

        $priorities = RefPriority::all()->pluck('desc', 'id');
        $users = User::all()->pluck('name', 'id');

        $arr = [
            'document' => $document,
            'priorities' => $priorities,
            'users' => $users,
            'document_status' => $document_status
        ];

        return view('documents.show', $arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $this->validate($request, [
            'reference_number' => 'required',
            'subject' => 'required',
            'details' => 'required',
            'comments' => 'required'
        ]);

        if ($validation) {
            $id = Hashids::decode($id)[0];
            $document = Document::find($id);

            DB::beginTransaction();

            try {
                $history = History::create([
                    'document_id' => $document->id,
                    'reference_number' => $document->reference_number,
                    'subject' => $document->subject,
                    'detail' => $document->detail,
                    'comment' => $document->comment,
                    'action' => 1,
                    'action_by' => Auth::id()
                ]);
            } catch (\ValidationException $e) {
                DB::rollback();
                $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. Error 2');
                return redirect()->route('documents.show', [Hashids::encode($document->id)]);
            }

            try {
                $document->reference_number = $request->reference_number;
                $document->subject = $request->subject;
                $document->detail = $request->details;
                $document->comment = $request->comments;
                $document->save();
            } catch (\ValidationException $e) {
                DB::rollback();
                $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. Error 1');
                return redirect()->route('home');
            }

            DB::commit();
        }

        $request->session()->flash('alert-success', '<strong>Success!</strong> New document has been updated.');
        return redirect()->route('documents.show', [Hashids::encode($document->id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }

    public function close(Request $request, $id) {
        $id = Hashids::decode($id)[0];

        DB::beginTransaction();

        try {

            $document = Document::find($id);
            $document->status = 1;
            $document->save();

            $history = History::create([
                'document_id' => $id,
                'action' => 3,
                'action_by' => Auth::id()
            ]);
        } catch (\ValidationException $e) {
            DB::rollback();
            $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. Error 1');
            return redirect()->route('documents.show', [Hashids::encode($id)]);
        }

        DB::commit();

        $request->session()->flash('alert-success', '<strong>Success!</strong> Document has been closed.');
        return redirect()->route('documents.show', [Hashids::encode($id)]);
    }

    public function forward(Request $request, $id) {
        $id = Hashids::decode($id)[0];
        DB::beginTransaction();

        try {
            $history = History::create([
                'document_id' => $id,
                'forwarded_to' => $request->forward_to,
                'comment' => $request->forward_comments,
                'action' => 2,
                'action_by' => Auth::id()
            ]);
        } catch (\ValidationException $e) {
            DB::rollback();
            $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. Error 1');
            return redirect()->route('documents.show', [Hashids::encode($id)]);
        }

        DB::commit();

        $request->session()->flash('alert-success', '<strong>Success!</strong> Document has been forwarded.');
        return redirect()->route('documents.show', [Hashids::encode($id)]);
    }
}
