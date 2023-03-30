<td>
    @can('laporan view')
        <a href="{{ route('laporans.show', $model->id) }}" title="Detail Laporan" class="btn btn-outline-success btn-sm">
            <i class="fa fa-eye"></i>
        </a>
    @endcan

    <a href="{{ route('laporans.show', $model->id) }}" title="Cetak Laporan" class="btn btn-outline-warning btn-sm">
        <i class="fa fa-print"></i>
    </a>
    {{-- @can('laporan edit')
        <a href="{{ route('laporans.edit', $model->id) }}" class="btn btn-outline-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endcan --}}
    @can('laporan delete')
        <form action="{{ route('laporans.destroy', $model->id) }}" method="post" class="d-inline"
            onsubmit="return confirm('Are you sure to delete this record?')">
            @csrf
            @method('delete')

            <button class="btn btn-outline-danger btn-sm">
                <i class="ace-icon fa fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</td>
