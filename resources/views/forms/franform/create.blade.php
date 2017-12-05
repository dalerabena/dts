
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <table width="100%">
                        <tr>
                            <td>
                                New franform record
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['franform.store']]) !!}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('ordinance_no', 'Ordinance Number') !!}
                                        {!! Form::text('ordinance_no', null, ['class' => 'form-control', 'placeholder' => 'Enter ordinance number']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Name') !!}
                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('brgy', 'Barangay') !!}
                                        {!! Form::select('brgy', $brgys, null, ['class' => 'form-control', 'placeholder' => 'Select barangay']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('status', 'Status') !!}
                                        {!! Form::select('status', $status, null, ['class' => 'form-control', 'placeholder' => 'Select status']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('date_approved', 'Date approved') !!}
                                        {!! Form::text('date_approved', null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('units', 'Unit/s') !!}
                                        {!! Form::number('units', null, ['class' => 'form-control', 'placeholder' => 'Enter unit/s']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('motor_type', 'Type of Motor') !!}
                                        {!! Form::select('motor_type', $motor_types, null, ['class' => 'form-control', 'placeholder' => 'Select type of motor']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('motor_no', 'Motor Number') !!}
                                        {!! Form::text('motor_no', null, ['class' => 'form-control', 'placeholder' => 'Enter motor number']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('chassis_no', 'Chassis Number') !!}
                                        {!! Form::text('chassis_no', null, ['class' => 'form-control', 'placeholder' => 'Enter chassis number']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('sidecar_no', 'Side Car Number') !!}
                                        {!! Form::text('sidecar_no', null, ['class' => 'form-control', 'placeholder' => 'Enter sidecar number']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('franform.index') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
