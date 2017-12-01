
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <table width="100%">
                        <tr>
                            <td>
                                Create new Legislative Measure
                                {{-- <span class="badge badge-primary pull-right">Status: Open</span> --}}
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="panel-body">
                    @include('partials.message')
                    {!! Form::open(['route' => ['legislative.store'], 'files' => 'true']) !!}

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        {!! Form::label('law_type', 'Type of Law') !!}
                                        {!! Form::select('law_type', $ref_laws, null, ['class' => 'form-control', 'placeholder' => 'Select type of law']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        {!! Form::label('ord_res_no', 'Ord/Res No.') !!}
                                        {!! Form::text('ord_res_no', null, ['class' => 'form-control', 'placeholder' => 'Enter ord/res no.']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('title_subject', 'Title/Subject Matter') !!}
                                        {!! Form::textarea('title_subject', null, ['class' => 'form-control', 'placeholder' => 'Enter title/subject matter', 'rows' => '2']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('authors', 'Author/s') !!}
                                        <br>
                                        {!! Form::select('authors[]', $authors, null, ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'authors']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('sponsors', 'Sponsor/s') !!}
                                        <br>
                                        {!! Form::select('sponsors[]', $proponents, null, ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'sponsors']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('co_authors', 'Co-Author/s') !!}
                                        <br>
                                        {!! Form::select('co_authors[]', $co_authors, null, ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'co_authors']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('co_sponsors', 'Co-Sponsor/s') !!}
                                        <br>
                                        {!! Form::select('co_sponsors[]', $co_sponsors, null, ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'co_sponsors']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('referred_to', 'Referred To') !!}
                                        <br>
                                        {!! Form::select('referred_to[]', $referred_tos, null, ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'referred_to']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('referred_date', 'Referred Date') !!}
                                        {!! Form::text('referred_date', null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('committee_action', 'Committee Action') !!}
                                        {!! Form::select('committee_action', $committee_actions, null, ['class' => 'form-control', 'placeholder' => 'Select committee action']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('committee_action_date', 'Committee Action Date') !!}
                                        {!! Form::text('committee_action_date', null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('remarks', 'Remark/s') !!}
                                        {!! Form::textarea('remarks', null, ['class' => 'form-control', 'placeholder' => 'Enter remark/s', 'rows' => '2']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('reported', 'Reported?') !!}
                                        {!! Form::select('reported', $reported, null, ['class' => 'form-control', 'placeholder' => 'Select response']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('reported_date', 'Reported Date') !!}
                                        {!! Form::text('reported_date',null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('sb_action', 'SB Action') !!}
                                        {!! Form::select('sb_action', $sb_actions, null, ['class' => 'form-control', 'placeholder' => 'Select action']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('enacted_approved_date', 'Date Enacted/Approved') !!}
                                        {!! Form::text('enacted_approved_date',null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('date_transmitted_to_mayor', 'Date Transmitted to Mayor') !!}
                                        {!! Form::text('date_transmitted_to_mayor', null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('date_approved_by_mayor', 'Date Approved by Mayor') !!}
                                        {!! Form::text('date_approved_by_mayor', null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('date_transmitted_to_sp', 'Date Transmitted to SP') !!}
                                        {!! Form::text('date_transmitted_to_sp', null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('sp_action', 'SP Action') !!}
                                        {!! Form::textarea('sp_action', null, ['class' => 'form-control', 'placeholder' => 'Enter SP action', 'rows' => '2']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('sp_res_copy', 'SP Res. Copy') !!}
                                        {!! Form::file('sp_res_copy', ['class' => 'form']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('implemented', 'Implemented') !!}
                                        {!! Form::select('implemented', $implemented, null, ['class' => 'form-control', 'placeholder' => 'Select response']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('print_copy', 'Print Copy') !!}
                                        {!! Form::file('print_copy') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('vetoed', 'Vetoed?') !!}
                                        {!! Form::select('vetoed', $vetoed, null, ['class' => 'form-control', 'placeholder' => 'Select response']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('vetoed_reasons', 'Reason/s') !!}
                                        {!! Form::textarea('vetoed_reasons', null, ['class' => 'form-control', 'placeholder' => 'Enter reason/s', 'rows' => '2']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('notes', 'Note/s') !!}
                                        {!! Form::textarea('notes', null, ['class' => 'form-control', 'placeholder' => 'Enter note/s', 'rows' => '2']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('home') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
@endpush

@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#authors, #sponsors, #co_authors, #co_sponsors, #referred_to').multiselect({
                buttonWidth: '100%'
            });
        });
    </script>
@endpush
