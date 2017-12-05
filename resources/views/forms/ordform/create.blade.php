
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
                                New ordform record
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['ordform.store'], 'files' => 'true']) !!}
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
                                        {!! Form::label('subject_matter', 'Subject Matter') !!}
                                        {!! Form::textarea('subject_matter', null, ['class' => 'form-control', 'placeholder' => 'Enter subject matter', 'rows' => '2']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('sponsors', 'Sponsor/s') !!}
                                        <br>
                                        {!! Form::select('sponsors[]', $sponsors, null, ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'sponsors']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('approved_date', 'Date Approved') !!}
                                        {!! Form::text('approved_date', null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd' ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('sp_actions', 'SP Action/s') !!}
                                        {!! Form::textarea('sp_actions', null, ['class' => 'form-control', 'placeholder' => 'Enter sp action/s', 'rows' => '2']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('copy', 'Print copy') !!}
                                        {!! Form::file('copy') !!}
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

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
@endpush

@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sponsors').multiselect({
                buttonWidth: '100%'
            });
        });
    </script>
@endpush
