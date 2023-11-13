<p style="font-size: 14px"><b>D. PEMERIKSAAAN KONDISI FISIK DAN FUNGSI</b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
    <thead>
        <tr>
            <th style="width: 4%;text-align: center;">No32</th>
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
$contact_tachometer = DB::table('laporan_kinerja')
    ->where('type_laporan_kinerja', 'contact_tachometer')
    ->where('no_laporan', $laporan->no_laporan)
    ->first();
$data_sertifikat = json_decode($contact_tachometer->data_sertifikat);
$data_laporan = json_decode($contact_tachometer->data_laporan);
$arr = [1000, 2000, 3000, 4000];
$myArray = [];
$initScore = 0;

$arrString = ['min', 'medium', 'max'];
$myArrayString = [];
$initScoreString = 0;

foreach ($arr as $value) {
    // 1000
    $a = 'percobaan_' . $value . '_1';
    $$a = $data_laporan->$a;

    $b = 'percobaan_' . $value . '_2';
    $$b = $data_laporan->$b;

    $c = 'percobaan_' . $value . '_3';
    $$c = $data_laporan->$c;

    $d = 'percobaan_' . $value . '_4';
    $$d = $data_laporan->$d;

    $e = 'percobaan_' . $value . '_5';
    $$e = $data_laporan->$e;

    $f = 'percobaan_' . $value . '_6';
    $$f = $data_laporan->$f;

    // mean
    $mean = 'mean_' . $value;
    $$mean = ($$a + $$b + $$c + $$d + $$e + $$f) / 6;

    // mean terkoreksi
    $mean_terkoreksi = 'mean_terkoreksi_' . $value;
    $$mean_terkoreksi = $data_sertifikat->intercept + $data_sertifikat->x_variable * $$mean;

    // stdev
    $arrData = [];
    array_push($arrData, $$a, $$b, $$c, $$d, $$e, $$f);
    $stdev = standard_deviation($arrData);
    $var_stdev = 'stdev' . $value;
    $$var_stdev = $stdev;

    // koreksi
    $koreksi = 'koreksi_' . $value;
    $$koreksi = $$mean_terkoreksi - $value;

    // U95
    $u95 = 'u95' . $value . '_naik';
    $drift = 'drift_' . $value;
    if ($value == 1000) {
        $uc = $data_sertifikat->u1000;
    } elseif ($value == 2000 || $value == 3000 || $value == 4000) {
        $uc = $data_sertifikat->u5000;
    }
    // U95
    $$u95 = hitung_uncertainty($resolusi->value, $$var_stdev, $uc, $data_sertifikat->$drift, 6);

    // cu95
    $cu95 = 'abs95' . $value;
    $$cu95 = abs($$koreksi) + abs($$u95);

    // toleransi
    $toleransi = 'toleransi' . $value;
    $$toleransi = 0.1 * $value;

    // hasil
    $hasil = 'hasil' . $value;
    $$hasil = $$cu95 <= $$toleransi ? 'Lulus' : 'Tidak';
    if ($$hasil == 'Lulus') {
        $initScore = $initScore + 1;
    }

    $data = [
        'percobaan_1' => $$a,
        'percobaan_2' => $$b,
        'percobaan_3' => $$c,
        'percobaan_4' => $$d,
        'percobaan_5' => $$e,
        'percobaan_6' => $$f,
        'mean' => $$mean,
        'mean_terkoreksi' => $$mean_terkoreksi,
        'stdev' => $$var_stdev,
        'koreksi' => $$koreksi,
        'u95' => $$u95,
        'cu95' => $$cu95,
        'tol' => $$toleransi,
        'hasil' => $$hasil,
    ];
    $myArray[$value] = $data;
    $arrData = [];
}

