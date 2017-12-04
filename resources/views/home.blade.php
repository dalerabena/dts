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
                        {!! Form::label('law_type', 'Type of Law') !!}
                        {!! Form::select('law_type', $ref_laws, null, ['class' => 'form-control', 'placeholder' => 'Select type of law']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('ord_res_no', 'Ord/Res No.') !!}
                        {!! Form::text('ord_res_no', null, ['class' => 'form-control', 'placeholder' => 'Enter ord/res no.', 'id' => 'ord_res_no']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('title_subject', 'Subject Matter') !!}
                        {!! Form::text('title_subject', null, ['class' => 'form-control', 'placeholder' => 'Enter subject matter', 'id' => 'title_subject']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('sb_action', 'SB Action') !!}
                        {!! Form::select('sb_action', $sb_actions, null, ['class' => 'form-control', 'placeholder' => 'Select sb action']) !!}
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
                    All Documents
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="4%">#</th>
                                <th width="20%">Type of Law</th>
                                <th width="35%">Ord/Res No.</th>
                                <th>Subject Matter</th>
                                <th width="5%">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($legislative_measures->count() > 0)
                                @foreach($legislative_measures as $key => $value)
                                    {{$value->law_detail}}
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->law_details->type }}</td>
                                        <td>{{ $value->ord_res_no }}</td>
                                        <td>{{ $value->title_subject }}</td>
                                        <td>
                                            <a href="{{ route('legislative.show', [ Hashids::encode($value->id) ]) }}" class="btn btn-primary btn-sm">View</a>
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

@push('scripts')
    <script src="{{ asset('js/bootstrap3-typeahead.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.get('{{ route('ord_res_no') }}', function(data) {
                $('#ord_res_no').typeahead({
                    source: data
                });
            });
            $.get('{{ route('title_subject') }}', function(data) {
                $('#title_subject').typeahead({
                    source: data
                });
            });
        });
    </script>
@endpush
