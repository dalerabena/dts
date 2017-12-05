<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\LegislativeMeasure;
use App\LawType;
use App\SBAction;

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
        return redirect()->route('legislative.index');
        // $legislative_measures = LegislativeMeasure::all();
        //
        // $legislative_measures = LegislativeMeasure::when(isset($request->law_type), function($query) use($request) {
        //                 $query->where('law_type', '=', $request->law_type);
        //             })->when(isset($request->ord_res_no), function($query) use($request) {
        //                 $query->where('ord_res_no', 'like', '%' . $request->ord_res_no . '%');
        //             })->when(isset($request->title_subject), function($query) use($request) {
        //                 $query->where('title_subject', 'like', '%' . $request->title_subject . '%');
        //             })->when(isset($request->sb_action), function($query) use($request) {
        //                 $query->where('priority', '=', $request->sb_action);
        //             })->get();
        //
        // $ref_laws = LawType::all()->pluck('type', 'id');
        // $sb_actions = SBAction::all()->pluck('action', 'id');
        //
        // $arr = [
        //     'legislative_measures' => $legislative_measures,
        //     'ref_laws' => $ref_laws,
        //     'sb_actions' => $sb_actions
        // ];
        //
        // return view('home', $arr);
    }
}
