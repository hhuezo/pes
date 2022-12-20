<div class="modal fade" id="modal-delete-{{ $obj->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{!! trans('job_application.Position') !!}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="{{ route('job_request_detail.destroy', $obj->id) }}" method="POST">
                @csrf
                @method('DELETE')
                {{$obj->id}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Do you want to delete the record?</h5>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
