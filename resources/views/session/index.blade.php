@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Find Session</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="GET" action="{{ route('session_index') }}">

                        @include('partials.message')

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Session ID</label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control" name="id" value="" placeholder="Enter session id" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Continue
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