foreach ($arrString as $value) {
    // 1000
    $a = $value . '_1';
    $$a = $data_laporan->$a;

    $b = $value . '_2';
    $$b = $data_laporan->$b;

    $c = $value . '_3';
    $$c = $data_laporan->$c;

    $d = $value . '_4';
    $$d = $data_laporan->$d;

    $e = $value . '_5';
    $$e = $data_laporan->$e;

    $f = $value . '_6';
    $$f = $data_laporan->$f;

    // mean
    $mean = 'mean_' . $value;
    $$mean = ($$a + $$b + $$c + $$d + $$e + $$f) / 6;

    // mean terkoreksi
    $mean_terkoreksi = 'mean_terkoreksi_' . $value;
    $$mean_terkoreksi = $data_sertifikat->intercept + $data_sertifikat->x_variable * $$mean;

    // stdev
    $arrData = [];
    array_push($arrData, $$a, $$b, $$c, $$d, $$e, $$f);
    $stdev = standard_deviation($arrData);
    $var_stdev = 'stdev' . $value;
    $$var_stdev = $stdev;

    // U95
    $u95 = 'u95' . $value . '_naik';
    $drift = 'drift_' . $value;

    if ($value == 'min') {
        $drift = 'drift_1000';
    } elseif ($value == 'medium') {
        $drift = 'drift_3000';
    } elseif ($value == 'max') {
        $drift = 'drift_4000';
    }
    if ($value == 'min') {
        $uc = $data_sertifikat->u1000;
    } elseif ($value == 'medium' || $value == 'max') {
        $uc = $data_sertifikat->u5000;
    }
    // U95
    $$u95 = hitung_uncertainty($resolusi->value, $$var_stdev, $uc, $data_sertifikat->$drift, 6);

    // toleransi
    $toleransi = 'toleransi' . $value;
    $$toleransi = 0.1 * $$mean;

    // hasil
    $hasil = 'hasil' . $value;
    $$hasil = $$cu95 <= $$toleransi ? 'Lulus' : 'Tidak';
    if ($$hasil == 'Lulus') {
        $initScoreString = $initScoreString + 1;
    }

    $data = [
        'percobaan_1' => $$a,
        'percobaan_2' => $$b,
        'percobaan_3' => $$c,
        'percobaan_4' => $$d,
        'percobaan_5' => $$e,
        'percobaan_6' => $$f,
        'mean' => $$mean,
        'mean_terkoreksi' => $$mean_terkoreksi,
        'stdev' => $$var_stdev,
        'koreksi' => '',
        'u95' => $$u95,
        'cu95' => '',
        'tol' => $$toleransi,
        'hasil' => $$hasil,
    ];
    $myArrayString[$value] = $data;
    $arrDataString = [];
}

// kinerja waktu
$kinerja_waktu = DB::table('laporan_kinerja')
    ->where('type_laporan_kinerja', 'kinerja_waktu')
    ->where('no_laporan', $laporan->no_laporan)
    ->first();
$data_sertifikat_digital = json_decode($kinerja_waktu->data_sertifikat);
$data_laporan = json_decode($kinerja_waktu->data_laporan);

$arr = [300];
$myArrayWaktu = [];
$initScoreWaktu = 0;

foreach ($arr as $value) {
    // 1000
    $a = 'second_1';
    $$a = $data_laporan->$a;

    $b = 'second_2';
    $$b = $data_laporan->$b;

    $c = 'second_3';
    $$c = $data_laporan->$c;

    // mean
    $mean = 'mean_' . $value;
    $$mean = ($$a + $$b + $$c) / 3;

    // mean terkoreksi
    $mean_terkoreksi = 'mean_terkoreksi_' . $value;
    $$mean_terkoreksi = $data_sertifikat_digital->intercept + $data_sertifikat_digital->x_variable * $$mean;

    // stdev
    $arrDataWaktu = [];
    array_push($arrDataWaktu, $$a, $$b, $$c);
    $stdev = standard_deviation($arrDataWaktu);
    $var_stdev = 'stdev' . $value;
    $$var_stdev = $stdev;

    // koreksi
    $koreksi = 'koreksi_' . $value;
    $$koreksi = $$mean_terkoreksi - $value;

    // U95
    $u95 = 'u95' . $value . '_naik';
    $drift = 'drift_' . $value;
    $uc = $data_sertifikat_digital->u;
    // U95
    $$u95 = hitung_uncertainty2(0.005, $$var_stdev, $uc, $data_sertifikat_digital->$drift, 3);

    // cu95
    $cu95 = 'abs95' . $value;
    $$cu95 = abs($$koreksi) + abs($$u95);

    // toleransi
    $toleransi = 'toleransi' . $value;
    $$toleransi = 0.1 * $value;

    // hasil
    $hasil = 'hasil' . $value;
    $$hasil = $$cu95 <= $$toleransi ? 'Lulus' : 'Tidak';
    if ($$hasil == 'Lulus') {
        $initScoreWaktu = $initScoreWaktu + 1;
    }

    $data = [
        'percobaan_1' => $$a,
        'percobaan_2' => $$b,
        'percobaan_3' => $$c,
        'mean' => $$mean,
        'mean_terkoreksi' => $$mean_terkoreksi,
        'stdev' => $$var_stdev,
        'koreksi' => $$koreksi,
        'u95' => $$u95,
        'cu95' => $$cu95,
        'tol' => $$toleransi,
        'hasil' => $$hasil,
    ];
    $myArrayWaktu[$value] = $data;
    $arrDataWaktu = [];
}

