<!DOCTYPE html>
<html>
    <style>
        @page {
            margin: 0px 0px 0px 0px
        }
    </style>
<head>
    <title>QR Layak {{ $laporan->no_laporan }} </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
    <table style="padding: 5px;width:150px; border: 1px solid;border-radius: 5px;">
        @php
            $string = url('/') . '/' . 'e_sertifikat/' . '' . $laporan->id;
        @endphp
        <thead>
            <tr>
                <td>
                    <center>
                        <img src="../public/asset/logo.png" style="width: 100%">
                    </center>
                </td>
            </tr>
            <tr>
                <td style="padding: 5px">
                    <center>
                        <img style="width: {{ $widthQR }}px;" src="data:image/png;base64, {!! base64_encode(QrCode::generate($string)) !!} ">
                    </center>
                </td>
            </tr>
            <tr style="border-bottom: 1pt solid black;">
                <td style="text-align: center;">
                    <span style="font-size: 11px"><b>{{ $laporan->no_laporan }}</b></span>
                </td>
            </tr>
            <tr style="border-bottom: 1pt solid black;">
                <td style="text-align: center;">
                    <span style="font-size: 11px"><b>Date : {{date('d F Y', strtotime($laporan->tgl_laporan))}} </b></span><br>
                    <span style="font-size: 11px"><b>Due : {{date('d F Y', strtotime('+1 year', strtotime( $laporan->tgl_laporan )))}}</b></span>
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
</body>
</html>
