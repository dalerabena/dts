<?php

namespace App\Http\Controllers;

use App\Document;
use App\DocumentAttachment;
use App\RefPriority;
use App\User;
use App\Track;
use Illuminate\Http\Request;
use Auth;
use DB;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = DB::table('documents')
            ->rightJoin('tracks', 'documents.id', '=', 'tracks.document_id')
            ->orderBy('tracks.created_at', 'desc')
            ->first();
        return view('documents.index');
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

        return view('documents.create')
            ->with('priorities', $priorities)
            ->with('users', $users);
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
            'department' => 'required',
            'comments' => 'required'
            'attachment' => 'required'
        ]);

        if ($validation) {
            DB::beginTransaction();
            
            try {
                $document = Document::create([
                    'reference_number' => $request->reference_number,
                    'subject' => $request->subject,
                    'detail' => $request->details,
                    'priority' => $request->priority,
                    'department' => $request->department,
                    'initiator' => Auth::id(),
                    'comment' => $request->comments
                ]);

                foreach ($request->attachment as $key => $attachment) {
                    $filename = $attachment->getClientOriginalName();
                    $path = $attachment->store('attachments');
                    DocumentAttachment::create([
                        'document_id' => $document->id,
                        'filename' => $filename,
                        'path' => $path
                    ]);
                }

            } catch (\ValidationException $e) {
                DB::rollback();
                $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. Error 1');
                return redirect()->route('home');
            }

            try {
                $track = Track::create([
                    'document_id' => $document->id,
                    'assigned_to' => Auth::id(),
                    'forwarded_to' => $request->department,
                    'comment' => $request->comments,
                    'opened_by' => Auth::id()
                ]);
            } catch (\ValidationException $e) {
                DB::rollback();
                $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. Error 2');
                return redirect()->route('home');
            }



            DB::commit();
        }

        $request->session()->flash('alert-success', '<strong>Success!</strong> New tracking has been added.');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
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
    public function update(Request $request, Document $document)
    {
        //
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
}
