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
            <th style="width: 52%;text-align: center;">Hasil Pemeriksaan</th>
            <th style="width: 20%;text-align: center;">Hasil Pengamatan</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($kondisi_fisik_fungsi as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="text-align: justify">{{ $row->field_parameter_fisik_fungsi }}</td>
                <td style="text-align: justify">{{ $row->field_batas_pemeriksaan }}</td>
                <td style="text-align: justify"> <b>{{ $row->value == 'baik' ? 'Baik' : 'Tidak Baik' }}</b> </td>
            </tr>
        @empty
            <tr>
                <td style="text-align: center;">-</td>
                <td style="text-align: center;">-</td>
                <td style="text-align: center;">-</td>
                <td style="text-align: center;">-</td>
            </tr>
        @endforelse
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

    <p style="font-size: 14px"><b>E. PENGUKURAN KESELAMATAN LISTRIK</b></p>
    <table class="table table-bordered table-sm"
        style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
        <thead>
            <tr>
                <th style="width: 4%;text-align: center;">No</th>
                <th colspan="2" style="width: 24%;text-align: center;">Parameter</th>
                <th style="width: 20%;text-align: center;">Terukur</th>
                <th style="width: 20%;text-align: center;">Ambang Batas</th>
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
            </tr>
            <tr>
                <td style="text-align: justify">Phase - Ground</td>
                <td style="text-align: justify">
                    {{ get_data_litsrik($laporan->no_laporan, 'slug', 'phase-ground')->value }}
                    Vac</td>
                <td style="text-align: justify">220 ± 10% Vac
                </td>
            </tr>
            <tr>
                <td style="text-align: justify">Ground - Netral</td>
                <td style="text-align: justify">
                    {{ get_data_litsrik($laporan->no_laporan, 'slug', 'ground-netral')->value }}
                    Vac</td>
                <td style="text-align: justify"><img src="../public/asset/kurang.png"
                        style="width: 6px; margin-top:3px"> 5 Vac
                </td>
            </tr>
            <tr>
                <td rowspan="3">2</td>
                <td colspan="2" style="text-align: justify">Resistansi pembumian protektif</td>
                <td colspan="2" style="text-align: justify;background-color: gray"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: justify">Kabel dapat dilepas (DPS)</td>
                <td style="text-align: justify;">
                    {{ get_data_litsrik($laporan->no_laporan, 'slug', 'kabel-dapat-dilepas-dps')->value }} <img
                        src="../public/asset/ohm.png" style="width: 10px; margin-top:3px">
                </td>
                <td style="text-align: justify;"><img src="../public/asset/kurang.png"
                        style="width: 6px; margin-top:3px"> 200 m<img src="../public/asset/ohm.png"
                        style="width: 10px; margin-top:3px">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: justify">Kabel tidak dapat dilepas (NPS)</td>
                <td style="text-align: justify;">
                    {{ get_data_litsrik($laporan->no_laporan, 'slug', 'kabel-tidak-dapat-dilepas-nps')->value }}
                    <img src="../public/asset/ohm.png" style="width: 10px; margin-top:3px">
                </td>
                <td style="text-align: justify;"><img src="../public/asset/kurang.png"
                        style="width: 6px; margin-top:3px"> 300 m<img src="../public/asset/ohm.png"
                        style="width: 10px; margin-top:4px">
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td colspan="2" style="text-align: justify">Resistansi isolasi</td>
                <td style="text-align: justify">
                    {{ get_data_litsrik($laporan->no_laporan, 'slug', 'resistansi-isolasi')->value }} M<img
                        src="../public/asset/ohm.png" style="width: 10px; margin-top:3px"></td>
                <td style="text-align: justify">> 2<img src="../public/asset/ohm.png"
                        style="width: 10px; margin-top:3px">

                </td>
            </tr>
            <tr>
                <td rowspan="2">4</td>
                <td colspan="2" style="text-align: justify">Arus bocor peralatan metode langsung/diferensial
                </td>
                <td colspan="2" style="text-align: justify;background-color: gray"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: justify">Kelas I tipe B/BF/CF</td>
                <td style="text-align: justify;">
                    {{ get_data_litsrik($laporan->no_laporan, 'slug', 'kelas-i-tipe-bbfcf')->value }} µA
                </td>
                <td style="text-align: justify;"><img src="../public/asset/kurang.png"
                        style="width: 6px; margin-top:3px"> 500 µA
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
$laporan_suction_pump = DB::table('laporan_kinerja')
    ->where('type_laporan_kinerja', 'suction_pump')
    ->where('no_laporan', $laporan->no_laporan)
    ->first();
$data_sertifikat = json_decode($laporan_suction_pump->data_sertifikat);
$data_laporan = json_decode($laporan_suction_pump->data_laporan);

$arr = [100, 200, 300, 400, 500, 600];
$myArrayNaik = [];

$initScoreNaik = 0;
$initScoreTurun = 0;
$pembagi = 6;
foreach ($arr as $value) {
    $naik_1 = 'percobaan' . $value . '_1_naik';
    $a = 'percobaan' . $value . '_1_naik';
    $$naik_1 = $data_laporan->$a;

    $naik_2 = 'percobaan' . $value . '_2_naik';
    $b = 'percobaan' . $value . '_2_naik';
    $$naik_2 = $data_laporan->$b;

    $naik_3 = 'percobaan' . $value . '_3_naik';
    $c = 'percobaan' . $value . '_3_naik';
    $$naik_3 = $data_laporan->$c;

    // mean
    $mean = 'mean_' . $value . '_naik';
    $$mean = ($$naik_1 + $$naik_2 + $$naik_3) / 3;

    // mean terkoreksi
    $mean_terkoreksi = 'mean_terkoreksi_' . $value . '_naik';
    $$mean_terkoreksi = $data_sertifikat->intercept_naik + $data_sertifikat->x_variable_naik * $$mean;

    // stdev
    $arrNaik = [];
    array_push($arrNaik, $$naik_1, $$naik_2, $$naik_3);
    $stdev = standard_deviation($arrNaik);
    $var_stdev = 'stdev' . $value . '_naik';
    $$var_stdev = $stdev;

    // koreksi
    $koreksi = 'koreksi_' . $value . '_naik';
    $$koreksi = $$mean_terkoreksi + $value;

    // U95
    $u95 = 'u95' . $value . '_naik';
    $$u95 = hitung_uncertainty($resolusi->value, $$var_stdev, $data_sertifikat->uc, $data_sertifikat->drift50_naik, 3);

    // cu95
    $cu95 = 'abs95' . $value . '_naik';
    $$cu95 = abs($$koreksi) + $$u95;

    // cu95
    $toleransi = 'toleransi' . $value . '_naik';
    $$toleransi = 0.1 * $value;

    // hasil
    $hasil = 'hasil' . $value . '_naik';
    $$hasil = $$cu95 <= $$toleransi ? 'Lulus' : 'Tidak';
    if ($$hasil == 'Lulus') {
        $initScoreNaik = $initScoreNaik + 1;
    }
    $data = [
        'percobaan_1' => $$naik_1,
        'percobaan_2' => $$naik_2,
        'percobaan_3' => $$naik_3,
        'mean' => $$mean,
        'mean_terkoreksi' => $$mean_terkoreksi,
        'stdev' => $$var_stdev,
        'koreksi' => $$koreksi,
        'u95' => $$u95,
        'cu95' => $$cu95,
        'toleransi' => $$toleransi,
        'hasil' => $$hasil,
    ];
    $myArrayNaik[$value] = $data;
    $arrNaik = [];
}

foreach ($arr as $value) {
    $turun_1 = 'percobaan' . $value . '_1_turun';
    $a = 'percobaan' . $value . '_1_turun';
    $$turun_1 = $data_laporan->$a;

    $turun_2 = 'percobaan' . $value . '_2_turun';
    $b = 'percobaan' . $value . '_2_turun';
    $$turun_2 = $data_laporan->$b;

    $turun_3 = 'percobaan' . $value . '_3_turun';
    $c = 'percobaan' . $value . '_3_turun';
    $$turun_3 = $data_laporan->$c;

    // mean
    $mean = 'mean_' . $value . '_turun';
    $$mean = ($$turun_1 + $$turun_2 + $$turun_3) / 3;

    // mean terkoreksi
    $mean_terkoreksi = 'mean_terkoreksi_' . $value . '_turun';
    $$mean_terkoreksi = $data_sertifikat->intercept_turun + $data_sertifikat->x_variable_turun * $$mean;

    // stdev
    $arrTurun = [];
    array_push($arrTurun, $$turun_1, $$turun_2, $$turun_3);
    $stdev = standard_deviation($arrTurun);
    $var_stdev = 'stdev' . $value . '_turun';
    $$var_stdev = $stdev;

    // koreksi
    $koreksi = 'koreksi_' . $value . '_turun';
    $$koreksi = $$mean_terkoreksi + $value;

    // U95
    $u95 = 'u95' . $value . '_turun';
    $$u95 = hitung_uncertainty($resolusi->value, $$var_stdev, $data_sertifikat->uc, $data_sertifikat->drift50_turun, 3);

    // cu95
    $cu95 = 'abs95' . $value . '_turun';
    $$cu95 = abs($$koreksi) + $$u95;

    // cu95
    $toleransi = 'toleransi' . $value . '_turun';
    $$toleransi = 0.1 * $value;

    // hasil
    $hasil = 'hasil' . $value . '_turun';
    $$hasil = $$cu95 <= $$toleransi ? 'Lulus' : 'Tidak';
    if ($$hasil == 'Lulus') {
        $initScoreTurun = $initScoreTurun + 1;
    }
    $data = [
        'percobaan_1' => $$turun_1,
        'percobaan_2' => $$turun_2,
        'percobaan_3' => $$turun_3,
        'mean' => $$mean,
        'mean_terkoreksi' => $$mean_terkoreksi,
        'stdev' => $$var_stdev,
        'koreksi' => $$koreksi,
        'u95' => $$u95,
        'cu95' => $$cu95,
        'toleransi' => $$toleransi,
        'hasil' => $$hasil,
    ];
    $myArrayTurun[$value] = $data;
    $arrTurun = [];
}

// MAX
$meanMax = ($data_laporan->max1 + $data_laporan->max2 + $data_laporan->max3) / 3;
$mean_terkoreksi_max = $data_sertifikat->intercept_naik + $data_sertifikat->x_variable_naik * $meanMax;
$arrMax = [];
array_push($arrMax, $data_laporan->max1, $data_laporan->max2, $data_laporan->max3);
$stdevMax = standard_deviation($arrMax);
$koreksi_max = $mean_terkoreksi_max - $data_laporan->nilai_max;
$u95_max = hitung_uncertainty($resolusi->value, $stdevMax, $data_sertifikat->uc, $data_sertifikat->drift350_naik, 3);
$cu95_max = abs($koreksi_max) + $u95_max;
$toleransi_max = 0.1 * $data_laporan->nilai_max;
$hasil_max = $cu95_max <= $toleransi ? 'Lulus' : 'Tidak';
$score_max = $hasil_max == 'Lulus' ? 100 : 0;
$scoreNaik = ($initScoreNaik / $pembagi) * 100;
$scoreTurun = ($initScoreTurun / $pembagi) * 100;
$persyaratan = ($scoreNaik + $scoreTurun) / 2 > 70 ? 'Lulus' : 'Tidak';
$scoreKinerja = ($scoreNaik + $scoreTurun + $score_max) / 6;
$totalAll = $score_fisik + $point + $scoreKinerja;

?>


<p style="font-size: 11px;margin-left:18px"><b>VACCUM</b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:9px;width:100%;margin-top:-10px; padding-right:18px">
    <thead>
        <tr>
            <th style="text-align: center;vertical-align: middle;">Skala Vaccum</th>
            <th colspan="3" style="text-align: center;vertical-align: middle;">Penunjukan Standar</th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">Mean</th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">Mean Terkoreksi</th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">Stdv</th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">Koreksi</th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">U95</th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">C + U95</th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">Toleransi</th>
        </tr>
        <tr>
            <th style="text-align: center;vertical-align: middle;">mmHg</th>
            <th style="text-align: center;vertical-align: middle;">1</th>
            <th style="text-align: center;vertical-align: middle;">2</th>
            <th style="text-align: center;vertical-align: middle;">3</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="11" style="text-align: center;vertical-align: middle;background-color:grey"><b>Naik</b>
            </td>
        </tr>
        @foreach ($myArrayNaik as $key => $value)
            <tr>
                <td>-{{ $key }}</td>
                <td>{{ $value['percobaan_1'] }}</td>
                <td>{{ $value['percobaan_2'] }}</td>
                <td>{{ $value['percobaan_3'] }}</td>
                <td>{{ round($value['mean'], 2) }}</td>
                <td>{{ round($value['mean_terkoreksi'], 2) }}</td>
                <td>{{ round($value['stdev'], 2) }}</td>
                <td>{{ round($value['koreksi'], 2) }}</td>
                <td>{{ round($value['u95'], 2) }}</td>
                <td>{{ round($value['cu95'], 2) }}</td>
                <td>- {{ $value['toleransi'] }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="11" style="text-align: center;vertical-align: middle;background-color:grey"><b>Turun</b>
            </td>
        </tr>
        @foreach ($myArrayTurun as $key => $value)
            <tr>
                <td>-{{ $key }}</td>
                <td>{{ $value['percobaan_1'] }}</td>
                <td>{{ $value['percobaan_2'] }}</td>
                <td>{{ $value['percobaan_3'] }}</td>
                <td>{{ round($value['mean'], 2) }}</td>
                <td>{{ round($value['mean_terkoreksi'], 2) }}</td>
                <td>{{ round($value['stdev'], 2) }}</td>
                <td>{{ round($value['koreksi'], 2) }}</td>
                <td>{{ round($value['u95'], 2) }}</td>
                <td>{{ round($value['cu95'], 2) }}</td>
                <td>- {{ $value['toleransi'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<p style="font-size: 11px;margin-left:18px"><b>Nilai Max : {{ $data_laporan->nilai_max }} mmHg </b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:9px;width:100%;margin-top:-10px; padding-right:18px">
    <thead>
        <tr>
            <th style="text-align: center;vertical-align: middle;">Skala Vaccum</th>
            <th colspan="3" style="text-align: center;vertical-align: middle;">Penunjukan Standar</th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">Mean</th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">Mean Terkoreksi</th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">Stdv</th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">Koreksi</th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">U95</th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">C + U95</th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">Toleransi</th>
        </tr>
        <tr>
            <th style="text-align: center;vertical-align: middle;">mmHg</th>
            <th style="text-align: center;vertical-align: middle;">1</th>
            <th style="text-align: center;vertical-align: middle;">2</th>
            <th style="text-align: center;vertical-align: middle;">3</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>MAX</td>
            <td>{{ $data_laporan->max1 }}</td>
            <td>{{ $data_laporan->max2 }}</td>
            <td>{{ $data_laporan->max3 }}</td>
            <td>{{ round($meanMax, 2) }}</td>
            <td>{{ round($mean_terkoreksi_max, 2) }}</td>
            <td>{{ round($stdevMax, 2) }}</td>
            <td>{{ round($koreksi_max, 2) }}</td>
            <td>{{ round($u95_max, 2) }}</td>
            <td>{{ round($cu95_max, 2) }}</td>
            <td>{{ round($toleransi_max, 2) }}</td>
        </tr>
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
