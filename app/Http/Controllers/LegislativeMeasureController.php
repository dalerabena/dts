<?php

namespace App\Http\Controllers;

use App\LegislativeMeasure;
use App\LegislativeMeasureCopy;
use App\Author;
use App\CoAuthor;
use App\Proponent;
use App\CoSponsor;
use App\CommitteeAction;
use App\ReferredTo;
use App\LawType;
use App\SBAction;
use Illuminate\Http\Request;
use DB;
use Auth;
use Hashids;

class LegislativeMeasureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $legislative_measures = LegislativeMeasure::all();

        $legislative_measures = LegislativeMeasure::when(isset($request->law_type), function($query) use($request) {
                        $query->where('law_type', '=', $request->law_type);
                    })->when(isset($request->ord_res_no), function($query) use($request) {
                        $query->where('ord_res_no', 'like', '%' . $request->ord_res_no . '%');
                    })->when(isset($request->title_subject), function($query) use($request) {
                        $query->where('title_subject', 'like', '%' . $request->title_subject . '%');
                    })->when(isset($request->sb_action), function($query) use($request) {
                        $query->where('priority', '=', $request->sb_action);
                    })->get();

        $ref_laws = LawType::all()->pluck('type', 'id');
        $sb_actions = SBAction::all()->pluck('action', 'id');

        $arr = [
            'legislative_measures' => $legislative_measures,
            'ref_laws' => $ref_laws,
            'sb_actions' => $sb_actions
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
        $ref_laws = LawType::all()->pluck('type', 'id');
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
        DB::beginTransaction();

            try {
                $legislative_measure = LegislativeMeasure::create([
                    'user_id' => Auth::id(),
                    'law_type' => $request->law_type,
                    'ord_res_no' => $request->ord_res_no,
                    'title_subject' => $request->title_subject,
                    'authors' => count($request->authors) > 0 ? implode('###', $request->authors) : null,
                    'co_authors' => count($request->co_authors) > 0 ? implode('###', $request->co_authors) : null,
                    'proponents' => count($request->proponents) > 0 ? implode('###', $request->proponents) : null,
                    'co_sponsors' => count($request->co_sponsors) > 0 ? implode('###', $request->co_sponsors) : null,
                    'referred_to' => count($request->referred_to) > 0 ? implode('###', $request->referred_to) : null,
                    'referred_when' => $request->referred_when,
                    'committee_action' => $request->committee_action,
                    'committee_action_date' => $request->committee_action_date,
                    'remarks' => $request->remarks,
                    'reported' => $request->reported,
                    'reported_when' => $request->reported_when,
                    'sb_action' => $request->sb_action,
                    'enacted_approved_date' => $request->enacted_approved_date,
                    'date_transmitted_to_mayor' => $request->date_transmitted_to_mayor,
                    'date_approved_by_mayor' => $request->date_approved_by_mayor,
                    'date_transmitted_to_sp' => $request->date_transmitted_to_sp,
                    'sp_action' => $request->sp_action,
                    'implemented' => $request->implemented,
                    'vetoed' => $request->vetoed,
                    'vetoed_reasons' => $request->vetoed_reasons,
                    'notes' => $request->notes
                ]);

                if (!is_null($request->copies)) {
                    foreach ($request->copies as $key => $value) {
                        $filename = $value->getClientOriginalName();
                        $path = $value->store('copies');

                        if ($key == 'sp_res_copy') {
                            $type = 1;
                        }

                        if ($key == 'print_copy') {
                            $type = 2;
                        }

                        LegislativeMeasureCopy::create([
                            'legislative_measure_id' => $legislative_measure->id,
                            'filename' => $filename,
                            'path' => $path,
                            'type' => $type
                        ]);
                    }
                }

            } catch (\ValidationException $e) {
                DB::rollback();
                $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. Error 1');
                return redirect()->route('legislative.index');
            }

        DB::commit();

        $request->session()->flash('alert-success', '<strong>Success!</strong> New document has been added.');
        return redirect()->route('legislative.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LegislativeMeasure  $legislativeMeasure
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Hashids::decode($id)[0];
        $legislative_measure = LegislativeMeasure::find($id);

        $sp_res_copy = $legislative_measure->copies()->where('type', 1)->get();
        $print_copy = $legislative_measure->copies()->where('type', 2)->get();

        $authors = Author::all()->pluck('name', 'id');
        $co_authors = CoAuthor::all()->pluck('name', 'id');
        $proponents = Proponent::all()->pluck('name', 'id');
        $co_sponsors = CoSponsor::all()->pluck('name', 'id');
        $committee_actions = CommitteeAction::all()->pluck('desc', 'id');
        $referred_tos = ReferredTo::all()->pluck('name', 'id');
        $ref_laws = LawType::all()->pluck('type', 'id');
        $sb_actions = SBAction::all()->pluck('action', 'id');

        $vetoed = [0 => 'No', 1 => 'Yes', 2 => 'Returned'];
        $implemented = [0 => 'No', 1 => 'Yes'];
        $reported = [0 => 'No', 1 => 'Yes'];

        $arr = [
            'legislative_measure' => $legislative_measure,
            'sp_res_copy' => $sp_res_copy,
            'print_copy' => $print_copy,
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

        return view('legislative_measures.show', $arr);
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
    public function update(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];
        DB::beginTransaction();

            try {
                $legislative_measure = LegislativeMeasure::updateOrCreate(
                    ['id' => $id],
                    [
                        'id' => $id,
                        'user_id' => Auth::id(),
                        'law_type' => $request->law_type,
                        'ord_res_no' => $request->ord_res_no,
                        'title_subject' => $request->title_subject,
                        'authors' => count($request->authors) > 0 ? implode('###', $request->authors) : null,
                        'co_authors' => count($request->co_authors) > 0 ? implode('###', $request->co_authors) : null,
                        'proponents' => count($request->proponents) > 0 ? implode('###', $request->proponents) : null,
                        'co_sponsors' => count($request->co_sponsors) > 0 ? implode('###', $request->co_sponsors) : null,
                        'referred_to' => count($request->referred_to) > 0 ? implode('###', $request->referred_to) : null,
                        'referred_when' => $request->referred_when,
                        'committee_action' => $request->committee_action,
                        'committee_action_date' => $request->committee_action_date,
                        'remarks' => $request->remarks,
                        'reported' => $request->reported,
                        'reported_when' => $request->reported_when,
                        'sb_action' => $request->sb_action,
                        'enacted_approved_date' => $request->enacted_approved_date,
                        'date_transmitted_to_mayor' => $request->date_transmitted_to_mayor,
                        'date_approved_by_mayor' => $request->date_approved_by_mayor,
                        'date_transmitted_to_sp' => $request->date_transmitted_to_sp,
                        'sp_action' => $request->sp_action,
                        'implemented' => $request->implemented,
                        'vetoed' => $request->vetoed,
                        'vetoed_reasons' => $request->vetoed_reasons,
                        'notes' => $request->notes
                    ]
                );

                if (!is_null($request->copies)) {
                    foreach ($request->copies as $key => $value) {
                        $filename = $value->getClientOriginalName();
                        $path = $value->store('copies');

                        if ($key == 'sp_res_copy') {
                            $type = 1;
                        }

                        if ($key == 'print_copy') {
                            $type = 2;
                        }

                        LegislativeMeasureCopy::create([
                            'legislative_measure_id' => $legislative_measure->id,
                            'filename' => $filename,
                            'path' => $path,
                            'type' => $type
                        ]);
                    }
                }

            } catch (\ValidationException $e) {
                DB::rollback();
                $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. Error 1');
                return redirect()->route('legislative.index');
            }

        DB::commit();

        $request->session()->flash('alert-success', '<strong>Success!</strong> New document has been added.');
        return redirect()->route('legislative.index');

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

    public function getOrdResNos() {
        $list = [];
        $ord_res_nos =  LegislativeMeasure::select('ord_res_no')->get();

        foreach ($ord_res_nos as $key => $value) {
            array_push($list, $value->ord_res_no);
        }

        return response()->json($list);
    }

    public function getTitleSubjects() {
        $list = [];
        $title_subjects = LegislativeMeasure::select('title_subject')->get();

        foreach ($title_subjects as $key => $value) {
            array_push($list, $value->title_subject);
        }

        return response()->json($list);
    }
}
