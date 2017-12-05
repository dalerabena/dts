<?php

namespace App\Http\Controllers;

use App\Franform;
use App\RefBrgy;
use Illuminate\Http\Request;
use Hashids;

class FranformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $records = Franform::all();
        $records = Franform::when(isset($request->ordinance_no), function($query) use($request) {
                        $query->where('ordinance_no', 'like', '%' . $request->ordinance_no . '%');
                    })->when(isset($request->name), function($query) use($request) {
                        $query->where('name', 'like', '%' . $request->name . '%');
                    })->when(isset($request->status), function($query) use($request) {
                        $query->where('status', '=', $request->status);
                    })->when(isset($request->brgy), function($query) use($request) {
                        $query->where('barangay', '=', $request->brgy);
                    })->get();

        $brgys = RefBrgy::all()->pluck('brgyDesc', 'brgyCode');
        $status = [ 'New' => 'New', 'Renewal' => 'Renewal', 'Amendment' => 'Amendment' ];

        $arr = [
            'records' => $records,
            'brgys' => $brgys,
            'status' => $status
        ];

        return view('forms.franform.index', $arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brgys = RefBrgy::all()->pluck('brgyDesc', 'brgyCode');
        // $status = [ 'New', 'Renewal', 'Amendment' ];
        $status = [ 'New' => 'New', 'Renewal' => 'Renewal', 'Amendment' => 'Amendment' ];
        $motor_types = [
            'Honda',
            'Yamaha',
            'Kymco',
            'Suzuki',
            'PMR',
            'Motoposh',
            'Kawasaki'
        ];

        $arr = [
            'brgys' => $brgys,
            'status' => $status,
            'motor_types' => $motor_types
        ];

        return view('forms.franform.create', $arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $record = Franform::create([
            'ordinance_no' => $request->ordinance_no,
            'name' => $request->name,
            'barangay' => $request->brgy,
            'status' => $request->status,
            'units' => $request->units,
            'motor_type' => $request->motor_type,
            'motor_no' => $request->motor_no,
            'chassis_no' => $request->chassis_no,
            'sidecar_no' => $request->sidecar_no,
            'approved_date' => $request->date_approved
        ]);

        $request->session()->flash('alert-success', '<strong>Success!</strong> Record has been saved.');
        return redirect()->route('franform.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Franform  $franform
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Hashids::decode($id)[0];
        $record = Franform::find($id);

        $brgys = RefBrgy::all()->pluck('brgyDesc', 'brgyCode');
        $status = [ 'New' => 'New', 'Renewal' => 'Renewal', 'Amendment' => 'Amendment' ];
        $motor_types = [
            'Honda' => 'Honda',
            'Yamaha' => 'Yamaha',
            'Kymco' => 'Kymco',
            'Suzuki' => 'Suzuki',
            'PMR' => 'PMR',
            'Motoposh' => 'Motoposh',
            'Kawasaki' => 'Kawasaki'
        ];

        $arr = [
            'record' => $record,
            'brgys' => $brgys,
            'status' => $status,
            'motor_types' => $motor_types
        ];

        return view('forms.franform.show', $arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Franform  $franform
     * @return \Illuminate\Http\Response
     */
    public function edit(Franform $franform)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Franform  $franform
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];

        $record = Franform::updateOrCreate(
            ['id' => $id],
            [
                'ordinance_no' => $request->ordinance_no,
                'name' => $request->name,
                'barangay' => $request->brgy,
                'status' => $request->status,
                'units' => $request->units,
                'motor_type' => $request->motor_type,
                'motor_no' => $request->motor_no,
                'chassis_no' => $request->chassis_no,
                'sidecar_no' => $request->sidecar_no,
                'approved_date' => $request->date_approved
            ]
        );

        $request->session()->flash('alert-success', '<strong>Success!</strong> Record has been updated.');
        return redirect()->route('franform.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Franform  $franform
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];
        $record = Franform::find($id);

        if ( !is_null($record) ) {

            $result = $record->delete();

            if ($result) {
                $request->session()->flash('alert-success', '<strong>Success!</strong> Record has been deleted.');
            } else {
                $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. record not deleted.');
            }

            return redirect()->route('franform.index');

        } else {
            $request->session()->flash('alert-danger', '<strong>Oops!</strong> Record not found.');
            return redirect()->route('franform.index');
        }
    }

    public function getOrdNos() {
        $list = [];
        $result =  Franform::select('ordinance_no')->get();

        foreach ($result as $key => $value) {
            array_push($list, $value->ordinance_no);
        }

        return response()->json($list);
    }

    public function getNames() {
        $list = [];
        $result = Franform::select('name')->get();

        foreach ($result as $key => $value) {
            array_push($list, $value->name);
        }

        return response()->json($list);
    }
}
