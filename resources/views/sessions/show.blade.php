
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @include('partials.message')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <table width="100%">
                        <tr>
                            <td>
                                Session Details
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['sessions.update', Hashids::encode($session->id)], 'method' => 'put']) !!}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="session_type" class="control-label">Session Type</label>
                                    {!! Form::select('session_type', $session_types, $session->session_type, ['class' => 'form-control', 'placeholder' => 'Select session type']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="place" class="col-md-3 control-label">Place</label>
                                    {!! Form::text('place', $session->place, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="session_date" class="control-label">Date</label>
                                    {!! Form::text('session_date', $session->session_date, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="session_time" class="control-label">Time</label>
                                    {!! Form::text('session_time', $session->session_time, ['class' => 'form-control', 'placeholder' => 'Enter time', 'id' => 'datetimepicker']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Agendas
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="25%">Title</th>
                                <th width="35%">Proponents</th>
                                <th>Attachment/s</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($session->agendas()->count() > 0)
                                @foreach ($session->agendas as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>
                                            <ul>
                                                @foreach (explode('###', $value->proponents) as $proponent)
                                                    <li>{{ \App\Proponent::find($proponent)->name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach ($value->attachments as $attachment)
                                                    <li>
                                                        <a href="{{ asset("storage/$attachment->path") }}" target="_blank">{{ $attachment->filename }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            {!! Form::open(['route' => ['agendas.destroy', Hashids::encode($value->id)], 'method' => 'delete']) !!}
                                                {!! Form::submit('Remove', ['class' => 'btn btn-danger btn-sm']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">No agenda/s to display.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Agenda
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => ['agendas.store', Hashids::encode($session->id)], 'method' => 'post', 'files' => 'true']) !!}
                        {!! Form::hidden('session_id', Hashids::encode($session->id)) !!}
                        <div class="form-group">
                            {!! Form::label('agenda_title', 'Title') !!}
                            {!! Form::textarea('agenda_title', null, ['class' => 'form-control', 'placeholder' => 'Enter agenda title', 'rows' => '2']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('agenda_proponents[]', 'Proponents') !!}
                            {!! Form::select('agenda_proponents[]', $proponents, null, ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'proponents']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('agenda_attachments', 'Attachment/s') !!}
                            {!! Form::file('agenda_attachments[]', ['multiple']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Add agenda', ['class' => 'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
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

            $('#proponents').multiselect({
                buttonWidth: '100%'
            });
        });
    </script>
@endpush
