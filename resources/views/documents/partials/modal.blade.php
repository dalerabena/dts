<div class="modal fade" id="closeDocument" tabindex="-1" role="dialog" aria-labelledby="closeDocumentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="closeDocumentLabel">
                    Are you sure?
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </h5>
            </div>
            {{-- <div class="modal-body">
            </div> --}}
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-primary">Yes, Close document</button> --}}
                <a href="{{ route('document.close', [ Hashids::encode($document->id) ]) }}" class="btn btn-primary">Yes, Close document</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
