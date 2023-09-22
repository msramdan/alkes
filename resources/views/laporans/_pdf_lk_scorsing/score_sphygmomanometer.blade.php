<style>
    .page_break {
        page-break-before: always;
    }

    .verticalTableHeader {
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
    }
</style>

<p style="font-size: 14px"><b>D. PEMERIKSAAAN KONDISI FISIK DAN FUNGSI</b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
    <thead>
        <tr>
            <th style="width: 4%;text-align: center;">No</th>
            <th style="width: 24%;text-align: center;">Bagian Alat</th>
            <th style="width: 20%;text-align: center;">Hasil Pengamatan</th>
            <th style="width: 20%;text-align: center;">Skorsing</th>
            <th style="width: 20%;text-align: center;">Pernyataan Penilaian
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i =1;
            foreach ($kondisi_fisik_fungsi as $row) { ?>
        <tr>
            <td>{{ $i++ }}</td>
            <td style="text-align: justify">{{ $row->field_parameter_fisik_fungsi }}</td>
            <td style="text-align: justify"> <b>{{ $row->value == 'baik' ? 'Baik' : 'Tidak Baik' }}</b> </td>
            <?php if ($i == 2) { ?>
            <td rowspan="{{ $count_kondisi_fisik_fungsi }}"
                style="width: 20%;text-align: center;vertical-align: middle;"><b> {{ $score_fisik }} </b> </td>
            <td rowspan="{{ $count_kondisi_fisik_fungsi }}"
                style="width: 20%;text-align: center;vertical-align: middle;">
                <b>{{ $score_fisik >= 7 ? 'Baik' : 'Tidak Baik' }}</b>
            </td>
            <?php } ?>
        </tr>
        <?php } ?>
    </tbody>
</table>
<div class="page_break"></div>

