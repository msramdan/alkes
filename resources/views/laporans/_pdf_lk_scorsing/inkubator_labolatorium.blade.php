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

{{-- pengukuran_keselamatan_listrik --}}
@if ($count_laporan_pengukuran_keselamatan_listrik > 0)
    <?php
    $cek = json_decode(get_data_litsrik($laporan->no_laporan, 'slug', 'phase-netral')->data_sertifikat);

    $hitungPhaseNetral = round($cek->intercept1 + $cek->x_variable1 * get_data_litsrik($laporan->no_laporan, 'slug', 'phase-netral')->value, 2);

    $hitungPhaseGround = round($cek->intercept3 + $cek->x_variable3 * get_data_litsrik($laporan->no_laporan, 'slug', 'phase-ground')->value, 2);

    $hitungGroundNetral = round($cek->intercept2 + $cek->x_variable2 * get_data_litsrik($laporan->no_laporan, 'slug', 'ground-netral')->value, 2);

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

$resolusi = DB::table('laporan_pendataan_administrasi')
    ->where('no_laporan', $laporan->no_laporan)
    ->where('slug', 'resolusi')
    ->first();
// ======================
$laporan_sensor_recorder = DB::table('laporan_kinerja')
    ->where('type_laporan_kinerja', 'sensor_recorder')
    ->where('no_laporan', $laporan->no_laporan)
    ->first();
$data_sertifikat = json_decode($laporan_sensor_recorder->data_sertifikat);
$data_laporan = json_decode($laporan_sensor_recorder->data_laporan);
// start from Min
$posisi_sensor = $data_laporan->posisi_sensor;
$setting_1_min = $data_laporan->posisi_sensor;
$setting_1_max = $data_laporan->posisi_sensor;
$setting_2_min = $data_laporan->posisi_sensor;
$setting_2_max = $data_laporan->posisi_sensor;
$setting_3_min = $data_laporan->posisi_sensor;
$setting_3_max = $data_laporan->posisi_sensor;
$setting_mean_min = ($setting_1_min + $setting_2_min + $setting_3_min  )/3;
$setting_mean_max = ($setting_1_max + $setting_2_max + $setting_3_max  )/3;

// 1
// Min
$percobaan1_1_min = $data_laporan->percobaan1_1_min;
$percobaan1_2_min = $data_laporan->percobaan1_2_min;
$percobaan1_3_min = $data_laporan->percobaan1_3_min;
$mean_1_min = ($percobaan1_1_min + $percobaan1_2_min + $percobaan1_3_min) / 3;
$mean_terkoreksi_1_min = $data_sertifikat->intercept_1 + $data_sertifikat->slope_1 * $mean_1_min;
// Max
$percobaan1_1_max = $data_laporan->percobaan1_1_max;
$percobaan1_2_max = $data_laporan->percobaan1_2_max;
$percobaan1_3_max = $data_laporan->percobaan1_3_max;
$mean_1_max = ($percobaan1_1_max + $percobaan1_2_max + $percobaan1_3_max) / 3;
$mean_terkoreksi_1_max = $data_sertifikat->intercept_1 + $data_sertifikat->slope_1 * $mean_1_max;
$t1 =$mean_terkoreksi_1_max - $mean_terkoreksi_1_min;
$mid1 =($mean_terkoreksi_1_max + $mean_terkoreksi_1_min)/2;
// 2
// Min
$percobaan2_1_min = $data_laporan->percobaan2_1_min;
$percobaan2_2_min = $data_laporan->percobaan2_2_min;
$percobaan2_3_min = $data_laporan->percobaan2_3_min;
$mean_2_min = ($percobaan2_1_min + $percobaan2_2_min + $percobaan2_3_min) / 3;
$mean_terkoreksi_2_min = $data_sertifikat->intercept_2 + $data_sertifikat->slope_2 * $mean_2_min;
// Max
$percobaan2_1_max = $data_laporan->percobaan2_1_max;
$percobaan2_2_max = $data_laporan->percobaan2_2_max;
$percobaan2_3_max = $data_laporan->percobaan2_3_max;
$mean_2_max = ($percobaan2_1_max + $percobaan2_2_max + $percobaan2_3_max) / 3;
$mean_terkoreksi_2_max = $data_sertifikat->intercept_2 + $data_sertifikat->slope_2 * $mean_2_max;
$t2 =$mean_terkoreksi_2_max - $mean_terkoreksi_2_min;
$mid2 =($mean_terkoreksi_2_max + $mean_terkoreksi_2_min)/2;

