<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Inventaris MTA</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('template_sertifikat') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('template_sertifikat') }}/assets/css/animate.min.css" rel="stylesheet" />
    <link href="{{ asset('template_sertifikat') }}/assets/css/style.min.css" rel="stylesheet" />
    <link href="{{ asset('template_sertifikat') }}/assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="{{ asset('template_sertifikat') }}/assets/plugins/font-awesome/css/font-awesome.min.css"
        rel="stylesheet" />
</head>

<body>
    <div id="page-container" class="page-container">
        <div id="content" class="content offset-md-2">
            <div class="row">
                <div class="col-md-offset-2 col-md-6 ">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                        <div class="panel-body">
                            <center>
                                <h5><b>Detail Inventaris PT. Mitra Tera Akurasi</b> </h5>
                            </center>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td style="width: 40%"> <b>Kode Inventaris</b> </td>
                                        <td style="width: 2%">:</td>
                                        <td style="width: 58%">{{ $inventaris->kode_inventaris }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Kode</b> </td>
                                        <td>:</td>
                                        <td>{{ $inventaris->kode }}</td>
                                    </tr>
                                    <tr>
                                        <td> <b>Tahun Pembelian</b> </td>
                                        <td>:</td>
                                        <td>{{ $inventaris->tahun_pembelian }}</td>
                                    </tr>
                                    <tr>
                                        <td> <b>Ruangan</b> </td>
                                        <td>:</td>
                                        <td>{{ $inventaris->nama_ruangan }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Jenis Alat</b></td>
                                        <td>:</td>
                                        <td>{{ $inventaris->jenis_alat }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Merek</b></td>
                                        <td>:</td>
                                        <td>{{ $inventaris->nama_merek }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Tipe</b></td>
                                        <td>:</td>
                                        <td>{{ $inventaris->tipe }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Serial Number</b></td>
                                        <td>:</td>
                                        <td>{{ $inventaris->serial_number }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Vendor</b></td>
                                        <td>:</td>
                                        <td>{{ $inventaris->nama_vendor }}</td>
                                    </tr>
                            </table>
                            <hr>
                            Powered by : <img src="{{ asset('frontend/img/logo.png') }}" alt=""
                                style="width: 40%;">
                        </div>
                    </div>
                </div>
            </div>
            <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade"
                data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        </div>
        <script src="{{ asset('template_sertifikat') }}/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
        <script src="{{ asset('template_sertifikat') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="{{ asset('template_sertifikat') }}/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="{{ asset('template_sertifikat') }}/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
        <script src="{{ asset('template_sertifikat') }}/assets/js/apps.min.js"></script>
</body>

</html>