{{-- pengukuran_keselamatan_listrik --}}
@if ($count_laporan_pengukuran_keselamatan_listrik > 0)
    <?php
    $hitungPhaseNetral = round(get_data_litsrik($laporan->no_laporan, 'slug', 'phase-netral')->intercept1 + get_data_litsrik($laporan->no_laporan, 'slug', 'phase-netral')->x_variable1 * get_data_litsrik($laporan->no_laporan, 'slug', 'phase-netral')->value, 2);

    $hitungPhaseGround = round(get_data_litsrik($laporan->no_laporan, 'slug', 'phase-ground')->intercept3 + get_data_litsrik($laporan->no_laporan, 'slug', 'phase-ground')->x_variable3 * get_data_litsrik($laporan->no_laporan, 'slug', 'phase-ground')->value, 2);

    $hitungGroundNetral = round(get_data_litsrik($laporan->no_laporan, 'slug', 'ground-netral')->intercept2 + get_data_litsrik($laporan->no_laporan, 'slug', 'ground-netral')->x_variable2 * get_data_litsrik($laporan->no_laporan, 'slug', 'ground-netral')->value, 2);

    $dps = get_data_litsrik($laporan->no_laporan, 'slug', 'kabel-dapat-dilepas-dps')->value;
    $nps = get_data_litsrik($laporan->no_laporan, 'slug', 'kabel-tidak-dapat-dilepas-nps')->value;
    $isolasi = get_data_litsrik($laporan->no_laporan, 'slug', 'resistansi-isolasi')->value;
    $bf = get_data_litsrik($laporan->no_laporan, 'slug', 'kelas-i-tipe-bbfcf')->value;

    $lulus = 0;
    if ($hitungPhaseNetral > 198) {
        $lulus = $lulus + 1;
    }

    if ($hitungPhaseGround > 198) {
        $lulus = $lulus + 1;
    }
    if ($hitungGroundNetral < 5) {
        $lulus = $lulus + 1;
    }
    if ($dps <= 0.2) {
        $lulus = $lulus + 1;
    }
    if ($nps <= 0.3) {
        $lulus = $lulus + 1;
    }
    if ($isolasi > 2) {
        $lulus = $lulus + 1;
    }
    if ($bf <= 500) {
        $lulus = $lulus + 1;
    }

    $point = round(($lulus / 7) * 40);
    ?>
    <p style="font-size: 14px"><b>E. PENGUKURAN KESELAMATAN LISTRIK</b> </p>
    <table class="table table-bordered table-sm"
        style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
        <thead>
            <tr>
                <th style="width: 5%;text-align: center;">No</th>
                <th colspan="2" style="width: 30%;text-align: center;">Parameter</th>
                <th style="width: 10%;text-align: center;">Terukur</th>
                <th style="width: 15%;text-align: center;">Ambang Batas</th>
                <th style="width: 8%;text-align: center;">Koreksi sertifikat</th>
                <th style="width: 10%;text-align: center;">Hasil</th>
                <th style="width: 8%;text-align: center;">Skorsing</th>
                <th style="width: 8%;text-align: center;">Pernyataan Penilaian</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="3">1</td>
                <td rowspan="3" style="text-align: justify">Tegangan Input (Main Voltage)</td>
                <td style="text-align: justify">Phase - Netral</td>
                <td style="text-align: justify">
                    {{ get_data_litsrik($laporan->no_laporan, 'slug', 'phase-netral')->value }}
                    Vac</td>
                <td style="text-align: justify">220 ± 10% Vac
                </td>
                <td style="text-align: justify">
                    {{ $hitungPhaseNetral }}
                </td>
                <td style="text-align: justify">{{ $hitungPhaseNetral > 198 ? 'Lulus' : 'Tidak Lulus' }}</td>
                <td style="text-align: center;vertical-align: middle;" rowspan="9"> {{ $point }} </td>
                <td style="text-align: center;vertical-align: middle;" rowspan="9">
                    {{ $point < 40 ? 'Tidak Aman' : 'Aman' }}</td>
            </tr>
            <tr>
                <td style="text-align: justify">Phase - Ground</td>
                <td style="text-align: justify">
                    {{ get_data_litsrik($laporan->no_laporan, 'slug', 'phase-ground')->value }}
                    Vac</td>
                <td style="text-align: justify">220 ± 10% Vac</td>
                <td style="text-align: justify"> {{ $hitungPhaseGround }}</td>
                <td style="text-align: justify">{{ $hitungPhaseGround > 198 ? 'Lulus' : 'Tidak Lulus' }}</td>
            </tr>
            <tr>
                <td style="text-align: justify">Ground - Netral</td>
                <td style="text-align: justify">
                    {{ get_data_litsrik($laporan->no_laporan, 'slug', 'ground-netral')->value }}
                    Vac</td>
                <td style="text-align: justify"><img src="../public/asset/kurang.png"
                        style="width: 6px; margin-top:3px"> 5 Vac
                </td>
                <td style="text-align: justify"> {{ $hitungGroundNetral }}</td>
                <td style="text-align: justify">{{ $hitungGroundNetral < 5 ? 'Lulus' : 'Tidak Lulus' }}</td>
            </tr>
            <tr>
                <td rowspan="3">2</td>
                <td colspan="2" style="text-align: justify">Resistansi pembumian protektif</td>
                <td colspan="4" style="text-align: justify;background-color: gray"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: justify">Kabel dapat dilepas (DPS)</td>
                <td style="text-align: justify;">
                    {{ $dps }} <img src="../public/asset/ohm.png" style="width: 10px; margin-top:3px">
                </td>
                <td style="text-align: justify;"><img src="../public/asset/kurang.png"
                        style="width: 6px; margin-top:3px"> 0.2 <img src="../public/asset/ohm.png"
                        style="width: 10px; margin-top:3px">
                </td>
                <td style="text-align: justify">
                    {{ $dps }} <img src="../public/asset/ohm.png" style="width: 10px; margin-top:3px">
                </td>
                <td style="text-align: justify">
                    {{ $dps <= 0.2 ? 'Lulus' : 'Tidak Lulus' }}
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: justify">Kabel tidak dapat dilepas (NPS)</td>
                <td style="text-align: justify;">
                    {{ $nps }} <img src="../public/asset/ohm.png" style="width: 10px; margin-top:3px">
                </td>
                <td style="text-align: justify;"><img src="../public/asset/kurang.png"
                        style="width: 6px; margin-top:3px"> 0.3 <img src="../public/asset/ohm.png"
                        style="width: 10px; margin-top:4px">
                </td>
                <td style="text-align: justify">
                    {{ $nps }} <img src="../public/asset/ohm.png" style="width: 10px; margin-top:3px">
                </td>
                <td style="text-align: justify">
                    {{ $nps <= 0.3 ? 'Lulus' : 'Tidak Lulus' }}
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td colspan="2" style="text-align: justify">Resistansi isolasi</td>
                <td style="text-align: justify">
                    {{ $isolasi }} M<img src="../public/asset/ohm.png" style="width: 10px; margin-top:3px">
                </td>
                <td style="text-align: justify">> 2 M<img src="../public/asset/ohm.png"
                        style="width: 10px; margin-top:3px">

                </td>
                <td style="text-align: justify">
                    {{ $isolasi }} M<img src="../public/asset/ohm.png" style="width: 10px; margin-top:3px">
                </td>
                <td style="text-align: justify">
                    {{ $isolasi > 2 ? 'Lulus' : 'Tidak Lulus' }}
                </td>
            </tr>
            <tr>
                <td rowspan="2">4</td>
                <td colspan="2" style="text-align: justify">Arus Bocor Pada peralatan
                </td>
                <td colspan="4" style="text-align: justify;background-color: gray"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: justify">Kelas I tipe B/BF/CF</td>
                <td style="text-align: justify;">
                    {{ $bf }} µA
                </td>
                <td style="text-align: justify;"><img src="../public/asset/kurang.png"
                        style="width: 6px; margin-top:3px"> 500 µA
                </td>
                <td style="text-align: justify">
                    {{ $bf }} µA</td>
                <td style="text-align: justify">
                    {{ $bf <= 500 ? 'Lulus' : 'Tidak Lulus' }}
                </td>
            </tr>
        </tbody>
    </table>
