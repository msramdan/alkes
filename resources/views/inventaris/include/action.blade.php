<td>
    <a href="{{ route('inventarisSertifikat', $model->id) }}" class="btn btn-success btn-sm" title="Sertifikat">
        <i class="fa fa-certificate" aria-hidden="true"></i>
    </a>

    <a href="#" title="QR Code" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal"
        data-bs-target="#modalQr{{ $model->id }}">
        <i class="fa fa-qrcode"></i>
    </a>

    {{-- download qr --}}
    <div class="modal fade" id="modalQr{{ $model->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">QR Scan Sertifikat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @php
                        $string = url('/') . '/' . 'info_inventaris/' . '' . $model->id;
                    @endphp
                    <center>
                        {!! QrCode::size(150)->generate($string) !!}
                        <p style="margin-top: 10px"><b>Inventaris {{ $model->kode_inventaris }}</b></p>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="" target="_blank" class="btn btn-danger "> <i class="fa fa-print"
                            aria-hidden="true"></i>
                        Print</a>
                </div>
            </div>
        </div>
    </div>

    @can('inventari edit')
        <a href="{{ route('inventaris.edit', $model->id) }}" title="Edit" class="btn btn-outline-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endcan

    @can('inventari delete')
        <form action="{{ route('inventaris.destroy', $model->id) }}" method="post" title="Hapus" class="d-inline"
            onsubmit="return confirm('Are you sure to delete this record?')">
            @csrf
            @method('delete')

            <button class="btn btn-outline-danger btn-sm">
                <i class="ace-icon fa fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</td>
