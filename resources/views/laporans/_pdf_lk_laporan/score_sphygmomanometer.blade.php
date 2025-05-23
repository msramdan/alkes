<style>
    .page_break {
        page-break-before: always;
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
<p style="font-size: 14px;"><b>{{ $count_laporan_pengukuran_keselamatan_listrik > 0 ? 'F' : 'E' }}.
    PENGUKURAN KINERJA</b></p>
<?php

$laporan_kebocoran_tekanan = DB::table('laporan_kinerja')
    ->where('type_laporan_kinerja', 'kebocoran_tekanan')
    ->where('no_laporan', $laporan->no_laporan)
    ->first();
$laporan_kebocoran_tekanan = json_decode($laporan_kebocoran_tekanan->data_laporan);
$resolusi = DB::table('laporan_pendataan_administrasi')
    ->where('no_laporan', $laporan->no_laporan)
    ->where('slug', 'resolusi')
    ->first();

$tekananHasil = $laporan_kebocoran_tekanan->value <= 15 ? 'Lulus' : 'Tidak Lulus';
$scoreTekananHasil = $tekananHasil == 'Lulus' ? 20 : 0;
// =====================
$laporan_laju_buang_cepat = DB::table('laporan_kinerja')
    ->where('type_laporan_kinerja', 'laju_buang_cepat')
    ->where('no_laporan', $laporan->no_laporan)
    ->first();
$data_sertifikat = json_decode($laporan_laju_buang_cepat->data_sertifikat);
$laporan_laju_buang_cepat = json_decode($laporan_laju_buang_cepat->data_laporan);
$hitungLajuHasil = $data_sertifikat->intercept + $data_sertifikat->x_variable * $laporan_laju_buang_cepat->value;
$lajuHasil = $hitungLajuHasil <= 10 ? 'Lulus' : 'Tidak Lulus';
$scoreLajuHasil = $lajuHasil == 'Lulus' ? 20 : 0;
// ======================
$laporan_akurasi_tekanan = DB::table('laporan_kinerja')
    ->where('type_laporan_kinerja', 'akurasi_tekanan')
    ->where('no_laporan', $laporan->no_laporan)
    ->first();
$data_sertifikat_akurasi_tekanan = json_decode($laporan_akurasi_tekanan->data_sertifikat);
$laporan_akurasi_tekanan = json_decode($laporan_akurasi_tekanan->data_laporan);
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
// hitung uncertainty
$u95 = hitung_uncertainty($resolusi->value, $stdev, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift0_naik,6);
$absU95 = abs($koreksi) + $u95;
$score = $absU95 < 4 ? 'Lulus' : 'Tidak';

$percobaan50_1_naik = $laporan_akurasi_tekanan->percobaan50_1_naik;
$percobaan50_2_naik = $laporan_akurasi_tekanan->percobaan50_2_naik;
$percobaan50_3_naik = $laporan_akurasi_tekanan->percobaan50_3_naik;
$meanNaik50 = ($percobaan50_1_naik + $percobaan50_2_naik + $percobaan50_3_naik) / 3;
$meanterkoreksi50 = $data_sertifikat_akurasi_tekanan->intercept_naik + $data_sertifikat_akurasi_tekanan->x_variable_naik * $meanNaik50;

// stdev
$arr2 = [];
array_push($arr2, $percobaan50_1_naik, $percobaan50_2_naik, $percobaan50_3_naik);
$stdev2 = standard_deviation($arr2);
$koreksi2 = $meanterkoreksi50 - 50;
// hitung uncertainty
$u952 = hitung_uncertainty($resolusi->value, $stdev2, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift50_naik,6);
$absU952 = abs($koreksi2) + $u952;
$score2 = $absU952 < 4 ? 'Lulus' : 'Tidak';

$percobaan100_1_naik = $laporan_akurasi_tekanan->percobaan100_1_naik;
$percobaan100_2_naik = $laporan_akurasi_tekanan->percobaan100_2_naik;
$percobaan100_3_naik = $laporan_akurasi_tekanan->percobaan100_3_naik;
$meanNaik100 = ($percobaan100_1_naik + $percobaan100_2_naik + $percobaan100_3_naik) / 3;
$meanterkoreksi100 = $data_sertifikat_akurasi_tekanan->intercept_naik + $data_sertifikat_akurasi_tekanan->x_variable_naik * $meanNaik100;
// stdev
$arr3 = [];
array_push($arr3, $percobaan100_1_naik, $percobaan100_2_naik, $percobaan100_3_naik);
$stdev3 = standard_deviation($arr3);
$koreksi3 = $meanterkoreksi100 - 100;
// hitung uncertainty
$u953 = hitung_uncertainty($resolusi->value, $stdev3, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift100_naik,6);
$absU953 = abs($koreksi3) + $u953;
$score3 = $absU953 < 4 ? 'Lulus' : 'Tidak';

$percobaan150_1_naik = $laporan_akurasi_tekanan->percobaan150_1_naik;
$percobaan150_2_naik = $laporan_akurasi_tekanan->percobaan150_2_naik;
$percobaan150_3_naik = $laporan_akurasi_tekanan->percobaan150_3_naik;
$meanNaik150 = ($percobaan150_1_naik + $percobaan150_2_naik + $percobaan150_3_naik) / 3;
$meanterkoreksi150 = $data_sertifikat_akurasi_tekanan->intercept_naik + $data_sertifikat_akurasi_tekanan->x_variable_naik * $meanNaik150;
// stdev
$arr4 = [];
array_push($arr4, $percobaan150_1_naik, $percobaan150_2_naik, $percobaan150_3_naik);
$stdev4 = standard_deviation($arr4);
$koreksi4 = $meanterkoreksi150 - 150;
// hitung uncertainty
$u954 = hitung_uncertainty($resolusi->value, $stdev4, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift150_naik,6);
$absU954 = abs($koreksi4) + $u954;
$score4 = $absU954 < 4 ? 'Lulus' : 'Tidak';

$percobaan200_1_naik = $laporan_akurasi_tekanan->percobaan200_1_naik;
$percobaan200_2_naik = $laporan_akurasi_tekanan->percobaan200_2_naik;
$percobaan200_3_naik = $laporan_akurasi_tekanan->percobaan200_3_naik;
$meanNaik200 = ($percobaan200_1_naik + $percobaan200_2_naik + $percobaan200_3_naik) / 3;
$meanterkoreksi200 = $data_sertifikat_akurasi_tekanan->intercept_naik + $data_sertifikat_akurasi_tekanan->x_variable_naik * $meanNaik200;
// stdev
$arr5 = [];
array_push($arr5, $percobaan200_1_naik, $percobaan200_2_naik, $percobaan200_3_naik);
$stdev5 = standard_deviation($arr5);
$koreksi5 = $meanterkoreksi200 - 200;
// hitung uncertainty
$u955 = hitung_uncertainty($resolusi->value, $stdev5, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift200_naik,6);
$absU955 = abs($koreksi5) + $u955;
$score5 = $absU955 < 4 ? 'Lulus' : 'Tidak';

$percobaan250_1_naik = $laporan_akurasi_tekanan->percobaan250_1_naik;
$percobaan250_2_naik = $laporan_akurasi_tekanan->percobaan250_2_naik;
$percobaan250_3_naik = $laporan_akurasi_tekanan->percobaan250_3_naik;
$meanNaik250 = ($percobaan250_1_naik + $percobaan250_2_naik + $percobaan250_3_naik) / 3;
$meanterkoreksi250 = $data_sertifikat_akurasi_tekanan->intercept_naik + $data_sertifikat_akurasi_tekanan->x_variable_naik * $meanNaik250;
// stdev
$arr6 = [];
array_push($arr6, $percobaan250_1_naik, $percobaan250_2_naik, $percobaan250_3_naik);
$stdev6 = standard_deviation($arr6);
$koreksi6 = $meanterkoreksi250 - 250;
// hitung uncertainty
$u956 = hitung_uncertainty($resolusi->value, $stdev6, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift250_naik,6);
$absU956 = abs($koreksi6) + $u956;
$score6 = $absU956 < 4 ? 'Lulus' : 'Tidak';

// turun
$percobaan250_1_turun = $laporan_akurasi_tekanan->percobaan250_1_turun;
$percobaan250_2_turun = $laporan_akurasi_tekanan->percobaan250_2_turun;
$percobaan250_3_turun = $laporan_akurasi_tekanan->percobaan250_3_turun;
$meanTurun250 = ($percobaan250_1_turun + $percobaan250_2_turun + $percobaan250_3_turun) / 3;
$meanterkoreksiTurun250 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun250;
// stdev
$arr7 = [];
array_push($arr7, $percobaan250_1_turun, $percobaan250_2_turun, $percobaan250_3_turun);
$stdev7 = standard_deviation($arr7);
$koreksi7 = $meanterkoreksiTurun250 - 250;
// hitung uncertainty
$u957 = hitung_uncertainty($resolusi->value, $stdev7, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift250_turun,6);
$absU957 = abs($koreksi7) + $u957;
$score7 = $absU957 < 4 ? 'Lulus' : 'Tidak';

$percobaan200_1_turun = $laporan_akurasi_tekanan->percobaan200_1_turun;
$percobaan200_2_turun = $laporan_akurasi_tekanan->percobaan200_2_turun;
$percobaan200_3_turun = $laporan_akurasi_tekanan->percobaan200_3_turun;
$meanTurun200 = ($percobaan200_1_turun + $percobaan200_2_turun + $percobaan200_3_turun) / 3;
$meanterkoreksiTurun200 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun200;
// stdev
$arr8 = [];
array_push($arr8, $percobaan200_1_turun, $percobaan200_2_turun, $percobaan200_3_turun);
$stdev8 = standard_deviation($arr8);
$koreksi8 = $meanterkoreksiTurun200 - 200;
// hitung uncertainty
$u958 = hitung_uncertainty($resolusi->value, $stdev8, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift200_turun,6);
$absU958 = abs($koreksi8) + $u958;
$score8 = $absU958 < 4 ? 'Lulus' : 'Tidak';

$percobaan150_1_turun = $laporan_akurasi_tekanan->percobaan150_1_turun;
$percobaan150_2_turun = $laporan_akurasi_tekanan->percobaan150_2_turun;
$percobaan150_3_turun = $laporan_akurasi_tekanan->percobaan150_3_turun;
$meanTurun150 = ($percobaan150_1_turun + $percobaan150_2_turun + $percobaan150_3_turun) / 3;
$meanterkoreksiTurun150 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun150;
// stdev
$arr9 = [];
array_push($arr9, $percobaan150_1_turun, $percobaan150_2_turun, $percobaan150_3_turun);
$stdev9 = standard_deviation($arr9);
$koreksi9 = $meanterkoreksiTurun150 - 150;
// hitung uncertainty
$u959 = hitung_uncertainty($resolusi->value, $stdev9, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift150_turun,6);
$absU959 = abs($koreksi9) + $u959;
$score9 = $absU959 < 4 ? 'Lulus' : 'Tidak';

$percobaan100_1_turun = $laporan_akurasi_tekanan->percobaan100_1_turun;
$percobaan100_2_turun = $laporan_akurasi_tekanan->percobaan100_2_turun;
$percobaan100_3_turun = $laporan_akurasi_tekanan->percobaan100_3_turun;
$meanTurun100 = ($percobaan100_1_turun + $percobaan100_2_turun + $percobaan100_3_turun) / 3;
$meanterkoreksiTurun100 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun100;
// stdev
$arr10 = [];
array_push($arr10, $percobaan100_1_turun, $percobaan100_2_turun, $percobaan100_3_turun);
$stdev10 = standard_deviation($arr10);
$koreksi10 = $meanterkoreksiTurun100 - 100;
// hitung uncertainty
$u9510 = hitung_uncertainty($resolusi->value, $stdev10, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift100_turun,6);
$absU9510 = abs($koreksi10) + $u9510;
$score10 = $absU9510 < 4 ? 'Lulus' : 'Tidak';

$percobaan50_1_turun = $laporan_akurasi_tekanan->percobaan50_1_turun;
$percobaan50_2_turun = $laporan_akurasi_tekanan->percobaan50_2_turun;
$percobaan50_3_turun = $laporan_akurasi_tekanan->percobaan50_3_turun;
$meanTurun50 = ($percobaan50_1_turun + $percobaan50_2_turun + $percobaan50_3_turun) / 3;
$meanterkoreksiTurun50 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun50;
// stdev
$arr11 = [];
array_push($arr11, $percobaan50_1_turun, $percobaan50_2_turun, $percobaan50_3_turun);
$stdev11 = standard_deviation($arr11);
$koreksi11 = $meanterkoreksiTurun50 - 50;
// hitung uncertainty
$u9511 = hitung_uncertainty($resolusi->value, $stdev11, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift50_turun,6);
$absU9511 = abs($koreksi11) + $u9511;
$score11 = $absU9511 < 4 ? 'Lulus' : 'Tidak';

$percobaan0_1_turun = $laporan_akurasi_tekanan->percobaan0_1_turun;
$percobaan0_2_turun = $laporan_akurasi_tekanan->percobaan0_2_turun;
$percobaan0_3_turun = $laporan_akurasi_tekanan->percobaan0_3_turun;
$meanTurun0 = ($percobaan0_1_turun + $percobaan0_2_turun + $percobaan0_3_turun) / 3;
$meanterkoreksiTurun0 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun0;
// stdev
$arr12 = [];
array_push($arr12, $percobaan0_1_turun, $percobaan0_2_turun, $percobaan0_3_turun);
$stdev12 = standard_deviation($arr12);
$koreksi12 = $meanterkoreksiTurun0 - 00;
// hitung uncertainty
$u9512 = hitung_uncertainty($resolusi->value, $stdev12, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift0_turun,6);
$absU9512 = abs($koreksi12) + $u9512;
$score12 = $absU9512 < 4 ? 'Lulus' : 'Tidak';

$pembagi = 12;
$initScore = 0;
if ($score == 'Lulus') {
    $initScore = $initScore + 1;
}
if ($score2 == 'Lulus') {
    $initScore = $initScore + 1;
}
if ($score3 == 'Lulus') {
    $initScore = $initScore + 1;
}
if ($score4 == 'Lulus') {
    $initScore = $initScore + 1;
}
if ($score5 == 'Lulus') {
    $initScore = $initScore + 1;
}
if ($score6 == 'Lulus') {
    $initScore = $initScore + 1;
}
if ($score7 == 'Lulus') {
    $initScore = $initScore + 1;
}
if ($score8 == 'Lulus') {
    $initScore = $initScore + 1;
}
if ($score9 == 'Lulus') {
    $initScore = $initScore + 1;
}
if ($score10 == 'Lulus') {
    $initScore = $initScore + 1;
}
if ($score11 == 'Lulus') {
    $initScore = $initScore + 1;
}
if ($score12 == 'Lulus') {
    $initScore = $initScore + 1;
}
$initScore = (($initScore / $pembagi) * 100) / 2;
?>

<p style="font-size: 11px;margin-left:18px"><b>1. CEK KEBOCORAN TEKANAN SETELAH 60 DETIK</b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:9px;width:100%;margin-top:-10px; padding-right:18px">
    <thead>
        <tr>
            <th style="text-align: center;vertical-align: middle;width:10%">Setting (mmHg)</th>
            <th style="text-align: center;vertical-align: middle;width:30%">Kebocoran (mmHg)</th>
            <th style="text-align: center;vertical-align: middle;width:40%">Penyimpangan yang di ijinkan</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="vertical-align: middle;text-align: center">250</td>
            <td style="vertical-align: middle;text-align: center">{{ $laporan_kebocoran_tekanan->value }}</td>
            <td style="vertical-align: middle;text-align: center"><img src="../public/asset/kurang.png"
                    style="width: 6px; margin-top:3px"> 15 mmHg/menit</td>
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
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="vertical-align: middle;text-align: center">260</td>
            <td style="vertical-align: middle;text-align: center">{{ round($hitungLajuHasil, 2) }}</td>
            <td style="vertical-align: middle;text-align: center"> <img src="../public/asset/kurang.png"
                    style="width: 6px; margin-top:3px"> 10 detik</td>
        </tr>
    </tbody>
</table>

<p style="font-size: 11px;margin-left:18px"><b>3. KALIBRASI AKURASI TEKANAN</b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:9px;width:100%;margin-top:-10px; padding-right:18px">
    <thead>
        <tr>
            <th colspan="2" style="text-align: center;vertical-align: middle;">Setting (mmHg)</th>
            <th style="text-align: center;vertical-align: middle;">Pembacaan Standar</th>
            <th style="text-align: center;vertical-align: middle;">Koreksi</th>
            <th style="text-align: center;vertical-align: middle;">Ketidakpastian (U95)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td rowspan="6" style="background-color:grey;text-align: center;vertical-align: middle;width:75px">
                <span style="font-size:18px;color:white"><b>Naik</b></span>
            </td>
            <td>0</td>
            <td>{{ round($meanterkoreksi0, 2) }}</td>
            <td>{{ round($koreksi, 2) }}</td>
            <td>± {{ round($u95, 2) }}</td>
        </tr>
        <tr>
            <td>50</td>
            <td>{{ round($meanterkoreksi50, 2) }}</td>
            <td>{{ round($koreksi2, 2) }}</td>
            <td>± {{ round($u952, 2) }}</td>
        </tr>
        <tr>
            <td>100</td>
            <td>{{ round($meanterkoreksi100, 2) }}</td>
            <td>{{ round($koreksi3, 2) }}</td>
            <td>± {{ round($u953, 2) }}</td>
        </tr>
        <tr>
            <td>150</td>
            <td>{{ round($meanterkoreksi150, 2) }}</td>
            <td>{{ round($koreksi4, 2) }}</td>
            <td>± {{ round($u954, 2) }}</td>
        </tr>
        <tr>
            <td>200</td>
            <td>{{ round($meanterkoreksi200, 2) }}</td>
            <td>{{ round($koreksi5, 2) }}</td>
            <td>± {{ round($u955, 2) }}</td>
        </tr>
        <tr>
            <td>250</td>
            <td>{{ round($meanterkoreksi250, 2) }}</td>
            <td>{{ round($koreksi6, 2) }}</td>
            <td>± {{ round($u956, 2) }}</td>
        </tr>
        <tr>
            <td rowspan="6" style="background-color:grey;text-align: center;vertical-align: middle;"> <span
                    style="font-size:18px; color:white"><b>Turun</b></span></td>
            <td>250</td>
            <td>{{ round($meanterkoreksiTurun250, 2) }}</td>
            <td>{{ round($koreksi7, 2) }}</td>
            <td>± {{ round($u957, 2) }}</td>
        </tr>
        <tr>
            <td>200</td>
            <td>{{ round($meanterkoreksiTurun200, 2) }}</td>
            <td>{{ round($koreksi8, 2) }}</td>
            <td>± {{ round($u958, 2) }}</td>
        </tr>
        <tr>
            <td>150</td>
            <td>{{ round($meanterkoreksiTurun150, 2) }}</td>
            <td>{{ round($koreksi9, 2) }}</td>
            <td>± {{ round($u959, 2) }}</td>
        </tr>
        <tr>
            <td>100</td>
            <td>{{ round($meanterkoreksiTurun100, 2) }}</td>
            <td>{{ round($koreksi10, 2) }}</td>
            <td>± {{ round($u9510, 2) }}</td>
        </tr>
        <tr>
            <td>50</td>
            <td>{{ round($meanterkoreksiTurun50, 2) }}</td>
            <td>{{ round($koreksi11, 2) }}</td>
            <td>± {{ round($u9511, 2) }}</td>
        </tr>
        <tr>
            <td>0</td>
            <td>{{ round($meanterkoreksiTurun0, 2) }}</td>
            <td>{{ round($u9512, 2) }}</td>
            <td>± {{ round($absU9512, 2) }}</td>
        </tr>
    </tbody>
</table>


{{-- telaah_teknis --}}
<p style="font-size: 14px"><b>{{ $count_laporan_pengukuran_keselamatan_listrik > 0 ? 'G' : 'F' }}. TELAAH
        TEKNIS</b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
    <tbody>
        @forelse ($laporan_telaah_teknis as $row)
            <tr>
                <td style="width: 4%;text-align: center;">{{ $loop->iteration }}</td>
                <td style="text-align: justify;vertical-align: middle;">{{ $row->field_telaah_teknis }}</td>
                <td>
                    <div class="form-group" style="margin: 0px">
                        <input type="checkbox" {{ $row->value == 'baik' ? 'checked' : '' }}>
                        <label>Baik</label>
                    </div>
                    <div class="form-group" style="margin: 0px">
                        <input type="checkbox" {{ $row->value == 'tidak-baik' ? 'checked' : '' }}>
                        <label>Tidak Baik</label>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td style="text-align: center;">-</td>
                <td style="text-align: center;">-</td>
                <td style="text-align: center;">-</td>
            </tr>
        @endforelse
    </tbody>
</table>
@php
    $totalAll = $score_fisik + $scoreTekananHasil + $scoreLajuHasil + $initScore;
@endphp


<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
    <tbody>
        <tr>
            <td style="height:60px"><b>Catatan :</b> {{ $laporan_kesimpulan_telaah_teknis->catatan }} </td>
        </tr>
    </tbody>
</table>


<p style="font-size: 14px"><b>{{ $count_laporan_pengukuran_keselamatan_listrik > 0 ? 'H' : 'G' }}. KESIMPULAN</b>
</p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
    <tbody>
        <tr>
            <td style="height:70px" style="text-align: justify">Berdasarkan Metode Kerja
                <b>{{ $laporan->no_dokumen }}</b> yang mengacu ke KEPUTUSAN
                DIREKTUR JENDERAL PELAYANAN KESEHATAN NOMOR : <b>HK.02.02/V/0412/2020</b>, METODE KERJA PENGUJIAN
                DAN ATAU
                KALIBRASI ALAT KESEHATAN, KEMENTERIAN KESEHATAN RI. Maka peralatan ini dinyatakan :
                <b>ALAT DINYATAKAN <?php echo $totalAll >= 70 ? 'LAIK PAKAI' : 'TIDAK LAIK PAKAI'; ?></b>
            </td>
        </tr>
    </tbody>
</table>
<p style="font-size: 14px"><b>{{ $count_laporan_pengukuran_keselamatan_listrik > 0 ? 'I' : 'H' }}. SARAN</b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
    <tbody>
        <tr>
            <td style="height:30px">Lakukan Pemeliharaan Preventif dan Kalibrasi Ulang Secara Berkala </td>
        </tr>
    </tbody>
</table>
<p style="font-size: 14px"><b>{{ $count_laporan_pengukuran_keselamatan_listrik > 0 ? 'J' : 'I' }}. KETERANGAN</b>
</p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
    <tbody>
        <tr>
            <td style="height:60px">
                <ul style="margin-left: -25px">
                    <li>Nilai sebenarnya adalah nilai penunjukan alat ditambah nilai koreksi</li>
                    <li>Nilai Ketidakpastian pengukuran dinyatakan pada tingkat kepercayaan 95 %, k = 2</li>
                    <li>Hasil kalibrasi Flow Rate tertelusur ke sistem satuan internasional (SI) melalui
                        <b>LK-110-IDN</b>
                    </li>
                    <li>Hasil Pengujian Kelistrikan tertelusur ke sistem satuan internasional (SI) melalui
                        <b>LK-032-IDN</b>
                    </li>
                    <li>Hasil pengujian dan kalibrasi hanya terkait dengan kondisi yang dilaporkan </li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>
