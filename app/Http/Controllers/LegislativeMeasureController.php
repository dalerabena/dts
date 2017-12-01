<?php

namespace App\Http\Controllers;

use App\LegislativeMeasure;
use App\Author;
use App\CoAuthor;
use App\Proponent;
use App\CoSponsor;
use App\CommitteeAction;
use App\ReferredTo;
use App\RefLaw;
use App\SBAction;
use Illuminate\Http\Request;

class LegislativeMeasureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $legislative_measures = LegislativeMeasure::all();

        $arr = [
            'legislative_measures' => $legislative_measures
        ];

        return view('legislative_measures.index', $arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all()->pluck('name', 'id');
        $co_authors = CoAuthor::all()->pluck('name', 'id');
        $proponents = Proponent::all()->pluck('name', 'id');
        $co_sponsors = CoSponsor::all()->pluck('name', 'id');
        $committee_actions = CommitteeAction::all()->pluck('desc', 'id');
        $referred_tos = ReferredTo::all()->pluck('name', 'id');
        $ref_laws = RefLaw::all()->pluck('type', 'id');
        $sb_actions = SBAction::all()->pluck('action', 'id');

        $vetoed = [0 => 'No', 1 => 'Yes', 2 => 'Returned'];
        $implemented = [0 => 'No', 1 => 'Yes'];
        $reported = [0 => 'No', 1 => 'Yes'];

        $arr = [
            'authors' => $authors,
            'co_authors' => $co_authors,
            'proponents' => $proponents,
            'co_sponsors' => $co_sponsors,
            'committee_actions' => $committee_actions,
            'referred_tos' => $referred_tos,
            'ref_laws' => $ref_laws,
            'sb_actions' => $sb_actions,
            'vetoed' => $vetoed,
            'implemented' => $implemented,
            'reported' => $reported
        ];

        return view('legislative_measures.create', $arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LegislativeMeasure  $legislativeMeasure
     * @return \Illuminate\Http\Response
     */
    public function show(LegislativeMeasure $legislativeMeasure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LegislativeMeasure  $legislativeMeasure
     * @return \Illuminate\Http\Response
     */
    public function edit(LegislativeMeasure $legislativeMeasure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LegislativeMeasure  $legislativeMeasure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LegislativeMeasure $legislativeMeasure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LegislativeMeasure  $legislativeMeasure
     * @return \Illuminate\Http\Response
     */
    public function destroy(LegislativeMeasure $legislativeMeasure)
    {
        //
    }
}
