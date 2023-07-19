{{-- modal approved --}}
<div class="modal fade" id="modalApproved{{ $model->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approved Lembar Kerja {{ $model->no_laporan }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('updateStatus') }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Catatan</label>
                        <input type="hidden" name="id" id="id" value="{{ $model->id }}">
                        <input type="hidden" name="status_laporan" id="status_laporan" value="Approved">
                        <textarea class="form-control" id="catatan" name="catatan" rows="3" required></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" >Approved</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal rejected --}}
<div class="modal fade" id="modalRejected{{ $model->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rejected Lembar Kerja {{ $model->no_laporan }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('updateStatus') }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Catatan</label>
                        <input type="hidden" name="id" id="id" value="{{ $model->id }}">
                        <input type="hidden" name="status_laporan" id="status_laporan" value="Rejected">
                        <textarea class="form-control" id="catatan" name="catatan" rows="3" required></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" >Rejected</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- download qr --}}
<div class="modal fade" id="modalQr{{ $model->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">QR Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class=" col-md-6">
                        <center>
                            <table style="padding: 5px;width:150px; border: 1px solid;border-radius: 5px;">
                                @php
                                    $string = url('/') . '/' . 'e_sertifikat/' . '' . $model->id;
                                @endphp
                                <thead>
                                    <tr>
                                        <td>
                                            <center>
                                                <img src="{{ asset('asset/logo.png') }}" style="width: 100%">
                                            </center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 5px">
                                            <center>
                                                {!! QrCode::size(100)->generate($string) !!}
                                            </center>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom: 1pt solid black;">
                                        <td style="text-align: center;">
                                            <span style="font-size: 11px"><b>{{ $model->no_laporan }}</b></span>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom: 1pt solid black;">
                                        <td style="text-align: center;">
                                            <span style="font-size: 11px"><b>Date : {{date('d F Y', strtotime($model->tgl_laporan))}} </b></span><br>
                                            <span style="font-size: 11px"><b>Due : {{date('d F Y', strtotime('+1 year', strtotime( $model->tgl_laporan )))}}</b></span>
                                        </td>
                                    </tr>
                                    <tr style="background-color: green;">
                                        <td style="text-align: center;">
                                            <b style="color: white"><i class="fa fa-check" aria-hidden="true"></i>
                                                LAIK PAKAI</b>
                                        </td>
                                    </tr>
                                </thead>
                            </table> <br>
                            <a href="{{ route('qr_layak', $model->id) }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print" aria-hidden="true"></i>
                                Cetak</a>
                        </center>

                    </div>
                    <div class=" col-md-6">
                        <center>
                            <table style="padding: 5px;width:150px; border: 1px solid;border-radius: 5px;">
                                @php
                                    $string = url('/') . '/' . 'e_sertifikat/' . '' . $model->id;
                                @endphp
                                <thead>
                                    <tr>
                                        <td>
                                            <center>
                                                <img src="{{ asset('asset/logo.png') }}" style="width: 100%">
                                            </center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 5px">
                                            <center>
                                                {!! QrCode::size(100)->generate($string) !!}
                                            </center>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom: 1pt solid black;">
                                        <td style="text-align: center;">
                                            <span style="font-size: 11px"><b>{{ $model->no_laporan }}</b></span>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom: 1pt solid black;">
                                        <td style="text-align: center;">
                                            <span style="font-size: 11px"><b>Date : {{date('d F Y', strtotime($model->tgl_laporan))}} </b></span><br>
                                            <span style="font-size: 11px"><b>Due : {{date('d F Y', strtotime('+1 year', strtotime( $model->tgl_laporan )))}}</b></span>
                                        </td>
                                    </tr>
                                    <tr style="background-color: red;">
                                        <td style="text-align: center;">
                                            <b style="color: white"><i class="fa fa-times" aria-hidden="true"></i>
                                                TIDAK LAIK</b>
                                        </td>
                                    </tr>
                                </thead>
                            </table> <br>
                            <a href="{{ route('qr_tidak_layak', $model->id) }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print" aria-hidden="true"></i>
                                Cetak</a>

                        </center>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<td>
    <div class="btn-group">
        <button type="button" title="Other" class="btn btn-outline-primary btn-sm dropdown-toggle"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-print"></i>
        </button>
        <div class="dropdown-menu" style="">
            @if ($model->status_laporan != 'Initial')
                {{-- <a href="{{ route('pdf_lk', $model->id) }}" target="_blank" class="dropdown-item">LK Input</a> --}}
                <a href="{{ route('pdf_lk_scorsing', $model->id) }}" target="_blank" class="dropdown-item">LK
                    Skorsing</a>
                <a href="{{ route('pdf_lk_laporan', $model->id) }}" target="_blank" class="dropdown-item">Laporan Hasil</a>
                <a href="{{ route('pdf_sertifikat', $model->id) }}" target="_blank" class="dropdown-item">E-Sertifikat
                </a></a>
            @endif
            <a href="#" type="button" class="dropdown-item" data-bs-toggle="modal"
                data-bs-target="#modalQr{{ $model->id }}">Qr Code
            </a>
        </div>

    </div>

    <div class="btn-group">
        <button type="button" title="Other" class="btn btn-outline-dark btn-sm dropdown-toggle"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-cog"></i>
        </button>
        <div class="dropdown-menu" style="">
            @if ($model->status_laporan != 'Initial')
                <a href="#" title="Approved" class="dropdown-item" data-bs-toggle="modal"
                    data-bs-target="#modalApproved{{ $model->id }}">Approved</a>
                <a href="#" title="Rejected" class="dropdown-item" data-bs-toggle="modal"
                    data-bs-target="#modalRejected{{ $model->id }}">Rejected</a>
            @endif
            @if ($model->status_laporan == 'Initial')
                @can('laporan edit')
                    <a href="{{ route('laporans.edit', $model->id) }}" title="Rejected" class="dropdown-item">Edit</a>
                @endcan
                @can('laporan delete')
                    <form action="{{ route('laporans.destroy', $model->id) }}" title="Delete" method="post"
                        onsubmit="return confirm('Are you sure to delete this record?')">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm">Hapus
                        </button>
                    </form>
                @endcan
            @endif
        </div>
    </div>
</td>
