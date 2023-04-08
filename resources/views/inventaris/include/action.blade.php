<td>
    <a href="" title="QR For Sertifikat" class="btn btn-outline-dark btn-sm">
        <i class="fa fa-qrcode"></i>
    </a>
    @can('inventari edit')
        <a href="{{ route('inventaris.edit', $model->id) }}" class="btn btn-outline-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endcan

    @can('inventari delete')
        <form action="{{ route('inventaris.destroy', $model->id) }}" method="post" class="d-inline"
            onsubmit="return confirm('Are you sure to delete this record?')">
            @csrf
            @method('delete')

            <button class="btn btn-outline-danger btn-sm">
                <i class="ace-icon fa fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</td>
