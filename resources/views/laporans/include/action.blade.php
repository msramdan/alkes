<td>

    <div class="btn-group">
        <button type="button" title="Other" class="btn btn-outline-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"> <i class="fa fa-print"></i> </button>
        <div class="dropdown-menu" style="">
            <a href="{{ route('pdf_lk', $model->id) }}" target="_blank" class="dropdown-item">LK Input</a>
            <a href="{{ route('pdf_lk_scorsing', $model->id) }}" target="_blank" class="dropdown-item">LK Skorsing</a>
            <a href="{{ route('pdf_lk', $model->id) }}" target="_blank" class="dropdown-item">Laporan Hasil</a>
            {{-- <a href="#" type="button" class="dropdown-item" data-bs-toggle="modal"
                data-bs-target="#modalQr{{ $model->id }}">E-Sertifikat
            </a> --}}
            <a href="#" type="button" class="dropdown-item" data-bs-toggle="modal"
                data-bs-target="#modalQr{{ $model->id }}">Qr Code
            </a>

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
                                                <span style="font-size: 11px"><b>Date : 2023-06-30</b></span><br>
                                                <span style="font-size: 11px"><b>Due : 2024-06-30</b></span>
                                            </td>
                                        </tr>
                                        <tr style="background-color: green;">
                                            <td style="text-align: center;">
                                                <b style="color: white"><i class="fa fa-check" aria-hidden="true"></i>
                                                    LAIK PAKAI</b>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class=" col-md-6">
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
                                                <span style="font-size: 11px"><b>Date : 2023-06-30</b></span><br>
                                                <span style="font-size: 11px"><b>Due : 2024-06-30</b></span>
                                            </td>
                                        </tr>
                                        <tr style="background-color: green;">
                                            <td style="text-align: center;">
                                                <b style="color: white"><i class="fa fa-check" aria-hidden="true"></i>
                                                    LAIK PAKAI</b>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @if ($model->status_laporan == 'Initial')
        @can('laporan edit')
            <a href="{{ route('laporans.edit', $model->id) }}" class="btn btn-outline-primary btn-sm">
                <i class="fa fa-pencil-alt"></i>
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
    @endif

</td>