// 3
// Min
$percobaan3_1_min = $data_laporan->percobaan3_1_min;
$percobaan3_2_min = $data_laporan->percobaan3_2_min;
$percobaan3_3_min = $data_laporan->percobaan3_3_min;
$mean_3_min = ($percobaan3_1_min + $percobaan3_2_min + $percobaan3_3_min) / 3;
$mean_terkoreksi_3_min = $data_sertifikat->intercept_3 + $data_sertifikat->slope_3 * $mean_3_min;
// Max
$percobaan3_1_max = $data_laporan->percobaan3_1_max;
$percobaan3_2_max = $data_laporan->percobaan3_2_max;
$percobaan3_3_max = $data_laporan->percobaan3_3_max;
$mean_3_max = ($percobaan3_1_max + $percobaan3_2_max + $percobaan3_3_max) / 3;
$mean_terkoreksi_3_max = $data_sertifikat->intercept_3 + $data_sertifikat->slope_3 * $mean_3_max;
$t3 =$mean_terkoreksi_3_max - $mean_terkoreksi_3_min;
$mid3 =($mean_terkoreksi_3_max + $mean_terkoreksi_3_min)/2;

// 4
// Min
$percobaan4_1_min = $data_laporan->percobaan4_1_min;
$percobaan4_2_min = $data_laporan->percobaan4_2_min;
$percobaan4_3_min = $data_laporan->percobaan4_3_min;
$mean_4_min = ($percobaan4_1_min + $percobaan4_2_min + $percobaan4_3_min) / 3;
$mean_terkoreksi_4_min = $data_sertifikat->intercept_4 + $data_sertifikat->slope_4 * $mean_4_min;
// Max
$percobaan4_1_max = $data_laporan->percobaan4_1_max;
$percobaan4_2_max = $data_laporan->percobaan4_2_max;
$percobaan4_3_max = $data_laporan->percobaan4_3_max;
$mean_4_max = ($percobaan4_1_max + $percobaan4_2_max + $percobaan4_3_max) / 3;
$mean_terkoreksi_4_max = $data_sertifikat->intercept_4 + $data_sertifikat->slope_4 * $mean_4_max;
$t4 =$mean_terkoreksi_4_max - $mean_terkoreksi_4_min;
$mid4 =($mean_terkoreksi_4_max + $mean_terkoreksi_4_min)/2;

// 5
// Min
$percobaan5_1_min = $data_laporan->percobaan5_1_min;
$percobaan5_2_min = $data_laporan->percobaan5_2_min;
$percobaan5_3_min = $data_laporan->percobaan5_3_min;
$mean_5_min = ($percobaan5_1_min + $percobaan5_2_min + $percobaan5_3_min) / 3;
$mean_terkoreksi_5_min = $data_sertifikat->intercept_5 + $data_sertifikat->slope_5 * $mean_5_min;
// Max
$percobaan5_1_max = $data_laporan->percobaan5_1_max;
$percobaan5_2_max = $data_laporan->percobaan5_2_max;
$percobaan5_3_max = $data_laporan->percobaan5_3_max;
$mean_5_max = ($percobaan5_1_max + $percobaan5_2_max + $percobaan5_3_max) / 3;
$mean_terkoreksi_5_max = $data_sertifikat->intercept_5 + $data_sertifikat->slope_5 * $mean_5_max;
$t5 =$mean_terkoreksi_5_max - $mean_terkoreksi_5_min;
$mid5 =($mean_terkoreksi_5_max + $mean_terkoreksi_5_min)/2;

