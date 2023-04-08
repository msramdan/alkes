<td>

    <div class="btn-group">
        <button type="button" title="Other" class="btn btn-outline-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"> <i class="fa fa-print"></i> </button>
        <div class="dropdown-menu" style="">
            <a href="" class="dropdown-item">Lembar Kerja</a>
            <a href="" class="dropdown-item">Sertifikat</a>
            <a href="#" type="button" class="dropdown-item" data-bs-toggle="modal"
                data-bs-target="#modalQr{{ $model->id }}">
                QR Scan Sertifikat
            </a>
        </div>

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


                        @if ($model->status_laporan != 'Need Review')
                            @php
                                $string = url('/') . '/' . 'e_sertifikat/' . '' . $model->id;
                            @endphp
                            <center>
                                {!! QrCode::size(150)->generate($string) !!}
                                <p style="margin-top: 10px"><b>E-Sertifikat</b></p>
                            </center>
                        @else
                            <center>
                                <h5 style="color: red">Tidak tersedia status laporan masih "Need Review"</h4>
                            </center>
                        @endif

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        @if ($model->status_laporan != 'Need Review')
                            <a href="" target="_blank" class="btn btn-danger "> <i class="fa fa-print"
                                    aria-hidden="true"></i>
                                Print</a>
                        @endif

                    </div>
                </div>
            </div>
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
