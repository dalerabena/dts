<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\RefPriority;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $documents = $user->documents()->when(isset($request->reference_number), function($query) use($request) {
                        $query->where('reference_number', 'like', '%' . $request->reference_number . '%');
                    })->when(isset($request->subject), function($query) use($request) {
                        $query->where('subject', 'like', '$' . $request->subject . '%');
                    })->when(isset($request->date_created), function($query) use($request) {
                        $query->where('created_at', '=', $request->date_created);
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

        return view('home', $arr);
    }
}
