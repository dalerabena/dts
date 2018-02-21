<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\AgendaAttachment;
use App\Session;
use Illuminate\Http\Request;
use Hashids;
use DB;
use Storage;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($request->agenda_title)  || !isset($request->agenda_proponents)) {
            $request->session()->flash('alert-warning', '<strong>Oops!</strong> Please check your inputs.');
            return redirect()->route('sessions.show', $request->session_id);
        }

        $id = Hashids::decode($request->session_id)[0];

        DB::beginTransaction();

            try {
                $agenda = Agenda::create([
                    'session_id' => $id,
                    'title' => $request->agenda_title,
                    'proponents' => count($request->agenda_proponents) > 0 ? implode('###', $request->agenda_proponents) : null
                ]);

                if (isset($request->agenda_attachments)) {
                    foreach ($request->agenda_attachments as $key => $attachment) {
                        $filename = $attachment->getClientOriginalName();
                        $path = $attachment->store('attachments');

                        AgendaAttachment::create([
                            'session_id' => $id,
                            'agenda_id' => $agenda->id,
                            'filename' => $filename,
                            'path' => $path
                        ]);
                    }
                }

            } catch (\ValidationException $e) {
                $request->session()->flash('alert-danger', '<strong>Oops!</strong> Agenda not added.');
            }

        DB::commit();

        $request->session()->flash('alert-success', '<strong>Success!</strong> Agenda has been added.');
        return redirect()->route('sessions.show', $request->session_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];
        $session_id = Hashids::decode($request->session_id)[0];

        DB::beginTransaction();

            try {
                // $agenda = Agenda::create([
                //     'session_id' => $id,
                //     'title' => $request->agenda_title,
                //     'proponents' => count($request->agenda_proponents) > 0 ? implode('###', $request->agenda_proponents) : null
                // ]);

                $agenda = Agenda::find($id);
                $agenda->title = $request->agenda_title;
                $agenda->proponents =  count($request->agenda_proponents) > 0 ? implode('###', $request->agenda_proponents) : null;
                $agenda->save();

                if (isset($request->agenda_attachments)) {
                    foreach ($request->agenda_attachments as $key => $attachment) {
                        $filename = $attachment->getClientOriginalName();
                        $path = $attachment->store('attachments');

                        AgendaAttachment::create([
                            'session_id' => $session_id,
                            'agenda_id' => $agenda->id,
                            'filename' => $filename,
                            'path' => $path
                        ]);
                    }
                }

            } catch (\ValidationException $e) {
                $request->session()->flash('alert-danger', '<strong>Oops!</strong> Agenda not updated.');
            }

        DB::commit();

        $request->session()->flash('alert-success', '<strong>Success!</strong> Agenda has been updated.');
        return redirect()->route('sessions.show', $request->session_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];

        $agenda = Agenda::find($id);
        $session_id = $agenda->session_id;

        if ( !is_null($agenda) ) {

            DB::beginTransaction();
                try {
                    foreach ($agenda->attachments as $key => $value) {
                        $attachment = AgendaAttachment::find($value->id);
                        $result = Storage::delete($attachment->path);

                        if ($result) {
                            $attachment->delete();
                        }
                    }

                    $result = $agenda->delete();

                } catch (\ValidationException $e) {
                    $request->session()->flash('alert-danger', '<strong>Oops!</strong> Something went wrong.');
                    return redirect()->route('sessions.show', Hashids::encode($session_id));
                }

            DB::commit();

            $request->session()->flash('alert-success', '<strong>Success!</strong> Agenda has been removed.');
            return redirect()->route('sessions.show', Hashids::encode($session_id));

        } else {
            $request->session()->flash('alert-danger', '<strong>Oops!</strong> Session not found.');
            return redirect()->route('sessions.index');
        }
    }

    public function deleteAttachment(Request $request, $attachment_id) {
        $id = Hashids::decode($attachment_id)[0];

        $agenda_attachment = AgendaAttachment::find($id);
        $session_id = $agenda_attachment->session_id;

        if (is_null($agenda_attachment)) {
            $request->session()->flash('alert-danger', '<strong>Oops!</strong> Attachment not found.');
            return redirect()->route('sessions.show', Hashids::encode($agenda_attachment->session_id));
        }

        $result = $agenda_attachment->delete();

        if ($result) {
            $request->session()->flash('alert-success', '<strong>Success!</strong> Attachment successfully deleted.');
        } else {
            $request->session()->flash('alert-danger', '<strong>Oops!</strong> Attachment not deleted.');
        }

        return redirect('/sessions/' . Hashids::encode($agenda_attachment->session_id) . '?id=' . Hashids::encode($agenda_attachment->agenda_id));
    }
}
