<!DOCTYPE html>
<html>

<head>
    <title>LK Scorsing {{ $nomenklaturs->nama_nomenklatur }} </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<style>
    hr.s1 {
        height: 1px;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        margin-top: 7px
    }

    .new {
        padding: 50px;
    }

    .form-group {
        display: block;
        margin-bottom: 15px;
    }

    .form-group input {
        padding: 0;
        height: initial;
        width: initial;
        margin-bottom: 0;
        display: none;
        cursor: pointer;
    }

    .form-group label {
        position: relative;
        cursor: pointer;
    }

    .form-group label:before {
        content: '';
        -webkit-appearance: none;
        background-color: transparent;
        border: 1px solid #000000;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
        padding: 5px;
        display: inline-block;
        position: relative;
        vertical-align: middle;
        cursor: pointer;
        margin-right: 5px;
    }

    .form-group input:checked+label:after {
        content: '';
        display: block;
        position: absolute;
        top: -5px;
        left: 5px;
        width: 6px;
        height: 12px;
        border: solid #000000;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    thead {
        display: table-row-group;
    }
</style>


<body>
    <table style="line-height: 8px; font-size:13px">
        <tr>
            <td style="width: 40%">
                <img src="../public/asset/logo.png" style="width: 100%">
            </td>
            <td>
                <h6>
                    <center>
                        <b>
                            LEMBAR KERJA PENGUJIAN/ KALIBRASI
                            {{ $nomenklaturs->nama_nomenklatur }}
                        </b>
                    </center>
                </h6>
                <center>
                    <span>{{ $laporan->no_dokumen }}</span>
                </center>
            </td>
        </tr>
    </table>
    <hr class="s1">
    {{-- Pendataan Administrasi --}}
    @include('laporans._pdf_lk_scorsing.pendataan_administrasi')
    {{-- Daftar Alat --}}
    @include('laporans._pdf_lk_scorsing.daftar_alat')
    {{-- PENGUKURAN KONDISI LINGKUNGAN --}}
    @include('laporans._pdf_lk_scorsing.pengukuran_kondisi_fisik')
    {{-- PEMERIKSAAAN KONDISI FISIK DAN FUNGSI --}}
    @include('laporans._pdf_lk_scorsing.kondisi_fisik_dan_fungsi')
    {{-- PENGUKURAN KESELAMATAN LISTRIK --}}
    @include('laporans._pdf_lk_scorsing.pengukuran_keselamatan_listrik')
    {{-- PENGUKURAN KINERJA --}}
    @include('laporans._pdf_lk_scorsing.pengukuran_kinerja')
    {{-- TELAAH TEKNIS --}}
    @include('laporans._pdf_lk_scorsing.telaah_teknis')
</body>

</html>
