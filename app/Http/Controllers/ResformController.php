<?php

namespace App\Http\Controllers;

use App\Resform;
use App\ResformCopy;
use App\Proponent;
use Illuminate\Http\Request;
use DB;
use Hashids;

class ResformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = Resform::when(isset($request->resolution_no), function($query) use($request) {
                        $query->where('resolution_no', 'like', '%' . $request->resolution_no . '%');
                    })->when(isset($request->title), function($query) use($request) {
                        $query->where('title', 'like', '%' . $request->title . '%');
                    })->when(isset($request->approved_date), function($query) use($request) {
                        $query->where('approved_date', 'like', '%' . $request->approved_date . '%');
                    })->get();

        $arr = [
            'records' => $records
        ];

        return view('forms.resform.index', $arr);
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

        return view('forms.resform.create', $arr);
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
                $record = Resform::create([
                    'resolution_no' => $request->resolution_no,
                    'title' => $request->title,
                    'sponsors' => count($request->sponsors) > 0 ? implode('###', $request->sponsors) : null,
                    'approved_date' => $request->approved_date,
                    'sp_approval' => $request->sp_approval
                ]);

                if (isset($request->copy)) {
                    $filename = $request->copy->getClientOriginalName();
                    $path = $request->copy->store('copies');

                    ResformCopy::create([
                        'resform_id' => $record->id,
                        'filename' => $filename,
                        'path' => $path
                    ]);
                }

            } catch (\ValidationException $e) {
                DB::rollback();
                $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. Error 1');
                return redirect()->route('resform.index');
            }

        DB::commit();

        $request->session()->flash('alert-success', '<strong>Success!</strong> Record has been saved.');
        return redirect()->route('resform.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resform  $resform
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Hashids::decode($id)[0];
        $record = Resform::find($id);
        $copies = $record->copies;

        $sponsors = Proponent::all()->pluck('name', 'id');

        $arr = [
            'record' => $record,
            'copies' => $copies,
            'sponsors' => $sponsors
        ];

        return view('forms.resform.show', $arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resform  $resform
     * @return \Illuminate\Http\Response
     */
    public function edit(Resform $resform)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resform  $resform
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];

        DB::beginTransaction();

            try {
                $record = Resform::updateOrCreate(
                    ['id' => $id],
                    [
                        'resolution_no' => $request->resolution_no,
                        'title' => $request->title,
                        'sponsors' => count($request->sponsors) > 0 ? implode('###', $request->sponsors) : null,
                        'approved_date' => $request->approved_date,
                        'sp_approval' => $request->sp_approval
                    ]
                );

                if (isset($request->copy)) {
                    $filename = $request->copy->getClientOriginalName();
                    $path = $request->copy->store('copies');

                    ResformCopy::create([
                        'resform_id' => $record->id,
                        'filename' => $filename,
                        'path' => $path
                    ]);
                }

            } catch (\ValidationException $e) {
                DB::rollback();
                $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. Error 1');
                return redirect()->route('resform.index');
            }

        DB::commit();

        $request->session()->flash('alert-success', '<strong>Success!</strong> Record has been updated.');
        return redirect()->route('resform.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resform  $resform
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];
        $record = Resform::find($id);

        if ( !is_null($record) ) {

            $result = $record->delete();

            if ($result) {
                $request->session()->flash('alert-success', '<strong>Success!</strong> Record has been deleted.');
            } else {
                $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. record not deleted.');
            }

            return redirect()->route('resform.index');

        } else {
            $request->session()->flash('alert-danger', '<strong>Oops!</strong> Record not found.');
            return redirect()->route('resform.index');
        }
    }

    public function getResNos() {
        $list = [];
        $result =  Resform::select('resolution_no')->get();

        foreach ($result as $key => $value) {
            if (!is_null($value->resolution_no) || $value->resolution_no != "") {
                array_push($list, $value->resolution_no);
            }            
        }

        return response()->json($list);
    }
}
