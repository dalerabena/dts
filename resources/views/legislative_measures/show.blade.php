
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
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="panel-body">
                    @include('partials.message')
                    {!! Form::open(['route' => ['legislative.update', Hashids::encode($legislative_measure->id)], 'method' => 'put', 'files' => 'true']) !!}

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        {!! Form::label('law_type', 'Type of Law') !!}
                                        {!! Form::select('law_type', $ref_laws, $legislative_measure->law_type, ['class' => 'form-control', 'placeholder' => 'Select type of law']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        {!! Form::label('ord_res_no', 'Ord/Res No.') !!}
                                        {!! Form::text('ord_res_no', $legislative_measure->ord_res_no, ['class' => 'form-control', 'placeholder' => 'Enter ord/res no.']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('title_subject', 'Title/Subject Matter') !!}
                                        {!! Form::textarea('title_subject', $legislative_measure->title_subject, ['class' => 'form-control', 'placeholder' => 'Enter title/subject matter', 'rows' => '2']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('authors', 'Author/s') !!}
                                        <br>
                                        {!! Form::select('authors[]', $authors, explode('###', $legislative_measure->authors), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'authors']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('proponents', 'Sponsor/s') !!}
                                        <br>
                                        {!! Form::select('proponents[]', $proponents, explode('###', $legislative_measure->proponents), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'proponents']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('co_authors', 'Co-Author/s') !!}
                                        <br>
                                        {!! Form::select('co_authors[]', $co_authors, explode('###', $legislative_measure->co_authors), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'co_authors']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('co_sponsors', 'Co-Sponsor/s') !!}
                                        <br>
                                        {!! Form::select('co_sponsors[]', $co_sponsors, explode('###', $legislative_measure->co_sponsors), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'co_sponsors']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('referred_to', 'Referred To') !!}
                                        <br>
                                        {!! Form::select('referred_to[]', $referred_tos, explode('###', $legislative_measure->referred_to), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'referred_to']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('referred_when', 'Referred When') !!}
                                        {!! Form::text('referred_when', $legislative_measure->referred_when, ['class' => 'form-control', 'placeholder' => 'Entered referred when']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('committee_action', 'Committee Action') !!}
                                        {!! Form::select('committee_action', $committee_actions, $legislative_measure->committee_action, ['class' => 'form-control', 'placeholder' => 'Select committee action']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('committee_action_date', 'Committee Action Date') !!}
                                        {!! Form::text('committee_action_date', $legislative_measure->committee_action_date, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('remarks', 'Remark/s') !!}
                                        {!! Form::textarea('remarks', $legislative_measure->remarks, ['class' => 'form-control', 'placeholder' => 'Enter remark/s', 'rows' => '2']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('reported', 'Reported?') !!}
                                        {!! Form::select('reported', $reported, $legislative_measure->reported, ['class' => 'form-control', 'placeholder' => 'Select response']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('reported_when', 'Reported When') !!}
                                        {!! Form::text('reported_when', $legislative_measure->reported_when, ['class' => 'form-control', 'placeholder' => 'Enter reported when']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('sb_action', 'SB Action') !!}
                                        {!! Form::select('sb_action', $sb_actions, $legislative_measure->sb_action, ['class' => 'form-control', 'placeholder' => 'Select action']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('enacted_approved_date', 'Date Enacted/Approved') !!}
                                        {!! Form::text('enacted_approved_date', $legislative_measure->enacted_approved_date, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('date_transmitted_to_mayor', 'Date Transmitted to Mayor') !!}
                                        {!! Form::text('date_transmitted_to_mayor', $legislative_measure->date_transmitted_to_mayor, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('date_approved_by_mayor', 'Date Approved by Mayor') !!}
                                        {!! Form::text('date_approved_by_mayor', $legislative_measure->date_approved_by_mayor, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('date_transmitted_to_sp', 'Date Transmitted to SP') !!}
                                        {!! Form::text('date_transmitted_to_sp', $legislative_measure->date_transmitted_to_sp, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('sp_action', 'SP Action') !!}
                                        {!! Form::textarea('sp_action', $legislative_measure->sp_action, ['class' => 'form-control', 'placeholder' => 'Enter SP action', 'rows' => '2']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('copies[sp_res_copy]', 'SP Res. Copy') !!}
                                        <br>
                                        {!! Form::file('copies[sp_res_copy]', ['class' => 'form']) !!}
                                        @if ($sp_res_copy->count() > 0)
                                            @foreach ($sp_res_copy as $key => $value)
                                                <a href="{{ asset("storage/$value->path") }}" target="_blank">{{ $value->filename }}</a>
                                                <br>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('implemented', 'Implemented') !!}
                                        {!! Form::select('implemented', $implemented, $legislative_measure->implemented, ['class' => 'form-control', 'placeholder' => 'Select response']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('copies[print_copy]', 'Print Copy') !!}
                                        <br>
                                        {!! Form::file('copies[print_copy]') !!}
                                        @if ($print_copy->count() > 0)
                                            @foreach ($print_copy as $key => $value)
                                                <a href="{{ asset("storage/$value->path") }}" target="_blank">{{ $value->filename }}</a>
                                                <br>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('vetoed', 'Vetoed?') !!}
                                        {!! Form::select('vetoed', $vetoed, $legislative_measure->vetoed, ['class' => 'form-control', 'placeholder' => 'Select response']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('vetoed_reasons', 'Reason/s') !!}
                                        {!! Form::textarea('vetoed_reasons', $legislative_measure->vetoed_reasons, ['class' => 'form-control', 'placeholder' => 'Enter reason/s', 'rows' => '2']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('notes', 'Note/s') !!}
                                        {!! Form::textarea('notes', $legislative_measure->notes, ['class' => 'form-control', 'placeholder' => 'Enter note/s', 'rows' => '2']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('legislative.index') }}" class="btn btn-default">Cancel</a>
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
            $('#authors, #proponents, #co_authors, #co_sponsors, #referred_to').multiselect({
                buttonWidth: '100%'
            });
        });
    </script>
@endpush