@endif

{{-- pengukuran_kinerja --}}
<p style="font-size: 14px"><b>{{ $count_laporan_pengukuran_keselamatan_listrik > 0 ? 'F' : 'E' }}. PENGUKURAN
        KINERJA</b></p>
<?php

$laporan_kebocoran_tekanan = DB::table('laporan_kebocoran_tekanan')
    ->where('no_laporan', $laporan->no_laporan)
    ->first();
$tekananHasil = $laporan_kebocoran_tekanan->value <= 15 ? 'Lulus' : 'Tidak Lulus';
$scoreTekananHasil = $tekananHasil == 'Lulus' ? 20 : 0;
// =====================
$laporan_laju_buang_cepat = DB::table('laporan_laju_buang_cepat')
    ->where('no_laporan', $laporan->no_laporan)
    ->first();
$data_sertifikat = json_decode($laporan_laju_buang_cepat->data_sertifikat);
$hitungLajuHasil = $data_sertifikat->intercept + $data_sertifikat->x_variable * $laporan_laju_buang_cepat->value;
$lajuHasil = $hitungLajuHasil <= 10 ? 'Lulus' : 'Tidak Lulus';
$scoreLajuHasil = $lajuHasil == 'Lulus' ? 20 : 0;
// ======================
$laporan_akurasi_tekanan = DB::table('laporan_akurasi_tekanan')
    ->where('no_laporan', $laporan->no_laporan)
    ->first();
$data_sertifikat_akurasi_tekanan = json_decode($laporan_akurasi_tekanan->data_sertifikat);
// naik
$percobaan0_1_naik = $laporan_akurasi_tekanan->percobaan0_1_naik;
$percobaan0_2_naik = $laporan_akurasi_tekanan->percobaan0_2_naik;
$percobaan0_3_naik = $laporan_akurasi_tekanan->percobaan0_3_naik;
$meanNaik0 = ($percobaan0_1_naik + $percobaan0_2_naik + $percobaan0_3_naik) / 3;
$meanterkoreksi0 = $data_sertifikat_akurasi_tekanan->intercept_naik + $data_sertifikat_akurasi_tekanan->x_variable_naik * $meanNaik0;
$koreksi = $meanNaik0 - 0;
// stdev
$arr = [];
array_push($arr, $percobaan0_1_naik, $percobaan0_2_naik, $percobaan0_3_naik);
$stdev = standard_deviation($arr);

$percobaan50_1_naik = $laporan_akurasi_tekanan->percobaan50_1_naik;
$percobaan50_2_naik = $laporan_akurasi_tekanan->percobaan50_2_naik;
$percobaan50_3_naik = $laporan_akurasi_tekanan->percobaan50_3_naik;
$meanNaik50 = ($percobaan50_1_naik + $percobaan50_2_naik + $percobaan50_3_naik) / 3;
$meanterkoreksi50 = $data_sertifikat_akurasi_tekanan->intercept_naik + $data_sertifikat_akurasi_tekanan->x_variable_naik * $meanNaik50;
// stdev
$arr2 = [];
array_push($arr2, $percobaan50_1_naik, $percobaan50_2_naik, $percobaan50_3_naik);
$stdev2 = standard_deviation($arr2);
$koreksi2 = $meanNaik50 - 50;

