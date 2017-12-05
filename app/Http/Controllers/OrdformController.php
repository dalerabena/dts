<?php

namespace App\Http\Controllers;

use App\Ordform;
use App\OrdformCopy;
use App\Proponent;
use Illuminate\Http\Request;
use DB;
use Hashids;

class OrdformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = Ordform::when(isset($request->ordinance_no), function($query) use($request) {
                        $query->where('ordinance_no', 'like', '%' . $request->ordinance_no . '%');
                    })->when(isset($request->subject_matter), function($query) use($request) {
                        $query->where('subject_matter', 'like', '%' . $request->subject_matter . '%');
                    })->when(isset($request->approved_date), function($query) use($request) {
                        $query->where('approved_date', 'like', '%' . $request->approved_date . '%');
                    })->get();

        $arr = [
            'records' => $records
        ];

        return view('forms.ordform.index', $arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sponsors = Proponent::all()->pluck('name', 'id');

        $arr = [
            'sponsors' => $sponsors
        ];

        return view('forms.ordform.create', $arr);
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
                $record = Ordform::create([
                    'ordinance_no' => $request->ordinance_no,
                    'subject_matter' => $request->subject_matter,
                    'sponsors' => count($request->sponsors) > 0 ? implode('###', $request->sponsors) : null,
                    'approved_date' => $request->approved_date,
                    'sp_actions' => $request->sp_actions
                ]);

                if (isset($request->copy)) {
                    $filename = $request->copy->getClientOriginalName();
                    $path = $request->copy->store('copies');

                    OrdformCopy::create([
                        'ordform_id' => $record->id,
                        'filename' => $filename,
                        'path' => $path
                    ]);
                }

            } catch (\ValidationException $e) {
                DB::rollback();
                $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. Error 1');
                return redirect()->route('ordform.index');
            }

        DB::commit();

        $request->session()->flash('alert-success', '<strong>Success!</strong> Record has been saved.');
        return redirect()->route('ordform.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ordform  $ordform
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Hashids::decode($id)[0];
        $record = Ordform::find($id);
        $copies = $record->copies;

        $sponsors = Proponent::all()->pluck('name', 'id');

        $arr = [
            'record' => $record,
            'copies' => $copies,
            'sponsors' => $sponsors
        ];

        return view('forms.ordform.show', $arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ordform  $ordform
     * @return \Illuminate\Http\Response
     */
    public function edit(Ordform $ordform)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ordform  $ordform
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];

        DB::beginTransaction();

            try {
                $record = Ordform::updateOrCreate(
                    ['id' => $id],
                    [
                        'ordinance_no' => $request->ordinance_no,
                        'subject_matter' => $request->subject_matter,
                        'sponsors' => count($request->sponsors) > 0 ? implode('###', $request->sponsors) : null,
                        'approved_date' => $request->approved_date,
                        'sp_actions' => $request->sp_actions
                    ]
                );

                if (isset($request->copy)) {
                    $filename = $request->copy->getClientOriginalName();
                    $path = $request->copy->store('copies');

                    OrdformCopy::create([
                        'ordform_id' => $record->id,
                        'filename' => $filename,
                        'path' => $path
                    ]);
                }

            } catch (\ValidationException $e) {
                DB::rollback();
                $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. Error 1');
                return redirect()->route('ordform.index');
            }

        DB::commit();

        $request->session()->flash('alert-success', '<strong>Success!</strong> Record has been updated.');
        return redirect()->route('ordform.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ordform  $ordform
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];
        $record = Ordform::find($id);

        if ( !is_null($record) ) {

            $result = $record->delete();

            if ($result) {
                $request->session()->flash('alert-success', '<strong>Success!</strong> Record has been deleted.');
            } else {
                $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. record not deleted.');
            }

            return redirect()->route('ordform.index');

        } else {
            $request->session()->flash('alert-danger', '<strong>Oops!</strong> Record not found.');
            return redirect()->route('ordform.index');
        }
    }

    public function getOrdNos() {
        $list = [];
        $result =  Ordform::select('ordinance_no')->get();

        foreach ($result as $key => $value) {
            if (!is_null($value->ordinance_no) || $value->ordinance_no != "") {
                array_push($list, $value->ordinance_no);
            }
        }

        return response()->json($list);
    }
}
