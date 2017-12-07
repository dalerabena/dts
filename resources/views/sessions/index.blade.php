@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @include('partials.message')
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Filter Settings
                </div>
                <div class="panel-body">
                    {!! Form::open(['method' => 'get']) !!}
                    <div class="form-group">
                        {!! Form::label('session_type', 'Session type') !!}
                        {!! Form::select('session_type', $session_types, null, ['class' => 'form-control', 'placeholder' => 'Select session type']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('place', 'Place') !!}
                        {!! Form::text('place', null, ['class' => 'form-control', 'placeholder' => 'Enter place']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('session_date', 'Date') !!}
                        {!! Form::text('session_date', null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('approved_date', 'Time') !!}
                        {!! Form::text('approved_date', null, ['class' => 'form-control', 'placeholder' => 'Enter time', 'id' => 'datetimepicker']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Filter', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Sessions
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Session Type</th>
                                <th>Place</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th width="5%">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($sessions->count() > 0)
                                @foreach($sessions as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->session_type }}</td>
                                        <td>{{ $value->place }}</td>
                                        <td>{{ $value->session_date }}</td>
                                        <td>{{ $value->session_time }}</td>
                                        <td>
                                            <a href="{{ route('sessions.show', [ Hashids::encode($value->id) ]) }}" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">No document/s found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-multiselect/bootstrap-multiselect.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('bootstrap-multiselect/bootstrap-multiselect.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker').datetimepicker({
                format: 'LT'
            });
        });
    </script>
@endpush