$percobaan100_1_naik = $laporan_akurasi_tekanan->percobaan100_1_naik;
$percobaan100_2_naik = $laporan_akurasi_tekanan->percobaan100_2_naik;
$percobaan100_3_naik = $laporan_akurasi_tekanan->percobaan100_3_naik;
$meanNaik100 = ($percobaan100_1_naik + $percobaan100_2_naik + $percobaan100_3_naik) / 3;
$meanterkoreksi100 = $data_sertifikat_akurasi_tekanan->intercept_naik + $data_sertifikat_akurasi_tekanan->x_variable_naik * $meanNaik100;
// stdev
$arr3 = [];
array_push($arr3, $percobaan100_1_naik, $percobaan100_2_naik, $percobaan100_3_naik);
$stdev3 = standard_deviation($arr3);
$koreksi3 = $meanNaik100 - 100;

$percobaan150_1_naik = $laporan_akurasi_tekanan->percobaan150_1_naik;
$percobaan150_2_naik = $laporan_akurasi_tekanan->percobaan150_2_naik;
$percobaan150_3_naik = $laporan_akurasi_tekanan->percobaan150_3_naik;
$meanNaik150 = ($percobaan150_1_naik + $percobaan150_2_naik + $percobaan150_3_naik) / 3;
$meanterkoreksi150 = $data_sertifikat_akurasi_tekanan->intercept_naik + $data_sertifikat_akurasi_tekanan->x_variable_naik * $meanNaik150;
// stdev
$arr4 = [];
array_push($arr4, $percobaan150_1_naik, $percobaan150_2_naik, $percobaan150_3_naik);
$stdev4 = standard_deviation($arr4);
$koreksi4 = $meanNaik150 - 150;

$percobaan200_1_naik = $laporan_akurasi_tekanan->percobaan200_1_naik;
$percobaan200_2_naik = $laporan_akurasi_tekanan->percobaan200_2_naik;
$percobaan200_3_naik = $laporan_akurasi_tekanan->percobaan200_3_naik;
$meanNaik200 = ($percobaan200_1_naik + $percobaan200_2_naik + $percobaan200_3_naik) / 3;
$meanterkoreksi200 = $data_sertifikat_akurasi_tekanan->intercept_naik + $data_sertifikat_akurasi_tekanan->x_variable_naik * $meanNaik200;
// stdev
$arr5 = [];
array_push($arr5, $percobaan200_1_naik, $percobaan200_2_naik, $percobaan200_3_naik);
$stdev5 = standard_deviation($arr5);
$koreksi5 = $meanNaik200 - 200;

$percobaan250_1_naik = $laporan_akurasi_tekanan->percobaan250_1_naik;
$percobaan250_2_naik = $laporan_akurasi_tekanan->percobaan250_2_naik;
$percobaan250_3_naik = $laporan_akurasi_tekanan->percobaan250_3_naik;
$meanNaik250 = ($percobaan250_1_naik + $percobaan250_2_naik + $percobaan250_3_naik) / 3;
$meanterkoreksi250 = $data_sertifikat_akurasi_tekanan->intercept_naik + $data_sertifikat_akurasi_tekanan->x_variable_naik * $meanNaik250;
// stdev
$arr6 = [];
array_push($arr6, $percobaan250_1_naik, $percobaan250_2_naik, $percobaan250_3_naik);
$stdev6 = standard_deviation($arr6);
$koreksi6 = $meanNaik250 - 250;

// turun
$percobaan250_1_turun = $laporan_akurasi_tekanan->percobaan250_1_turun;
$percobaan250_2_turun = $laporan_akurasi_tekanan->percobaan250_2_turun;
$percobaan250_3_turun = $laporan_akurasi_tekanan->percobaan250_3_turun;
$meanTurun250 = ($percobaan250_1_turun + $percobaan250_2_turun + $percobaan250_3_turun) / 3;
$meanterkoreksiTurun250 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun250;
// stdev
$arr7= [];
array_push($arr7, $percobaan250_1_turun, $percobaan250_2_turun, $percobaan250_3_turun);
$stdev7 = standard_deviation($arr7);
$koreksi7 = $meanTurun250 - 250;

