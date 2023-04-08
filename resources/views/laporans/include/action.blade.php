<td>

    <div class="btn-group">
        <button type="button" title="Other" class="btn btn-outline-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"> <i class="fa fa-print"></i> </button>
        <div class="dropdown-menu" style="">
            <a href="https://iot.easytopup.my.id/panel/device/12/edit" class="dropdown-item">Lembar Kerja</a>
            <a href="https://iot.easytopup.my.id/panel/device/12" class="dropdown-item">Sertifikat</a>
            <a href="https://iot.easytopup.my.id/panel/device/12/edit" class="dropdown-item">QR Scan Sertifikat</a>
        </div>
    </div>

    @can('laporan view')
        <a href="{{ route('laporans.show', $model->id) }}" title="Detail Laporan" class="btn btn-outline-success btn-sm">
            <i class="fa fa-eye"></i>
        </a>
    @endcan
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
