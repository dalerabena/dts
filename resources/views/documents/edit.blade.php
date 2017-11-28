
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <table width="100%">
                        <tr>
                            <td>
                                Update Tracking
                                <span class="badge badge-primary pull-right">Status: Open</span>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="panel-body">
                    @include('partials.message')
                    {!! Form::open(['route' => ['documents.update', Hashids::encode($document->id)], 'method' => 'put', 'class' => 'form-horizontal', 'files' => 'true']) !!}

                        <div class="form-group{{ $errors->has('reference_number') ? ' has-error' : '' }}">
                            <label for="reference_number" class="col-md-4 control-label">Reference Number</label>

                            <div class="col-md-6">
                                {!! Form::text('reference_number', $document->reference_number, ['class' => 'form-control']) !!}

                                @if ($errors->has('reference_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reference_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                            <label for="subject" class="col-md-4 control-label">Subject</label>

                            <div class="col-md-6">
                                {!! Form::text('subject', $document->subject, ['class' => 'form-control']) !!}

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
                                {!! Form::textarea('details', $document->detail, ['class' => 'form-control', 'rows' => '3']) !!}

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
                                {!! Form::select('priority', $priorities, $document->priority, ['class' => 'form-control']) !!}

                                @if ($errors->has('priority'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('priority') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="department" class="col-md-4 control-label">Department</label>

                            <div class="col-md-6">
                                {!! Form::select('department', $users, $document->department, ['class' => 'form-control']) !!}

                                @if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                            <label for="comments" class="col-md-4 control-label">Comments</label>

                            <div class="col-md-6">
                                {!! Form::textarea('comments', $document->initial_comment, ['class' => 'form-control', 'rows' => '3']) !!}

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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                                <a href="#" class="btn btn-success">Forward </a>
                                <a href="#" class="btn btn-warning">Mark as Closed</a>
                                <a href="{{ route('home') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Comments
                </div>
                <div class="panel-body" style="min-height: 300px; max-height: 450px; overflow-y: scroll;">
                    <table class="table">
                        <tr>
                            <td>asdfas</td>
                            <td>asdfsdf</td>
                        </tr>
                        <tr>
                            <td>asdfas</td>
                            <td>asdfsdf</td>
                        </tr>
                        <tr>
                            <td>asdfas</td>
                            <td>asdfsdf</td>
                        </tr>
                        <tr>
                            <td>asdfas</td>
                            <td>asdfsdf</td>
                        </tr>
                        <tr>
                            <td>asdfas</td>
                            <td>asdfsdf</td>
                        </tr>
                        <tr>
                            <td>asdfas</td>
                            <td>asdfsdf</td>
                        </tr>
                        <tr>
                            <td>asdfas</td>
                            <td>asdfsdf</td>
                        </tr>
                        <tr>
                            <td>asdfas</td>
                            <td>asdfsdf</td>
                        </tr>
                        <tr>
                            <td>asdfas</td>
                            <td>asdfsdf</td>
                        </tr>
                        <tr>
                            <td>asdfas</td>
                            <td>asdfsdf</td>
                        </tr>
                        <tr>
                            <td>asdfas</td>
                            <td>asdfsdf</td>
                        </tr>
                        <tr>
                            <td>asdfas</td>
                            <td>asdfsdf</td>
                        </tr>
                        <tr>
                            <td>asdfas</td>
                            <td>asdfsdf</td>
                        </tr>
                        <tr>
                            <td>asdfas</td>
                            <td>asdfsdf</td>
                        </tr>
                        <tr>
                            <td>asdfas</td>
                            <td>asdfsdf</td>
                        </tr>
                        <tr>
                            <td>asdfas</td>
                            <td>asdfsdf</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