$percobaan200_1_turun = $laporan_akurasi_tekanan->percobaan200_1_turun;
$percobaan200_2_turun = $laporan_akurasi_tekanan->percobaan200_2_turun;
$percobaan200_3_turun = $laporan_akurasi_tekanan->percobaan200_3_turun;
$meanTurun200 = ($percobaan200_1_turun + $percobaan200_2_turun + $percobaan200_3_turun) / 3;
$meanterkoreksiTurun200 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun200;
// stdev
$arr8= [];
array_push($arr8, $percobaan200_1_turun, $percobaan200_2_turun, $percobaan200_3_turun);
$stdev8 = standard_deviation($arr8);
$koreksi8 = $meanTurun200 - 200;

$percobaan150_1_turun = $laporan_akurasi_tekanan->percobaan150_1_turun;
$percobaan150_2_turun = $laporan_akurasi_tekanan->percobaan150_2_turun;
$percobaan150_3_turun = $laporan_akurasi_tekanan->percobaan150_3_turun;
$meanTurun150 = ($percobaan150_1_turun + $percobaan150_2_turun + $percobaan150_3_turun) / 3;
$meanterkoreksiTurun150 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun150;
// stdev
$arr9= [];
array_push($arr9, $percobaan150_1_turun, $percobaan150_2_turun, $percobaan150_3_turun);
$stdev9 = standard_deviation($arr9);
$koreksi9 = $meanTurun150 - 150;

$percobaan100_1_turun = $laporan_akurasi_tekanan->percobaan100_1_turun;
$percobaan100_2_turun = $laporan_akurasi_tekanan->percobaan100_2_turun;
$percobaan100_3_turun = $laporan_akurasi_tekanan->percobaan100_3_turun;
$meanTurun100 = ($percobaan100_1_turun + $percobaan100_2_turun + $percobaan100_3_turun) / 3;
$meanterkoreksiTurun100 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun100;
// stdev
$arr10= [];
array_push($arr10, $percobaan100_1_turun, $percobaan100_2_turun, $percobaan100_3_turun);
$stdev10 = standard_deviation($arr10);
$koreksi10 = $meanTurun100 - 100;

$percobaan50_1_turun = $laporan_akurasi_tekanan->percobaan50_1_turun;
$percobaan50_2_turun = $laporan_akurasi_tekanan->percobaan50_2_turun;
$percobaan50_3_turun = $laporan_akurasi_tekanan->percobaan50_3_turun;
$meanTurun50 = ($percobaan50_1_turun + $percobaan50_2_turun + $percobaan50_3_turun) / 3;
$meanterkoreksiTurun50 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun50;
// stdev
$arr11= [];
array_push($arr11, $percobaan50_1_turun, $percobaan50_2_turun, $percobaan50_3_turun);
$stdev11 = standard_deviation($arr11);
$koreksi11 = $meanTurun50 - 50;

$percobaan0_1_turun = $laporan_akurasi_tekanan->percobaan0_1_turun;
$percobaan0_2_turun = $laporan_akurasi_tekanan->percobaan0_2_turun;
$percobaan0_3_turun = $laporan_akurasi_tekanan->percobaan0_3_turun;
$meanTurun0 = ($percobaan0_1_turun + $percobaan0_2_turun + $percobaan0_3_turun) / 3;
$meanterkoreksiTurun0 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun0;
// stdev
$arr12= [];
array_push($arr12, $percobaan0_1_turun, $percobaan0_2_turun, $percobaan0_3_turun);
$stdev12 = standard_deviation($arr12);
$koreksi12 = $meanTurun0 - 00;


?>

<p style="font-size: 11px;margin-left:18px"><b>1. CEK KEBOCORAN TEKANAN SETELAH 60 DETIK</b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:9px;width:100%;margin-top:-10px; padding-right:18px">
    <thead>
        <tr>
            <th style="text-align: center;vertical-align: middle;width:10%">Setting (mmHg)</th>
            <th style="text-align: center;vertical-align: middle;width:30%">Kebocoran (mmHg)</th>
            <th style="text-align: center;vertical-align: middle;width:40%">Penyimpangan yang di ijinkan</th>
            <th style="text-align: center;vertical-align: middle;width:10%">Hasil</th>
            <th style="text-align: center;vertical-align: middle;width:10%">Skorsing</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="vertical-align: middle;text-align: center">250</td>
            <td style="vertical-align: middle;text-align: center">{{ $laporan_kebocoran_tekanan->value }}</td>
            <td style="vertical-align: middle;text-align: center"><img src="../public/asset/kurang.png"
                    style="width: 6px; margin-top:3px"> 15 mmHg/menit</td>
            <td style="vertical-align: middle;text-align: center">{{ $tekananHasil }}</td>
            <td style="vertical-align: middle;text-align: center">{{ $scoreTekananHasil }}</td>
        </tr>
    </tbody>
