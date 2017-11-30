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
                {!! Form::text('date_created', null, ['class' => 'form-control', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd', 'placeholder' => 'yyyy-mm-dd']) !!}
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