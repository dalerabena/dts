<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use Hashids;

class Session2Controller extends Controller
{
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
