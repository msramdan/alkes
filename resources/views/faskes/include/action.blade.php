{{-- modal approved --}}
<div class="modal fade" id="modalPin{{ $model->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update PIN {{ $model->nama_faskes }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('updatePin') }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">PIN</label>
                        <input type="hidden" name="id" id="id" value="{{ $model->id }}">
                        <input type="text" class="form-control" name="pin" id="pin" value="{{ $model->pin }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<td>
    <a href="#" title="Update PIN" class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
        data-bs-target="#modalPin{{ $model->id }}">
        <i class="fa fa-cog"></i>
    </a>

    @can('faske edit')
        <a href="{{ route('faskes.edit', $model->id) }}" class="btn btn-outline-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endcan

    @can('faske delete')
        <form action="{{ route('faskes.destroy', $model->id) }}" method="post" class="d-inline"
            onsubmit="return confirm('Are you sure to delete this record?')">
            @csrf
            @method('delete')

            <button class="btn btn-outline-danger btn-sm">
                <i class="ace-icon fa fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</td>