</table>

<p style="font-size: 11px;margin-left:18px"><b>2. LAJU BUANG CEPAT</b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:9px;width:100%;margin-top:-10px; padding-right:18px">
    <thead>
        <tr>
            <th style="text-align: center;vertical-align: middle;width:10%">Setting (mmHg)</th>
            <th style="text-align: center;vertical-align: middle;width:30%">Waktu Buang Cepat untuk membuang tekanan
                dari 260 ke 15 mmHg (dtk)</th>
            <th style="text-align: center;vertical-align: middle;width:40%">Penyimpangan yang di ijinkan</th>
            <th style="text-align: center;vertical-align: middle;width:10%">Hasil</th>
            <th style="text-align: center;vertical-align: middle;width:10%">Skorsing</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="vertical-align: middle;text-align: center">260</td>
            <td style="vertical-align: middle;text-align: center">{{ round($hitungLajuHasil, 2) }}</td>
            <td style="vertical-align: middle;text-align: center"> <img src="../public/asset/kurang.png"
                    style="width: 6px; margin-top:3px"> 10 detik</td>
            <td style="vertical-align: middle;text-align: center">{{ $lajuHasil }}</td>
            <td style="vertical-align: middle;text-align: center">{{ $scoreLajuHasil }}</td>
        </tr>
    </tbody>
</table>