// 6
// Min
$percobaan6_1_min = $data_laporan->percobaan6_1_min;
$percobaan6_2_min = $data_laporan->percobaan6_2_min;
$percobaan6_3_min = $data_laporan->percobaan6_3_min;
$mean_6_min = ($percobaan6_1_min + $percobaan6_2_min + $percobaan6_3_min) / 3;
$mean_terkoreksi_6_min = $data_sertifikat->intercept_6 + $data_sertifikat->slope_6 * $mean_6_min;
// Max
$percobaan6_1_max = $data_laporan->percobaan6_1_max;
$percobaan6_2_max = $data_laporan->percobaan6_2_max;
$percobaan6_3_max = $data_laporan->percobaan6_3_max;
$mean_6_max = ($percobaan6_1_max + $percobaan6_2_max + $percobaan6_3_max) / 3;
$mean_terkoreksi_6_max = $data_sertifikat->intercept_6 + $data_sertifikat->slope_6 * $mean_6_max;
$t6 =$mean_terkoreksi_6_max - $mean_terkoreksi_6_min;
$mid6 =($mean_terkoreksi_6_max + $mean_terkoreksi_6_min)/2;

// 7
// Min
$percobaan7_1_min = $data_laporan->percobaan7_1_min;
$percobaan7_2_min = $data_laporan->percobaan7_2_min;
$percobaan7_3_min = $data_laporan->percobaan7_3_min;
$mean_7_min = ($percobaan7_1_min + $percobaan7_2_min + $percobaan7_3_min) / 3;
$mean_terkoreksi_7_min = $data_sertifikat->intercept_7 + $data_sertifikat->slope_7 * $mean_7_min;
// Max
$percobaan7_1_max = $data_laporan->percobaan7_1_max;
$percobaan7_2_max = $data_laporan->percobaan7_2_max;
$percobaan7_3_max = $data_laporan->percobaan7_3_max;
$mean_7_max = ($percobaan7_1_max + $percobaan7_2_max + $percobaan7_3_max) / 3;
$mean_terkoreksi_7_max = $data_sertifikat->intercept_7 + $data_sertifikat->slope_7 * $mean_7_max;
$t7 =$mean_terkoreksi_7_max - $mean_terkoreksi_7_min;
$mid7 =($mean_terkoreksi_7_max + $mean_terkoreksi_7_min)/2;

// 8
// Min
$percobaan8_1_min = $data_laporan->percobaan8_1_min;
$percobaan8_2_min = $data_laporan->percobaan8_2_min;
$percobaan8_3_min = $data_laporan->percobaan8_3_min;
$mean_8_min = ($percobaan8_1_min + $percobaan8_2_min + $percobaan8_3_min) / 3;
$mean_terkoreksi_8_min = $data_sertifikat->intercept_8 + $data_sertifikat->slope_8 * $mean_8_min;
// Max
$percobaan8_1_max = $data_laporan->percobaan8_1_max;
$percobaan8_2_max = $data_laporan->percobaan8_2_max;
$percobaan8_3_max = $data_laporan->percobaan8_3_max;
$mean_8_max = ($percobaan8_1_max + $percobaan8_2_max + $percobaan8_3_max) / 3;
$mean_terkoreksi_8_max = $data_sertifikat->intercept_8 + $data_sertifikat->slope_8 * $mean_8_max;
$t8 =$mean_terkoreksi_8_max - $mean_terkoreksi_8_min;
$mid8 =($mean_terkoreksi_8_max + $mean_terkoreksi_8_min)/2;

// 9
// Min
$percobaan9_1_min = $data_laporan->percobaan9_1_min;
$percobaan9_2_min = $data_laporan->percobaan9_2_min;
$percobaan9_3_min = $data_laporan->percobaan9_3_min;
$mean_9_min = ($percobaan9_1_min + $percobaan9_2_min + $percobaan9_3_min) / 3;
$mean_terkoreksi_9_min = $data_sertifikat->intercept_9 + $data_sertifikat->slope_9 * $mean_9_min;
// Max
$percobaan9_1_max = $data_laporan->percobaan9_1_max;
$percobaan9_2_max = $data_laporan->percobaan9_2_max;
$percobaan9_3_max = $data_laporan->percobaan9_3_max;
$mean_9_max = ($percobaan9_1_max + $percobaan9_2_max + $percobaan9_3_max) / 3;
$mean_terkoreksi_9_max = $data_sertifikat->intercept_9 + $data_sertifikat->slope_9 * $mean_9_max;
$t9 =$mean_terkoreksi_9_max - $mean_terkoreksi_9_min;
$mid9 =($mean_terkoreksi_9_max + $mean_terkoreksi_9_min)/2;

