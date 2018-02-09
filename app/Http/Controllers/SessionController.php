<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\AgendaAttachment;
use App\Session;
use App\Proponent;
use Illuminate\Http\Request;
use Hashids;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sessions = Session::when(isset($request->session_type), function($query) use($request) {
                        $query->where('session_type', '=', $request->session_type);
                    })->when(isset($request->place), function($query) use($request) {
                        $query->where('place', 'like', '%' . $request->place . '%');
                    })->when(isset($request->session_date), function($query) use($request) {
                        $query->where('session_date', 'like', '%' . $request->session_date . '%');
                    })->when(isset($request->session_time), function($query) use($request) {
                        $query->where('session_time', 'like', '%' . $request->session_time . '%');
                    })->orderBy('created_at', 'desc')->get();

        $session_types = ['Regular Meeting' => 'Regular Meeting', 'Special Meeting' => 'Special Meeting'];

        $arr = [
            'sessions' => $sessions,
            'session_types' => $session_types
        ];

        return view('sessions.index', $arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $session_types = ['Regular Meeting' => 'Regular Meeting', 'Special Meeting' => 'Special Meeting'];
        $proponents = Proponent::all()->pluck('name', 'id');

        $arr = [
            'session_types' => $session_types,
            'proponents' => $proponents
        ];

        return view('sessions.create', $arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $session = Session::create([
            'session_type' => $request->session_type,
            'session_date' => $request->session_date,
            'session_time' => $request->session_time,
            'place' => $request->place
        ]);

        $request->session()->flash('alert-success', '<strong>Success!</strong> Record has been saved.');
        return redirect()->route('sessions.show', Hashids::encode($session->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (isset($request->id)) {
            $agenda_id = Hashids::decode($request->id)[0];
            $agenda = Agenda::find($agenda_id);
            $agenda_attachments = AgendaAttachment::find($agenda_id);
        }

        $id = Hashids::decode($id)[0];

        $session = Session::find($id);

        $session_types = ['Regular Meeting' => 'Regular Meeting', 'Special Meeting' => 'Special Meeting'];
        $proponents = Proponent::all()->pluck('name', 'id');

        $arr = [
            'session' => $session,
            'session_types' => $session_types,
            'proponents' => $proponents,
            'agenda' => isset($agenda) ? $agenda : null
        ];

        return view('sessions.show', $arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];

        $session = Session::updateOrCreate(
            ['id' => $id],
            [
                'session_type' => $request->session_type,
                'session_date' => $request->session_date,
                'session_time' => $request->session_time,
                'place' => $request->place
            ]
        );

        $request->session()->flash('alert-success', '<strong>Success!</strong> Record has been updated.');
        return redirect()->route('sessions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
    }
}
