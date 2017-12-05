<div class="modal fade" id="deleteRecord" tabindex="-1" role="dialog" aria-labelledby="deleteRecordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                 <h5 class="modal-title" id="deleteRecordLabel">
                    Are you sure you want to delete this record?
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </h5>
            </div>
            <div class="modal-footer">
                {!! Form::open(['route' => ['legislative.destroy', Hashids::encode($legislative_measure->id)], 'method' => 'delete']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                {!! Form::close() !!}
                {{-- <form class="pull-right" method="POST" action="{{ route('legislative.destroy', [ Hashids::encode($legislative_measure->id) ]) }}" onsubmit="return confirm('Are you sure you want to delete this record?');">
                    {{ csrf_field() }}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                </form> --}}
            </div>
        </div>
    </div>
</div>
