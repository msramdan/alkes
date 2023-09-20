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
$hitungLajuHasil = round($laporan_laju_buang_cepat->intercept_timer + $laporan_laju_buang_cepat->x_variable_timer * $laporan_laju_buang_cepat->value, 2);
$lajuHasil = $hitungLajuHasil <= 10 ? 'Lulus' : 'Tidak Lulus';
$scoreLajuHasil = $lajuHasil == 'Lulus' ? 20 : 0;
// ======================
$laporan_akurasi_tekanan = DB::table('laporan_akurasi_tekanan')
    ->where('no_laporan', $laporan->no_laporan)
    ->first();
// naik
$percobaan0_1_naik = $laporan_akurasi_tekanan->percobaan0_1_naik;
$percobaan0_2_naik = $laporan_akurasi_tekanan->percobaan0_2_naik;
$percobaan0_3_naik = $laporan_akurasi_tekanan->percobaan0_3_naik;
$meanNaik0 = ($percobaan0_1_naik + $percobaan0_2_naik + $percobaan0_3_naik) / 3;

$percobaan50_1_naik = $laporan_akurasi_tekanan->percobaan50_1_naik;
$percobaan50_2_naik = $laporan_akurasi_tekanan->percobaan50_2_naik;
$percobaan50_3_naik = $laporan_akurasi_tekanan->percobaan50_3_naik;
$meanNaik50 = ($percobaan50_1_naik + $percobaan50_2_naik + $percobaan50_3_naik) / 3;

$percobaan100_1_naik = $laporan_akurasi_tekanan->percobaan100_1_naik;
$percobaan100_2_naik = $laporan_akurasi_tekanan->percobaan100_2_naik;
$percobaan100_3_naik = $laporan_akurasi_tekanan->percobaan100_3_naik;
$meanNaik100 = ($percobaan100_1_naik + $percobaan100_2_naik + $percobaan100_3_naik) / 3;

$percobaan150_1_naik = $laporan_akurasi_tekanan->percobaan150_1_naik;
$percobaan150_2_naik = $laporan_akurasi_tekanan->percobaan150_2_naik;
$percobaan150_3_naik = $laporan_akurasi_tekanan->percobaan150_3_naik;
$meanNaik150 = ($percobaan150_1_naik + $percobaan150_2_naik + $percobaan150_3_naik) / 3;


$percobaan200_1_naik = $laporan_akurasi_tekanan->percobaan200_1_naik;
$percobaan200_2_naik = $laporan_akurasi_tekanan->percobaan200_2_naik;
$percobaan200_3_naik = $laporan_akurasi_tekanan->percobaan200_3_naik;
$meanNaik200 = ($percobaan200_1_naik + $percobaan200_2_naik + $percobaan200_3_naik) / 3;

$percobaan250_1_naik = $laporan_akurasi_tekanan->percobaan250_1_naik;
$percobaan250_2_naik = $laporan_akurasi_tekanan->percobaan250_2_naik;
$percobaan250_3_naik = $laporan_akurasi_tekanan->percobaan250_3_naik;
$meanNaik250 = ($percobaan250_1_naik + $percobaan250_2_naik + $percobaan250_3_naik) / 3;

// turun
$percobaan0_1_turun = $laporan_akurasi_tekanan->percobaan0_1_turun;
$percobaan0_2_turun = $laporan_akurasi_tekanan->percobaan0_2_turun;
$percobaan0_3_turun = $laporan_akurasi_tekanan->percobaan0_3_turun;
$meanTurun0 = ($percobaan0_1_turun + $percobaan0_2_turun + $percobaan0_3_turun) / 3;

$percobaan50_1_turun = $laporan_akurasi_tekanan->percobaan50_1_turun;
$percobaan50_2_turun = $laporan_akurasi_tekanan->percobaan50_2_turun;
$percobaan50_3_turun = $laporan_akurasi_tekanan->percobaan50_3_turun;
$meanTurun50 = ($percobaan50_1_turun + $percobaan50_2_turun + $percobaan50_3_turun) / 3;

$percobaan100_1_turun = $laporan_akurasi_tekanan->percobaan100_1_turun;
$percobaan100_2_turun = $laporan_akurasi_tekanan->percobaan100_2_turun;
$percobaan100_3_turun = $laporan_akurasi_tekanan->percobaan100_3_turun;
$meanTurun100 = ($percobaan100_1_turun + $percobaan100_2_turun + $percobaan100_3_turun) / 3;

$percobaan150_1_turun = $laporan_akurasi_tekanan->percobaan150_1_turun;
$percobaan150_2_turun = $laporan_akurasi_tekanan->percobaan150_2_turun;
$percobaan150_3_turun = $laporan_akurasi_tekanan->percobaan150_3_turun;
$meanTurun150 = ($percobaan150_1_turun + $percobaan150_2_turun + $percobaan150_3_turun) / 3;

