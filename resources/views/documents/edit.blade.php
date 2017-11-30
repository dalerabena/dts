
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
                                @if ($document->status == 0)
                                    Update Document
                                @elseif ($document->status == 1)
                                    Document Details
                                @endif
                                {{-- <span class="badge badge-primary">Status: Open</span> --}}
                                <div class="pull-right">
                                    @if ($document->status != 1)
                                        {{-- <a href="#" class="btn btn-success btn-sm">Forward </a> --}}
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#forwardDocument">Forward</button>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#closeDocument">Mark as Closed</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['documents.update', Hashids::encode($document->id)], 'method' => 'put', 'class' => 'form-horizontal', 'files' => 'true']) !!}

                        <div class="form-group{{ $errors->has('reference_number') ? ' has-error' : '' }}">
                            <label for="reference_number" class="col-md-4 control-label">Reference Number</label>

                            <div class="col-md-6">
                                {!! Form::text('reference_number', $document->reference_number, ['class' => 'form-control', $document->status == 1 ? 'readonly' : '' ]) !!}

                                @if ($errors->has('reference_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reference_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label for="date" class="col-md-4 control-label">Date</label>

                            <div class="col-md-6">
                                {!! Form::text('date', \Carbon\Carbon::parse($document->created_at)->toDayDateTimeString(), ['class' => 'form-control', 'readonly']) !!}

                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                            <label for="subject" class="col-md-4 control-label">Subject</label>

                            <div class="col-md-6">
                                {!! Form::text('subject', $document->subject, ['class' => 'form-control', $document->status == 1 ? 'readonly' : '' ]) !!}

                                @if ($errors->has('subject'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                            <label for="details" class="col-md-4 control-label">Details</label>

                            <div class="col-md-6">
                                {!! Form::textarea('details', $document->detail, ['class' => 'form-control', 'rows' => '3', $document->status == 1 ? 'readonly' : '' ]) !!}

                                @if ($errors->has('details'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('details') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                            <label for="priority" class="col-md-4 control-label">Priority</label>

                            <div class="col-md-6">
                                {!! Form::select('priority', $priorities, $document->priority, ['class' => 'form-control', 'disabled']) !!}

                                @if ($errors->has('priority'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('priority') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="department" class="col-md-4 control-label">Department</label>

                            <div class="col-md-6">
                                {!! Form::select('department', $users, $document->department, ['class' => 'form-control']) !!}

                                @if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}

                        <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                            <label for="comments" class="col-md-4 control-label">Comments</label>

                            <div class="col-md-6">
                                {!! Form::textarea('comments', $document->comment, ['class' => 'form-control', 'rows' => '3', $document->status == 1 ? 'readonly' : '' ]) !!}

                                @if ($errors->has('comments'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comments') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="form-group{{ $errors->has('attachment') ? ' has-error' : '' }}">
                            <label for="attachment" class="col-md-4 control-label">Attachment</label>

                            <div class="col-md-6">
                                {!! Form::file('attachment[]', ['multiple']) !!}

                                @if ($errors->has('attachment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attachment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}

                        @if ($document->status != 1)
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                    {{-- <a href="{{ route('home') }}" class="btn btn-default">Cancel</a> --}}
                                </div>
                            </div>
                        @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    History
                </div>
                <div class="panel-body" style="min-height: 300px; max-height: 450px; overflow-y: scroll;">
                    <table class="table table-striped table-hover">
                        @foreach ($document->history as $key => $value)
                            <tr>
                                <td>
                                    @if ($value->action == 0)
                                        Document created by {{ $value->user->name }} at {{ \Carbon\Carbon::parse($value->created_at)->toDayDateTimeString() }}
                                    @elseif ($value->action == 1)
                                        Document updated by {{ $value->user->name }} at {{ \Carbon\Carbon::parse($value->created_at)->toDayDateTimeString() }} <br>
                                        Previous comment: {{ $value->comment }} {{ \Carbon\Carbon::parse($value->created_at)->toDayDateTimeString() }}
                                    @elseif ($value->action == 2)
                                        Document forwarded to {{ $value->forwarded_to }} at {{ \Carbon\Carbon::parse($value->created_at)->toDayDateTimeString() }}
                                    @elseif ($value->action == 3)
                                        Document closed by {{ $value->user->name }} at {{ \Carbon\Carbon::parse($value->created_at)->toDayDateTimeString() }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        @include('documents.partials.modal')
    </div>
</div>
@endsection
