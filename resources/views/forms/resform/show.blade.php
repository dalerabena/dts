
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
                                View Ordform Record
                                <button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#deleteRecord">Delete Record</button>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['resform.update', Hashids::encode($record->id)], 'method' => 'put', 'files' => 'true']) !!}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('resolution_no', 'Resolution Number') !!}
                                        {!! Form::text('resolution_no', $record->resolution_no, ['class' => 'form-control', 'placeholder' => 'Enter resolution number']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('title', 'Title') !!}
                                        {!! Form::textarea('title', $record->title, ['class' => 'form-control', 'placeholder' => 'Enter title', 'rows' => '2']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('sponsors', 'Sponsor/s') !!}
                                        <br>
                                        {!! Form::select('sponsors[]', $sponsors, explode('###', $record->sponsors), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'sponsors']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('approved_date', 'Date Approved') !!}
                                        {!! Form::text('approved_date', $record->approved_date, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd' ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('sp_approval', 'SP Approval') !!}
                                        {!! Form::textarea('sp_approval', $record->sp_approval, ['class' => 'form-control', 'placeholder' => 'Enter sp approval', 'rows' => '2']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('copy', 'Print copy') !!}
                                        {!! Form::file('copy') !!}
                                        @foreach ($copies as $key => $value)
                                            <a href="{{ asset("storage/$value->path") }}">{{ $value->filename }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('resform.index') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            @include('forms.resform.partials.modal')
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('storage/bootstrap-multiselect/bootstrap-multiselect.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('storage/bootstrap-multiselect/bootstrap-multiselect.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('#sponsors').multiselect({
                buttonWidth: '100%'
            });
        });
    </script>
@endpush