$percobaan200_1_turun = $laporan_akurasi_tekanan->percobaan200_1_turun;
$percobaan200_2_turun = $laporan_akurasi_tekanan->percobaan200_2_turun;
$percobaan200_3_turun = $laporan_akurasi_tekanan->percobaan200_3_turun;
$meanTurun200 = ($percobaan200_1_turun + $percobaan200_2_turun + $percobaan200_3_turun) / 3;

$percobaan250_1_turun = $laporan_akurasi_tekanan->percobaan250_1_turun;
$percobaan250_2_turun = $laporan_akurasi_tekanan->percobaan250_2_turun;
$percobaan250_3_turun = $laporan_akurasi_tekanan->percobaan250_3_turun;
$meanTurun250 = ($percobaan250_1_turun + $percobaan250_2_turun + $percobaan250_3_turun) / 3;

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
            <td style="vertical-align: middle;text-align: center">{{ $hitungLajuHasil }}</td>
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
            <td>{{ round($meanNaik0,2) }}</td>
        </tr>
        <tr>
            <td>50</td>
            <td>{{ $percobaan50_1_naik }}</td>
            <td>{{ $percobaan50_2_naik }}</td>
            <td>{{ $percobaan50_3_naik }}</td>
            <td>{{round($meanNaik50,2)}}</td>
        </tr>
        <tr>
            <td>100</td>
            <td>{{ $percobaan100_1_naik }}</td>
            <td>{{ $percobaan100_2_naik }}</td>
            <td>{{ $percobaan100_3_naik }}</td>
            <td>{{round($meanNaik100,2)}}</td>
        </tr>
        <tr>
            <td>150</td>
            <td>{{ $percobaan150_1_naik }}</td>
            <td>{{ $percobaan150_2_naik }}</td>
            <td>{{ $percobaan150_3_naik }}</td>
            <td>{{round($meanNaik150,2)}}</td>
        </tr>
        <tr>
            <td>200</td>
            <td>{{ $percobaan200_1_naik }}</td>
            <td>{{ $percobaan200_2_naik }}</td>
            <td>{{ $percobaan200_3_naik }}</td>
            <td>{{round($meanNaik200,2)}}</td>
        </tr>
        <tr>
            <td>250</td>
            <td>{{ $percobaan250_1_naik }}</td>
            <td>{{ $percobaan250_2_naik }}</td>
            <td>{{ $percobaan250_3_naik }}</td>
            <td>{{round($meanNaik250,2)}}</td>
        </tr>
        <tr>
            <td rowspan="6" style="background-color:grey;text-align: center;vertical-align: middle;"> <span
                    style="transform: rotate(-90deg);margin-top:60px; color:white"><b>Turun</b></span></td>
            <td>0</td>
            <td>{{ $percobaan0_1_turun }}</td>
            <td>{{ $percobaan0_2_turun }}</td>
            <td>{{ $percobaan0_3_turun }}</td>
            <td>{{round($meanTurun0,2)}}</td>
        </tr>
        <tr>
            <td>50</td>
            <td>{{ $percobaan50_1_turun }}</td>
            <td>{{ $percobaan50_2_turun }}</td>
            <td>{{ $percobaan50_3_turun }}</td>
            <td>{{round($meanTurun50,2)}}</td>
        </tr>
        <tr>
            <td>100</td>
            <td>{{ $percobaan100_1_turun }}</td>
            <td>{{ $percobaan100_2_turun }}</td>
            <td>{{ $percobaan100_3_turun }}</td>
            <td>{{round($meanTurun100,2)}}</td>
        </tr>
        <tr>
            <td>150</td>
            <td>{{ $percobaan150_1_turun }}</td>
            <td>{{ $percobaan150_2_turun }}</td>
            <td>{{ $percobaan150_3_turun }}</td>
            <td>{{round($meanTurun150,2)}}</td>
        </tr>
        <tr>
            <td>200</td>
            <td>{{ $percobaan200_1_turun }}</td>
            <td>{{ $percobaan200_2_turun }}</td>
            <td>{{ $percobaan200_3_turun }}</td>
            <td>{{round($meanTurun200,2)}}</td>
        </tr>
        <tr>
            <td>250</td>
            <td>{{ $percobaan250_1_turun }}</td>
            <td>{{ $percobaan250_2_turun }}</td>
            <td>{{ $percobaan250_3_turun }}</td>
            <td>{{round($meanTurun250,2)}}</td>
        </tr>
    </tbody>
</table>
