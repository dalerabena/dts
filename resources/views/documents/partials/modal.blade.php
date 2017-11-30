<div class="modal fade" id="closeDocument" tabindex="-1" role="dialog" aria-labelledby="closeDocumentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h5 class="modal-title" id="closeDocumentLabel">
                    Are you sure?
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </h5>
            </div> --}}
            <div class="modal-body">
                 <h5 class="modal-title" id="closeDocumentLabel">
                    Are you sure?
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </h5>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-primary">Yes, Close document</button> --}}
                {{-- <a href="{{ route('document.close', [ Hashids::encode($document->id) ]) }}" class="btn btn-primary">Yes, Close document</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> --}}
                {!! Form::open(['route' => ['document.close', Hashids::encode($document->id)], 'method' => 'put']) !!}
                    {!! Form::submit('Yes, Close document', ['class' => 'btn btn-primary']) !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="forwardDocument" tabindex="-1" role="dialog" aria-labelledby="forwardDocumentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forwardDocumentLabel">
                    Forwarded Document
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </h5>
            </div>
            {!! Form::open(['route' => ['document.forward', Hashids::encode($document->id)], 'method' => 'put']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('forward_to', 'Forward to') !!}
                    {!! Form::text('forward_to', null, ['class' => 'form-control', 'placeholder' => 'Enter forwarded to']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('forward_comments', 'Comments') !!}
                    {!! Form::textarea('forward_comments', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Enter comments']) !!}
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>