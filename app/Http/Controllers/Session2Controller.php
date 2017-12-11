<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Proponent;
use Hashids;

class Session2Controller extends Controller
{
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
                    })->orderBy('session_date', 'desc')->get();

        $session_types = ['Regular Meeting' => 'Regular Meeting', 'Special Meeting' => 'Special Meeting'];

        $arr = [
            'sessions' => $sessions,
            'session_types' => $session_types
        ];

        return view('session.index', $arr);
    }

    public function show(Request $request, $id)
    {
        $id = Hashids::decode($id);
        if (count($id) > 0) {
            $session = Session::find($id[0]);

            if (!is_null($session)) {
                return view('session.show')->with('session', $session);
            }
        }

        $request->session()->flash('alert-info', '<strong>Oops!</strong> Session not found.');
        return redirect()->route('session_index');
    }

    public function session(Request $request) {

    	if (isset($request->id)) {
    		$id = Hashids::decode($request->id);
    		if (count($id) > 0) {
    			$session = Session::find($id[0]);

	    		if (!is_null($session)) {
	    			return view('session.show')->with('session', $session);
	    		}
    		}

    		$request->session()->flash('alert-warning', '<strong>Oops!</strong> Session not found.');
    	}

    	return view('session.index');
    }
}