// analisa
$arryMid =[];
array_push($arryMid,$mid1,$mid2,$mid3,$mid4,$mid5,$mid6,$mid7,$mid8,$mid9);
$maxArr = max($arryMid);
$minArr = min($arryMid);

$suhu_alat_dari_penunjukan_indikator = ($setting_mean_min + $setting_mean_max )/2;
$suhu_alat_dari_hasil_pengukuran =($maxArr + $minArr ) /2 ;
$variasi_suhu_spasial =$maxArr - $minArr ;

$arryT =[];
array_push($arryT,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9);
$variasi_suhu_temporal = max($arryT) ;
$arryMeanMax = [];
array_push($arryMeanMax,$mean_terkoreksi_1_max,$mean_terkoreksi_2_max,$mean_terkoreksi_3_max,$mean_terkoreksi_4_max,$mean_terkoreksi_5_max,$mean_terkoreksi_6_max,$mean_terkoreksi_7_max,$mean_terkoreksi_8_max,$mean_terkoreksi_9_max);
$arryMeanMin = [];
array_push($arryMeanMin,$mean_terkoreksi_1_min,$mean_terkoreksi_2_min,$mean_terkoreksi_3_min,$mean_terkoreksi_4_min,$mean_terkoreksi_5_min,$mean_terkoreksi_6_min,$mean_terkoreksi_7_min,$mean_terkoreksi_8_min,$mean_terkoreksi_9_min);
$variasi_suhu_total = max($arryMeanMax) - min($arryMeanMin);

$x = json_decode($laporan_kondisi_lingkungan->data_laporan);
$y = json_decode($laporan_kondisi_lingkungan->data_sertifikat);
$suhu_ruang = ($x->suhu_awal + $x->suhu_akhir) / 2 ;
$abs_suhu_ruangan = abs($variasi_suhu_total);
$koreksi =round($y->intercept_suhu + ($y->x_variable_suhu * $suhu_ruang), 2);
$abs_koreksi = abs($koreksi);
$score_abs_suhu_ruangan = $abs_suhu_ruangan < 3 ? 100 : 0;
$score_abs_koreksi = $abs_koreksi < 1.5 ? 100 : 0;
$score_kinerja = ($score_abs_suhu_ruangan + $score_abs_koreksi ) /2;

$totalAll = $score_fisik + $point + $score_kinerja;

?>
<center>
    <img src="../public/asset/inkubator.jpeg" style="width: 95%;">
