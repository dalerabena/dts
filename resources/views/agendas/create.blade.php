
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
                    {!! Form::open(['route' => ['sessions.store'], 'method' => 'post', 'files' => 'true', 'id' => 'sessionForm']) !!}

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
                        </div><br>

                        <div class="row">
                            <div class="col-md-12 form-horizontal">
                                <div class="form-group">
                                    <label class="col-xs-1 control-label">Agenda</label>
                                    <div class="col-xs-4">
                                        {!! Form::text('agenda[0].title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                                    </div>
                                    <div class="col-xs-3">
                                        {!! Form::select('agenda[0].proponents[]', $proponents, null, ['class' => 'form-control proponents', 'multiple' => 'multiple']) !!}
                                    </div>
                                    <div class="col-xs-3">
                                        {!! Form::file('agenda[0].attachments[]') !!}
                                    </div>
                                    <div class="col-xs-1">
                                        <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- The template for adding new field -->
                        <div class="row hide" id="agendaTemplate">
                            <div class="col-md-12 form-horizontal">
                                <div class="form-group" >
                                    <div class="col-xs-4 col-xs-offset-1">
                                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                                    </div>
                                    <div class="col-xs-3">
                                        {!! Form::select('proponents[]', $proponents, null, ['class' => 'form-control proponents', 'multiple' => 'multiple']) !!}
                                    </div>
                                    <div class="col-xs-3">
                                        {!! Form::file('attachments[]') !!}
                                    </div>
                                    <div class="col-xs-1">
                                        <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
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

            var agendaIndex = 0;

            $('#sessionForm').on('click', '.addButton', function() {
                agendaIndex++;
                var $template = $('#agendaTemplate'),
                    $clone = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .attr('data-agenda-index', agendaIndex)
                                .insertBefore($template);

                $clone
                    .find('[name="title"]').attr('name', 'agenda[' + agendaIndex + '].title').end()
                    .find('[name="proponents[]"]').attr('name', 'agenda[' + agendaIndex + '].proponents').end()
                    .find('[name="attachments[]"]').attr('name', 'agenda[' + agendaIndex + '].attachments').end();

            }).on('click', '.removeButton', function() {
                var $row  = $(this).parents('.form-group'),
                    index = $row.attr('data-agenda-index');
                $row.remove();
            });

            $('.proponents').multiselect({
                buttonWidth: '100%'
            });
        });
    </script>
@endpush
