@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Filter Settings
                </div>
                <div class="panel-body">
                    {!! Form::open(['method' => 'get']) !!}
                        <div class="form-group">
                            {!! Form::label('reference_number', 'Reference Number') !!}
                            {!! Form::text('reference_number', null, ['class' => 'form-control', 'placeholder' => 'Enter reference number']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('subject', 'Subject') !!}
                            {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Enter subject']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('date_created', 'Date Created') !!}
                            {!! Form::date('date_created', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('priority', 'Priority') !!}
                            {!! Form::select('priority', $priorities, null, ['class' => 'form-control', 'placeholder' => 'Select priority']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('status', 'Status') !!}
                            {!! Form::select('status', $status, null, ['class' => 'form-control', 'placeholder' => 'Select status']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Filter', ['class' => 'btn btn-primary btn-block']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Documents
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="4%">#</th>
                                <th width="20%">Reference Number</th>
                                <th width="35%">Subject</th>
                                <th>Date Created</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th width="5%">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($documents->count() > 0)
                                @foreach($documents as $key => $document)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $document->reference_number }}</td>
                                        <td>{{ $document->subject }}</td>
                                        <td>{{ \Carbon\Carbon::parse($document->created_at)->toDayDateTimeString() }}</td>
                                        @if ($document->priority == 1)
                                            <td class="text-success">
                                        @elseif ($document->priority == 2)
                                            <td class="text-warning">
                                        @elseif ($document->priority == 3)
                                            <td class="text-danger">
                                        @endif
                                            {{ $document->refPriority->desc }}</td>
                                        <td>{{ $document->status ? 'Closed' : 'Open' }}</td>
                                        <td>
                                            <a href="{{ route('documents.show', [ Hashids::encode($document->id) ]) }}" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">No document/s found.</td>
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