</center>
<br>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:9px;width:100%;margin-top:-10px; padding-right:18px">
    <thead>
        <tr>
            <th rowspan="3" style="text-align: center;vertical-align: middle;">Posisi <br> Sensor</th>
            <th colspan="6" style="text-align: center;vertical-align: middle;">Penunjukan Alat</th>
            <th rowspan="3" style="text-align: center;vertical-align: middle;">Mean Min</th>
            <th rowspan="3" style="text-align: center;vertical-align: middle;">Mean Max</th>
            <th rowspan="3" style="text-align: center;vertical-align: middle;">Mean Min <br> Terkoreksi</th>
            <th rowspan="3" style="text-align: center;vertical-align: middle;">Mean Max <br> Terkoreksi</th>
            <th rowspan="3" style="text-align: center;vertical-align: middle;">At (°C)</th>
            <th rowspan="3" style="text-align: center;vertical-align: middle;">Mid Range (°C)</th>
        </tr>
        <tr>
            <th colspan="2" style="text-align: center;vertical-align: middle;">1</th>
            <th colspan="2" style="text-align: center;vertical-align: middle;">2</th>
            <th colspan="2" style="text-align: center;vertical-align: middle;">3</th>
        </tr>
        <tr>
            <th style="text-align: center;vertical-align: middle;">Min</th>
            <th style="text-align: center;vertical-align: middle;">Max</th>
            <th style="text-align: center;vertical-align: middle;">Min</th>
            <th style="text-align: center;vertical-align: middle;">Max</th>
            <th style="text-align: center;vertical-align: middle;">Min</th>
            <th style="text-align: center;vertical-align: middle;">Max</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>{{ $percobaan1_1_min }}</td>
            <td>{{ $percobaan1_1_max }}</td>
            <td>{{ $percobaan1_2_min }}</td>
            <td>{{ $percobaan1_2_max }}</td>
            <td>{{ $percobaan1_3_min }}</td>
            <td>{{ $percobaan1_3_max }}</td>
            <td>{{ round($mean_1_min, 2) }}</td>
            <td>{{ round($mean_1_max, 2) }}</td>
            <td>{{ round($mean_terkoreksi_1_min, 2) }}</td>
            <td>{{ round($mean_terkoreksi_1_max, 2) }}</td>
            <td>{{ round($t1, 2) }}</td>
            <td>{{ round($mid1, 2) }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>{{ $percobaan2_1_min }}</td>
            <td>{{ $percobaan2_1_max }}</td>
            <td>{{ $percobaan2_2_min }}</td>
            <td>{{ $percobaan2_2_max }}</td>
            <td>{{ $percobaan2_3_min }}</td>
            <td>{{ $percobaan2_3_max }}</td>
            <td>{{ round($mean_2_min, 2) }}</td>
            <td>{{ round($mean_2_max, 2) }}</td>
            <td>{{ round($mean_terkoreksi_2_min, 2) }}</td>
            <td>{{ round($mean_terkoreksi_2_max, 2) }}</td>
            <td>{{ round($t2, 2) }}</td>
            <td>{{ round($mid2, 2) }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>{{ $percobaan3_1_min }}</td>
            <td>{{ $percobaan3_1_max }}</td>
            <td>{{ $percobaan3_2_min }}</td>
            <td>{{ $percobaan3_2_max }}</td>
            <td>{{ $percobaan3_3_min }}</td>
            <td>{{ $percobaan3_3_max }}</td>
            <td>{{ round($mean_3_min, 2) }}</td>
            <td>{{ round($mean_3_max, 2) }}</td>
            <td>{{ round($mean_terkoreksi_3_min, 2) }}</td>
            <td>{{ round($mean_terkoreksi_3_max, 2) }}</td>
            <td>{{ round($t3, 2) }}</td>
            <td>{{ round($mid3, 2) }}</td>
        </tr>
        <tr>
            <td>4</td>
            <td>{{ $percobaan4_1_min }}</td>
            <td>{{ $percobaan4_1_max }}</td>
            <td>{{ $percobaan4_2_min }}</td>
            <td>{{ $percobaan4_2_max }}</td>
            <td>{{ $percobaan4_3_min }}</td>
            <td>{{ $percobaan4_3_max }}</td>
            <td>{{ round($mean_4_min, 2) }}</td>
            <td>{{ round($mean_4_max, 2) }}</td>
            <td>{{ round($mean_terkoreksi_4_min, 2) }}</td>
            <td>{{ round($mean_terkoreksi_4_max, 2) }}</td>
            <td>{{ round($t4, 2) }}</td>
            <td>{{ round($mid4, 2) }}</td>
        </tr>
        <tr>
            <td>5</td>
            <td>{{ $percobaan5_1_min }}</td>
            <td>{{ $percobaan5_1_max }}</td>
            <td>{{ $percobaan5_2_min }}</td>
            <td>{{ $percobaan5_2_max }}</td>
            <td>{{ $percobaan5_3_min }}</td>
            <td>{{ $percobaan5_3_max }}</td>
            <td>{{ round($mean_5_min, 2) }}</td>
            <td>{{ round($mean_5_max, 2) }}</td>
            <td>{{ round($mean_terkoreksi_5_min, 2) }}</td>
            <td>{{ round($mean_terkoreksi_5_max, 2) }}</td>
            <td>{{ round($t5, 2) }}</td>
            <td>{{ round($mid5, 2) }}</td>
        </tr>
        <tr>
            <td>6</td>
            <td>{{ $percobaan6_1_min }}</td>
            <td>{{ $percobaan6_1_max }}</td>
            <td>{{ $percobaan6_2_min }}</td>
            <td>{{ $percobaan6_2_max }}</td>
            <td>{{ $percobaan6_3_min }}</td>
            <td>{{ $percobaan6_3_max }}</td>
            <td>{{ round($mean_6_min, 2) }}</td>
            <td>{{ round($mean_6_max, 2) }}</td>
            <td>{{ round($mean_terkoreksi_6_min, 2) }}</td>
            <td>{{ round($mean_terkoreksi_6_max, 2) }}</td>
            <td>{{ round($t6, 2) }}</td>
            <td>{{ round($mid6, 2) }}</td>
        </tr>
        <tr>
            <td>7</td>
            <td>{{ $percobaan7_1_min }}</td>
            <td>{{ $percobaan7_1_max }}</td>
            <td>{{ $percobaan7_2_min }}</td>
            <td>{{ $percobaan7_2_max }}</td>
            <td>{{ $percobaan7_3_min }}</td>
            <td>{{ $percobaan7_3_max }}</td>
            <td>{{ round($mean_7_min, 2) }}</td>
            <td>{{ round($mean_7_max, 2) }}</td>
            <td>{{ round($mean_terkoreksi_7_min, 2) }}</td>
            <td>{{ round($mean_terkoreksi_7_max, 2) }}</td>
            <td>{{ round($t7, 2) }}</td>
            <td>{{ round($mid7, 2) }}</td>
        </tr>
        <tr>
            <td>8</td>
            <td>{{ $percobaan8_1_min }}</td>
            <td>{{ $percobaan8_1_max }}</td>
            <td>{{ $percobaan8_2_min }}</td>
            <td>{{ $percobaan8_2_max }}</td>
            <td>{{ $percobaan8_3_min }}</td>
            <td>{{ $percobaan8_3_max }}</td>
            <td>{{ round($mean_8_min, 2) }}</td>
            <td>{{ round($mean_8_max, 2) }}</td>
            <td>{{ round($mean_terkoreksi_8_min, 2) }}</td>
            <td>{{ round($mean_terkoreksi_8_max, 2) }}</td>
            <td>{{ round($t8, 2) }}</td>
            <td>{{ round($mid8, 2) }}</td>
        </tr>
        <tr>
            <td>9</td>
            <td>{{ $percobaan9_1_min }}</td>
            <td>{{ $percobaan9_1_max }}</td>
            <td>{{ $percobaan9_2_min }}</td>
            <td>{{ $percobaan9_2_max }}</td>
            <td>{{ $percobaan9_3_min }}</td>
            <td>{{ $percobaan9_3_max }}</td>
            <td>{{ round($mean_9_min, 2) }}</td>
            <td>{{ round($mean_9_max, 2) }}</td>
            <td>{{ round($mean_terkoreksi_9_min, 2) }}</td>
            <td>{{ round($mean_terkoreksi_9_max, 2) }}</td>
            <td>{{ round($t9, 2) }}</td>
            <td>{{ round($mid9, 2) }}</td>
        </tr>
        <tr>
            <td>Suhu Indikator</td>
            <td>{{ $setting_1_min }}</td>
            <td>{{ $setting_1_max }}</td>
            <td>{{ $setting_2_min }}</td>
            <td>{{ $setting_2_max }}</td>
            <td>{{ $setting_3_min }}</td>
            <td>{{ $setting_3_max }}</td>
            <td>{{ round($setting_mean_min, 2) }}</td>
            <td>{{ round($setting_mean_max, 2) }}</td>

            <td></td>
            <td></td>
            <td>0</td>
            <td></td>
        </tr>
    </tbody>
</table>
<p style="font-size: 10px">ANALISA : </p>
<table class="table table-sm table-borderless" style="margin-left: 18px;font-size:11px;width:50%;margin-top:-10px; padding-right:18px">
    <thead>
        <tr>
            <td>Suhu alat dari penunjukan indikator</td>
            <td>:</td>
            <td>{{ round($suhu_alat_dari_penunjukan_indikator,2)  }} °C</td>
        </tr>
        <tr>
            <td>Suhu alat dari hasil pengukuran</td>
            <td>:</td>
            <td>{{ round($suhu_alat_dari_hasil_pengukuran,2)  }} °C</td>
        </tr>
        <tr>
            <td>Variasi suhu spasial</td>
            <td>:</td>
            <td>{{ round($variasi_suhu_spasial,2)  }} °C</td>
        </tr>
        <tr>
            <td>Variasi suhu temporal</td>
            <td>:</td>
            <td>{{ round($variasi_suhu_temporal,2)  }} °C</td>
        </tr>
        <tr>
            <td>Variasi suhu total</td>
            <td>:</td>
            <td>{{ round($variasi_suhu_total,2)  }} °C</td>
        </tr>
        <tr>
            <td>Suhu ruang</td>
            <td>:</td>
            <td>{{ $suhu_ruang }} °C Hasil kalibrasi : {{ $score_abs_suhu_ruangan}}</td>
        </tr>
        <tr>
            <td>Koreksi</td>
            <td>:</td>
            <td>{{ $koreksi }} °C Hasil kalibrasi : {{ $score_abs_koreksi}}</td>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>


<div class="page_break"></div>
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

<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
    <thead>
        <tr>
            <th style="width: 4%;text-align: center;">No</th>
            <th style="width: 24%;text-align: center;">Parameter</th>
            <th style="width: 24%;text-align: center;">Skor</th>
            <th style="width: 24%;text-align: center;">Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align: center;">1</td>
            <td style="text-align: center;">PEMERIKSAAAN KONDISI FISIK DAN FUNGSI</td>
            <td style="text-align: center;">{{ $score_fisik }}</td>
            <td style="text-align: center;vertical-align: middle;" rowspan="3">
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">2</td>
            <td style="text-align: center;">PENGUKURAN KESELAMATAN LISTRIK</td>
            <td style="text-align: center;">{{ $point }}</td>
        </tr>
        <tr>
            <td style="text-align: center;">3</td>
            <td style="text-align: center;">PENGUKURAN KINERJA</td>
            <td style="text-align: center;">{{ $score_kinerja }}</td>
        </tr>
    </tbody>
</table>

<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
    <tbody>
        <tr>
            <td style="height:60px"><b>Catatan :</b> {{ $laporan_kesimpulan_telaah_teknis->catatan }} </td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
    <tbody>
        <tr>
            <td style="width: 40%;text-align: center;vertical-align: middle;">Berdasarkan hasil pengujian dan/ atau
                hasil kalibrasi, alat ini dinyatakan </td>
            <td style="width: 20%;text-align: center;vertical-align: middle;">
                <div class="form-group" style="margin: 0px">
                    <input type="checkbox" {{ $totalAll >= 70 ? 'checked' : '' }}>
                    <label><b style="font-size: 12px">LAIK PAKAI</b></label>
                </div>
            </td>
            <td style="width: 20%;text-align: center;vertical-align: middle;">
                <div class="form-group" style="margin: 0px">
                    <input type="checkbox" {{ $totalAll < 70 ? 'checked' : '' }}>
                    <label><b style="font-size: 12px">TIDAK LAIK PAKAI</b></label>
                </div>
            </td>
            <td style="width: 20%;text-align: center;vertical-align: middle;"><b style="font-size: 12px">PENYELIA</b>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;height:75px;vertical-align: middle;">Pelaksana Pengujian dan Kalibrasi
            </td>
            <td colspan="2" style="text-align: center">
                <img style="width: 80px;margin-top:5px;margin-bottom:3px"
                    src="data:image/png;base64, {!! base64_encode(QrCode::generate($laporan->nama_teknisi)) !!} "> <br>
                <span>{{ $laporan->nama_teknisi }}</span>
            </td>
            <td style="text-align: center">
                @if (isset($laporan->name_user))
                    <img style="width: 80px;margin-top:5px;margin-bottom:3px"
                        src="data:image/png;base64, {!! base64_encode(QrCode::generate($laporan->name_user)) !!} "> <br>
                    <span>{{ $laporan->name_user }}</span>
                @endif
            </td>
        </tr>
    </tbody>
</table>

