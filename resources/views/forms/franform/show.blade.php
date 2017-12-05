
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
                                View franform record
                                <button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#deleteRecord">Delete Record</button>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['franform.update', Hashids::encode($record->id)], 'method' => 'put']) !!}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('ordinance_no', 'Ordinance Number') !!}
                                        {!! Form::text('ordinance_no', $record->ordinance_no, ['class' => 'form-control', 'placeholder' => 'Enter ordinance number']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Name') !!}
                                        {!! Form::text('name', $record->name, ['class' => 'form-control', 'placeholder' => 'Enter name']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('brgy', 'Barangay') !!}
                                        {!! Form::select('brgy', $brgys, $record->barangay, ['class' => 'form-control', 'placeholder' => 'Select barangay']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('status', 'Status') !!}
                                        {!! Form::select('status', $status, $record->status, ['class' => 'form-control', 'placeholder' => 'Select status']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('date_approved', 'Date approved') !!}
                                        {!! Form::text('date_approved', $record->approved_date, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('units', 'Unit/s') !!}
                                        {!! Form::number('units', $record->units, ['class' => 'form-control', 'placeholder' => 'Enter unit/s']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('motor_type', 'Type of Motor') !!}
                                        {!! Form::select('motor_type', $motor_types, $record->motor_type, ['class' => 'form-control', 'placeholder' => 'Select type of motor']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('motor_no', 'Motor Number') !!}
                                        {!! Form::text('motor_no', $record->motor_no, ['class' => 'form-control', 'placeholder' => 'Enter motor number']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('chassis_no', 'Chassis Number') !!}
                                        {!! Form::text('chassis_no', $record->chassis_no, ['class' => 'form-control', 'placeholder' => 'Enter chassis number']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('sidecar_no', 'Side Car Number') !!}
                                        {!! Form::text('sidecar_no', $record->chassis_no, ['class' => 'form-control', 'placeholder' => 'Enter sidecar number']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('franform.index') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            @include('forms.franform.partials.modal')
        </div>
    </div>
</div>
@endsection