<p style="font-size: 11px;margin-left:18px"><b>3. KALIBRASI AKURASI TEKANAN</b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:9px;width:100%;margin-top:-10px; padding-right:18px">
    <thead>
        <tr>
            <th colspan="2" style="text-align: center;vertical-align: middle;">Setting (mmHg)</th>
            <th colspan="3" style="text-align: center;vertical-align: middle;">Terukur Pada Standar (mmHg)</th>
            <th style="text-align: center;vertical-align: middle;">Mean</th>
            <th style="text-align: center;vertical-align: middle;">Mean Terkoreksi</th>
            <th style="text-align: center;vertical-align: middle;">Standar Deviasi </th>
            <th style="text-align: center;vertical-align: middle;">Koreksi</th>
            <th style="text-align: center;vertical-align: middle;">Ketidakpastian (U95)</th>
            <th style="text-align: center;vertical-align: middle;">Koreksi + U95</th>
            <th style="text-align: center;vertical-align: middle;">Toleransi ( + mmHg) </th>
            <th style="text-align: center;vertical-align: middle;">Hasil </th>
            <th style="text-align: center;vertical-align: middle;">Skorsing</th>
            <th style="text-align: center;vertical-align: middle;">Pernyataan Penilaian </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td rowspan="6" style="background-color:grey;text-align: center;vertical-align: middle;"> <span
                    style="transform: rotate(-90deg);margin-top:60px; color:white"><b>Naik</b></span></td>
            <td>0</td>
            <td>{{ $percobaan0_1_naik }}</td>
            <td>{{ $percobaan0_2_naik }}</td>
            <td>{{ $percobaan0_3_naik }}</td>
            <td>{{ round($meanNaik0, 2) }}</td>
            <td>{{ round($meanterkoreksi0, 2) }}</td>
            <td>{{ round($stdev,2) }}</td>
            <td>{{ round($koreksi,2) }}</td>
            <td></td>
            <td></td>
            <td rowspan="12" style="text-align: center;vertical-align: middle;">4</td>
        </tr>
        <tr>
            <td>50</td>
            <td>{{ $percobaan50_1_naik }}</td>
            <td>{{ $percobaan50_2_naik }}</td>
            <td>{{ $percobaan50_3_naik }}</td>
            <td>{{ round($meanNaik50, 2) }}</td>
            <td>{{ round($meanterkoreksi50, 2) }}</td>
            <td>{{ round($stdev2,2) }}</td>
            <td>{{ round($koreksi2,2) }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>100</td>
            <td>{{ $percobaan100_1_naik }}</td>
            <td>{{ $percobaan100_2_naik }}</td>
            <td>{{ $percobaan100_3_naik }}</td>
            <td>{{ round($meanNaik100, 2) }}</td>
            <td>{{ round($meanterkoreksi100, 2) }}</td>
            <td>{{ round($stdev3,2) }}</td>
            <td>{{ round($koreksi3,2) }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>150</td>
            <td>{{ $percobaan150_1_naik }}</td>
            <td>{{ $percobaan150_2_naik }}</td>
            <td>{{ $percobaan150_3_naik }}</td>
            <td>{{ round($meanNaik150, 2) }}</td>
            <td>{{ round($meanterkoreksi150, 2) }}</td>
            <td>{{ round($stdev4,2) }}</td>
            <td>{{ round($koreksi4,2) }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>200</td>
            <td>{{ $percobaan200_1_naik }}</td>
            <td>{{ $percobaan200_2_naik }}</td>
            <td>{{ $percobaan200_3_naik }}</td>
            <td>{{ round($meanNaik200, 2) }}</td>
            <td>{{ round($meanterkoreksi200, 2) }}</td>
            <td>{{ round($stdev5,2) }}</td>
            <td>{{ round($koreksi5,2) }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>250</td>
            <td>{{ $percobaan250_1_naik }}</td>
            <td>{{ $percobaan250_2_naik }}</td>
            <td>{{ $percobaan250_3_naik }}</td>
            <td>{{ round($meanNaik250, 2) }}</td>
            <td>{{ round($meanterkoreksi250, 2) }}</td>
            <td>{{ round($stdev6,2) }}</td>
            <td>{{ round($koreksi6,2) }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td rowspan="6" style="background-color:grey;text-align: center;vertical-align: middle;"> <span
                    style="transform: rotate(-90deg);margin-top:60px; color:white"><b>Turun</b></span></td>
            <td>250</td>
            <td>{{ $percobaan250_1_turun }}</td>
            <td>{{ $percobaan250_2_turun }}</td>
            <td>{{ $percobaan250_3_turun }}</td>
            <td>{{ round($meanTurun250, 2) }}</td>
            <td>{{ round($meanterkoreksiTurun250, 2) }}</td>
            <td>{{ round($stdev7,2) }}</td>
            <td>{{ round($koreksi7,2) }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>200</td>
            <td>{{ $percobaan200_1_turun }}</td>
            <td>{{ $percobaan200_2_turun }}</td>
            <td>{{ $percobaan200_3_turun }}</td>
            <td>{{ round($meanTurun200, 2) }}</td>
            <td>{{ round($meanterkoreksiTurun200, 2) }}</td>
            <td>{{ round($stdev8,2) }}</td>
            <td>{{ round($koreksi8,2) }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>150</td>
            <td>{{ $percobaan150_1_turun }}</td>
            <td>{{ $percobaan150_2_turun }}</td>
            <td>{{ $percobaan150_3_turun }}</td>
            <td>{{ round($meanTurun150, 2) }}</td>
            <td>{{ round($meanterkoreksiTurun150, 2) }}</td>
            <td>{{ round($stdev9,2) }}</td>
            <td>{{ round($koreksi9,2) }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>100</td>
            <td>{{ $percobaan100_1_turun }}</td>
            <td>{{ $percobaan100_2_turun }}</td>
            <td>{{ $percobaan100_3_turun }}</td>
            <td>{{ round($meanTurun100, 2) }}</td>
            <td>{{ round($meanterkoreksiTurun100, 2) }}</td>
            <td>{{ round($stdev10,2) }}</td>
            <td>{{ round($koreksi10,2) }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>50</td>
            <td>{{ $percobaan50_1_turun }}</td>
            <td>{{ $percobaan50_2_turun }}</td>
            <td>{{ $percobaan50_3_turun }}</td>
            <td>{{ round($meanTurun50, 2) }}</td>
            <td>{{ round($meanterkoreksiTurun50, 2) }}</td>
            <td>{{ round($stdev11 ,2)}}</td>
            <td>{{ round($koreksi11,2) }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>

            <td>0</td>
            <td>{{ $percobaan0_1_turun }}</td>
            <td>{{ $percobaan0_2_turun }}</td>
            <td>{{ $percobaan0_3_turun }}</td>
            <td>{{ round($meanTurun0, 2) }}</td>
            <td>{{ round($meanterkoreksiTurun0, 2) }}</td>
            <td>{{ round($stdev12,2)  }}</td>
            <td>{{ round($koreksi12,2) }}</td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