$score = (($initScore / 4) * 100) / 2;
$scoreString = (($initScoreString / 3) * 100) / 2;
$scoreKinerjaWaktu = (($initScoreWaktu / 1) * 100) / 2;

if ($scoreString == 0) {
    $xx = $score + $scoreKinerjaWaktu;
} else {
    $xx = $scoreString + $scoreKinerjaWaktu;
}

if ($xx >= 50) {
    $scoreKinerja = 50;
} else {
    $scoreKinerja = 0;
}

$persyaratan = $score >= 50 ? 'Lulus' : 'Tidak';
$persyaratanString = $scoreString >= 50 ? 'Lulus' : 'Tidak';

?>
<p style="font-size: 11px;margin-left:18px"><b>KINERJA PUTARAN</b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:9px;width:100%;margin-top:-10px; padding-right:18px">
    <thead>
        <tr>
            <th rowspan="2"style="text-align: center;vertical-align: middle;">Setting <br> (RPM)</th>
            <th colspan="6" style="text-align: center;vertical-align: middle;">Terukur Pada Standar (RPM)</th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">Mean</th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">Toleransi</th>
        </tr>
        <tr>
            <th style="text-align: center;vertical-align: middle;">1</th>
            <th style="text-align: center;vertical-align: middle;">2</th>
            <th style="text-align: center;vertical-align: middle;">3</th>
            <th style="text-align: center;vertical-align: middle;">4</th>
            <th style="text-align: center;vertical-align: middle;">5</th>
            <th style="text-align: center;vertical-align: middle;">6</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($myArray as $key => $value)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $value['percobaan_1'] }}</td>
                <td>{{ $value['percobaan_2'] }}</td>
                <td>{{ $value['percobaan_3'] }}</td>
                <td>{{ $value['percobaan_4'] }}</td>
                <td>{{ $value['percobaan_5'] }}</td>
                <td>{{ $value['percobaan_6'] }}</td>
                <td>{{ round($value['mean'], 2) }}</td>
                <td>{{ round($value['tol'], 2) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="9" style="text-align: center;vertical-align: middle;background-color: grey">Bila pada
                setting kecepatan tidak terdapat / tertera nilai angka kecepatan putaran</td>
        </tr>
        @foreach ($myArrayString as $key => $value)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $value['percobaan_1'] }}</td>
                <td>{{ $value['percobaan_2'] }}</td>
                <td>{{ $value['percobaan_3'] }}</td>
                <td>{{ $value['percobaan_4'] }}</td>
                <td>{{ $value['percobaan_5'] }}</td>
                <td>{{ $value['percobaan_6'] }}</td>
                <td>{{ round($value['mean'], 2) }}</td>
                <td>{{ round($value['tol'], 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<p style="font-size: 11px;margin-left:18px"><b>KINERJA WAKTU</b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:9px;width:100%;margin-top:-10px; padding-right:18px">
    <thead>
        <tr>
            <th rowspan="2"style="text-align: center;vertical-align: middle;">Setting <br> (Detik)</th>
            <th colspan="6" style="text-align: center;vertical-align: middle;">Terukur Pada Standar (Menit / Detik)
            </th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">Mean</th>
            <th rowspan="2" style="text-align: center;vertical-align: middle;">Toleransi</th>
        </tr>
        <tr>
            <th colspan="2" style="text-align: center;vertical-align: middle;">1</th>
            <th colspan="2" style="text-align: center;vertical-align: middle;">2</th>
            <th colspan="2" style="text-align: center;vertical-align: middle;">3</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($myArrayWaktu as $key => $value)
            <tr>
                <td>{{ $key }}</td>
                <td colspan="2">{{ $value['percobaan_1'] }}</td>
                <td colspan="2">{{ $value['percobaan_2'] }}</td>
                <td colspan="2">{{ $value['percobaan_3'] }}</td>
                <td>{{ round($value['mean'], 2) }}</td>
                <td>{{ round($value['tol'], 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

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
            <?php
            $totalAll = $score_fisik + $point + $scoreKinerja;
            ?>
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
