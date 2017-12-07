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
                        {!! Form::label('ordinance_no', 'Oridance Number') !!}
                        {!! Form::text('ordinance_no', null, ['class' => 'form-control', 'placeholder' => 'Enter ordinance number', 'id' => 'ordinance_no']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name', 'id' => 'name']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('status', 'Status') !!}
                        {!! Form::select('status', $status, null, ['class' => 'form-control', 'placeholder' => 'Select status']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('brgy', 'Barangay') !!}
                        {!! Form::select('brgy', $brgys, null, ['class' => 'form-control', 'placeholder' => 'Select barangay']) !!}
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
                    All Franform Records
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="30%">Ordinance Number</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th width="5%">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($records->count() > 0)
                                @foreach($records as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->ordinance_no }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->status }}</td>
                                        <td>
                                            <a href="{{ route('franform.show', [ Hashids::encode($value->id) ]) }}" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">No document/s found.</td>
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
        $(function() {
            $.get('{{ route('franform_ordnos') }}', function(data) {
                $('#ordinance_no').typeahead({
                    source: data
                });
            });
            $.get('{{ route('franform_names') }}', function(data) {
                $('#name').typeahead({
                    source: data
                });
            });
        });
    </script>
@endpush
