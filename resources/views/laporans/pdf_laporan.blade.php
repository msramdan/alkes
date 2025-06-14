<!DOCTYPE html>
<html>

<head>
    <title>Laporan Hasil {{ $nomenklaturs->nama_nomenklatur }} </title>
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
                            LEMBAR KERJA PENGUJIAN/ KALIBRASI <br>
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
    <center>
        <p> <b style="font-size: 20px">LAPORAN PENGUJIAN DAN KALIBRASI</b> </p>
    </center>
    <br>

    {{-- PENDATAAN ADMINISTRASI --}}
    @include('laporans._pdf_lk_laporan._partial.pendataan_administrasi')
    @include('laporans._pdf_lk_laporan._partial.daftar_alat')
    @include('laporans._pdf_lk_laporan._partial.pengukuran_kondisi_fisik')
    @if ($nomenklaturs->id == config('nomenklatur.INFUSION_PUMP') || $nomenklaturs->id == config('nomenklatur.SYRINGE_PUMP'))
        @include('laporans._pdf_lk_laporan.score_infusion')
    @elseif ($nomenklaturs->id == config('nomenklatur.SPHYGMOMANOMETER'))
        @include('laporans._pdf_lk_laporan.score_sphygmomanometer')
    @elseif ($nomenklaturs->id == config('nomenklatur.INKUBATOR_LABORATORIUM'))
        @include('laporans._pdf_lk_laporan.inkubator_labolatorium')
    @elseif ($nomenklaturs->id == config('nomenklatur.SUCTION_PUMP'))
        @include('laporans._pdf_lk_laporan.score_suction_pump')
    @elseif ($nomenklaturs->id == config('nomenklatur.CENTRIFUGE'))
        @include('laporans._pdf_lk_laporan.score_centrifuge')
    @elseif ($nomenklaturs->id == config('nomenklatur.ELECTROCARDIOGRAPH'))
        @include('laporans._pdf_lk_laporan.score_electrocardiograph')
    @elseif ($nomenklaturs->id == config('nomenklatur.CARDIOTOCOGRAPH'))
        @include('laporans._pdf_lk_laporan.score_cardiotocograph')
    @elseif ($nomenklaturs->id == config('nomenklatur.FETAL_DOPPLER'))
        @include('laporans._pdf_lk_laporan.score_fetal_doppler')
    @elseif ($nomenklaturs->id == config('nomenklatur.EXAMINATION_LAMP'))
        @include('laporans._pdf_lk_laporan.score_examination_lamp')
    @elseif ($nomenklaturs->id == config('nomenklatur.DENTAL_UNIT'))
        @include('laporans._pdf_lk_laporan.score_dental_unit')
    @elseif ($nomenklaturs->id == config('nomenklatur.ROLLER_MIXER'))
        @include('laporans._pdf_lk_laporan.score_roller_mixer')
    @elseif ($nomenklaturs->id == config('nomenklatur.ROTATOR'))
        @include('laporans._pdf_lk_laporan.score_rotator')
    @elseif ($nomenklaturs->id == config('nomenklatur.Meja_Operasi'))
        @include('laporans._pdf_lk_laporan.score_meja_operasi')
    @elseif ($nomenklaturs->id == config('nomenklatur.OPERATING_LAMP'))
        @include('laporans._pdf_lk_laporan.score_operating_lamp')
    @elseif ($nomenklaturs->id == config('nomenklatur.Microwave_Diathermy'))
        @include('laporans._pdf_lk_laporan.score_microwave_diathermy')
    @elseif ($nomenklaturs->id == config('nomenklatur.UJI_KESELAMATAN_LISTRIK'))
        @include('laporans._pdf_lk_laporan.score_uji_keselamatan_listrik')
    @elseif ($nomenklaturs->id == config('nomenklatur.Bed_Electric'))
        @include('laporans._pdf_lk_laporan.score_bed_electric')
    @elseif ($nomenklaturs->id == config('nomenklatur.VEIN_FINDER'))
        @include('laporans._pdf_lk_laporan.score_vein_finder')
    @elseif ($nomenklaturs->id == config('nomenklatur.NEOPUFF'))
        @include('laporans._pdf_lk_laporan.score_neopuff')
    @elseif ($nomenklaturs->id == config('nomenklatur.STIRER'))
        @include('laporans._pdf_lk_laporan.score_stirer')
    @elseif ($nomenklaturs->id == config('nomenklatur.PULSE_OXYMETER'))
        @include('laporans._pdf_lk_laporan.score_pulse_oxymeter')
    @elseif ($nomenklaturs->id == config('nomenklatur.PHOTOTHERAPY'))
        @include('laporans._pdf_lk_laporan.score_phototherapy')
    @elseif ($nomenklaturs->id == config('nomenklatur.TIMER'))
        @include('laporans._pdf_lk_laporan.score_timer')
    @elseif ($nomenklaturs->id == config('nomenklatur.FLOWMETER'))
        @include('laporans._pdf_lk_laporan.score_flowmeter')
    @elseif ($nomenklaturs->id == config('nomenklatur.CPAP'))
        @include('laporans._pdf_lk_laporan.score_cpap')
    @elseif ($nomenklaturs->id == config('nomenklatur.OKSIGEN_CONCENTRATOR'))
        @include('laporans._pdf_lk_laporan.score_oksigen_concentrator')
    @elseif ($nomenklaturs->id == config('nomenklatur.HFNC'))
        @include('laporans._pdf_lk_laporan.score_hfnc')
    @elseif ($nomenklaturs->id == config('nomenklatur.TRAKSI'))
        @include('laporans._pdf_lk_laporan.score_traksi')
    @elseif ($nomenklaturs->id == config('nomenklatur.UV_STERILIZER'))
        @include('laporans._pdf_lk_laporan.score_uv_sterilizer')
    @elseif ($nomenklaturs->id == config('nomenklatur.MIKROSKOP'))
        @include('laporans._pdf_lk_laporan.MIKROSKOP')
    @endif



</body>

</html>
