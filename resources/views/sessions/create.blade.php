
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <table width="100%">
                        <tr>
                            <td>
                                New Session
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="panel-body">
                    @include('partials.message')
                    {!! Form::open(['route' => ['sessions.store'], 'method' => 'post']) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="session_type" class="control-label">Session Type</label>
                                    {!! Form::select('session_type', $session_types, null, ['class' => 'form-control', 'placeholder' => 'Select session type']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="place" class="col-md-3 control-label">Place</label>
                                    {!! Form::text('place', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="session_date" class="control-label">Date</label>
                                    {!! Form::text('session_date', null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="session_time" class="control-label">Time</label>
                                    {!! Form::text('session_time', null, ['class' => 'form-control', 'placeholder' => 'Enter time', 'id' => 'datetimepicker']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                            <a href="{{ route('sessions.index') }}" class="btn btn-default">Cancel</a>
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('storage/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/bootstrap-multiselect/bootstrap-multiselect.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('storage/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('storage/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('storage/bootstrap-multiselect/bootstrap-multiselect.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker').datetimepicker({
                format: 'LT'
            });

            $('.proponents').multiselect({
                buttonWidth: '100%'
            });
        });
    </script>
@endpush
