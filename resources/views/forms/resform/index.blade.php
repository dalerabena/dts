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
                        {!! Form::label('resolution_no', 'Resolution Number') !!}
                        {!! Form::text('resolution_no', null, ['class' => 'form-control', 'placeholder' => 'Enter resolution number', 'id' => 'resolution_no']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter title']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('approved_date', 'Date Approved') !!}
                        {!! Form::text('approved_date', null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd']) !!}
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
                    All Resform Records
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="30%">Resolution Number</th>
                                <th>Title</th>
                                <th>Date Approved</th>
                                <th width="5%">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($records->count() > 0)
                                @foreach($records as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->resolution_no }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->approved_date }}</td>
                                        <td>
                                            <a href="{{ route('resform.show', [ Hashids::encode($value->id) ]) }}" class="btn btn-primary btn-sm">View</a>
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

@push('scripts')
    <script src="{{ asset('js/bootstrap3-typeahead.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.get('{{ route('resform_resnos') }}', function(data) {
                $('#resolution_no').typeahead({
                    source: data
                });
            });
        });
    </script>
@endpush
