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

<?php
$resolusi = DB::table('laporan_pendataan_administrasi')
    ->where('no_laporan', $laporan->no_laporan)
    ->where('slug', 'resolusi')
    ->first();
$intensitas_cahaya = DB::table('laporan_kinerja')
    ->where('type_laporan_kinerja', 'intensitas_cahaya')
    ->where('no_laporan', $laporan->no_laporan)
    ->first();
$data_sertifikat = json_decode($intensitas_cahaya->data_sertifikat);
$data_laporan = json_decode($intensitas_cahaya->data_laporan);

$arrString = ['cahaya'];
$myArrayString = [];
$initScoreString = 0;

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
    $$mean_terkoreksi = $data_sertifikat->intercept + $data_sertifikat->slope * $$mean;

    // stdev
    $arrData = [];
    array_push($arrData, $$a, $$b, $$c, $$d, $$e, $$f);
    $stdev = standard_deviation($arrData);
    $var_stdev = 'stdev' . $value;
    $$var_stdev = $stdev;

    // U95
    $u95 = 'u95' . $value . '_naik';
    // U95
    $$u95 = hitung_uncertainty($resolusi->value, $$var_stdev, 2.6, 0.01, 6);
    // cu95
    $cu95 = 'abs95' . $value;
    $$cu95 = $$mean + $$u95;

    // toleransi
    $toleransi = 'toleransi' . $value;
    $$toleransi = 40;

    // hasil
    $hasil = 'hasil' . $value;
    $$hasil = $$cu95 >= $$toleransi ? 'Lulus' : 'Tidak';
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
        'cu95' => $$cu95,
        'tol' => $$toleransi,
        'hasil' => $$hasil,
    ];
    $myArrayString[$value] = $data;
    $arrData = [];
}
$scoreString = (($initScoreString / 1) * 100) / 2;
$persyaratanString = $scoreString >= 50 ? 'Lulus' : 'Tidak';
?>


{{-- akurasi tekanan --}}
<?php
$akurasi_pressure = DB::table('laporan_kinerja')
    ->where('type_laporan_kinerja', 'akurasi_pressure')
    ->where('no_laporan', $laporan->no_laporan)
    ->first();
$data_sertifikat_akurasi_pressure = json_decode($akurasi_pressure->data_sertifikat);
$data_laporan_akurasi_pressure = json_decode($akurasi_pressure->data_laporan);

$array = ['pressure'];
$arrayPressure = [];
$initScoreStringPressure = 0;

foreach ($array as $value) {
    $a = $value . '_1';
    $$a = $data_laporan_akurasi_pressure->$a;

    $b = $value . '_2';
    $$b = $data_laporan_akurasi_pressure->$b;

    $c = $value . '_3';
    $$c = $data_laporan_akurasi_pressure->$c;

    $d = $value . '_4';
    $$d = $data_laporan_akurasi_pressure->$d;

    $e = $value . '_5';
    $$e = $data_laporan_akurasi_pressure->$e;

    $f = $value . '_6';
    $$f = $data_laporan_akurasi_pressure->$f;

    // mean
    $mean = 'mean_' . $value;
    $$mean = ($$a + $$b + $$c + $$d + $$e + $$f) / 6;

    // mean terkoreksi
    $mean_terkoreksi = 'mean_terkoreksi_' . $value;
    $$mean_terkoreksi = $data_sertifikat_akurasi_pressure->intercept_naik + $data_sertifikat_akurasi_pressure->x_variable_naik * $$mean;

    // stdev
    $arrDataPressure = [];
    array_push($arrDataPressure, $$a, $$b, $$c, $$d, $$e, $$f);
    $stdev = standard_deviation($arrDataPressure);
    $var_stdev = 'stdev' . $value;
    $$var_stdev = $stdev;

    // U95
    $u95 = 'u95' . $value . '_naik';
    // U95
    $$u95 = hitung_uncertainty($resolusi->value, $$var_stdev, $data_sertifikat_akurasi_pressure->uc,  $data_sertifikat_akurasi_pressure->drift50_naik, 6);
    // cu95
    $cu95 = 'abs95' . $value;
    $$cu95 = $$mean + $$u95;

    // toleransi
    $toleransi = 'toleransi' . $value;
    $$toleransi = 40;

    // hasil
    $hasil = 'hasil' . $value;
    $$hasil = $$cu95 >= $$toleransi ? 'Lulus' : 'Tidak';
    if ($$hasil == 'Lulus') {
        $initScoreStringPressure = $initScoreStringPressure + 1;
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
        'cu95' => $$cu95,
        'tol' => $$toleransi,
        'hasil' => $$hasil,
    ];
    $arrayPressure[$value] = $data;
    $arrDataPressure = [];
}
$scoreStringPressure = (($initScoreStringPressure / 1) * 100) / 2;
$persyaratanStringPressure = $scoreStringPressure >= 50 ? 'Lulus' : 'Tidak';
$scoreKinerja = ($scoreStringPressure + $scoreString) / 2;
$totalAll = $score_fisik + $point + $scoreKinerja;
?>





<p style="font-size: 11px;margin-left:18px"><b>{{ $count_laporan_pengukuran_keselamatan_listrik > 0 ? 'F' : 'E' }}.
        PENGUKURAN KINERJA</b></p>
<p style="font-size: 11px;margin-left:18px"><b> Intensitas Cahaya</b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:9px;width:100%;margin-top:-10px; padding-right:18px">
    <tr>
        <th rowspan="2"style="text-align: center;vertical-align: middle;">Setting Alat</th>
        <th colspan="6" style="text-align: center;vertical-align: middle;">Penunjukan Standar (KLux)</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Mean</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Mean Terkoreksi</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Stdv</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">U95</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">C + U95</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Toleransi</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Hasil</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Score</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Persyaratan</th>
    </tr>
    <tr>
        <th style="text-align: center;vertical-align: middle;">1</th>
        <th style="text-align: center;vertical-align: middle;">2</th>
        <th style="text-align: center;vertical-align: middle;">3</th>
        <th style="text-align: center;vertical-align: middle;">4</th>
        <th style="text-align: center;vertical-align: middle;">5</th>
        <th style="text-align: center;vertical-align: middle;">6</th>
    </tr>
    @foreach ($myArrayString as $key => $value)
        <tr>
            <td style="text-align: center;vertical-align: middle;">MAX</td>
            <td style="text-align: center;vertical-align: middle;">{{ $value['percobaan_1'] }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $value['percobaan_2'] }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $value['percobaan_3'] }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $value['percobaan_4'] }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $value['percobaan_5'] }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $value['percobaan_6'] }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($value['mean'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($value['mean_terkoreksi'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($value['stdev'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($value['u95'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($value['cu95'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($value['tol'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $value['hasil'] }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $scoreString }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $persyaratanString }}</td>
        </tr>
    @endforeach
</table>


<p style="font-size: 11px;margin-left:18px"><b> Akurasi Pressure</b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:9px;width:100%;margin-top:-10px; padding-right:18px">
    <tr>
        <th rowspan="2"style="text-align: center;vertical-align: middle;">Setting Alat</th>
        <th colspan="6" style="text-align: center;vertical-align: middle;">Penunjukan Standar (KLux)</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Mean</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Mean Terkoreksi</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Stdv</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">U95</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">C + U95</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Toleransi</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Hasil</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Score</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Persyaratan</th>
    </tr>
    <tr>
        <th style="text-align: center;vertical-align: middle;">1</th>
        <th style="text-align: center;vertical-align: middle;">2</th>
        <th style="text-align: center;vertical-align: middle;">3</th>
        <th style="text-align: center;vertical-align: middle;">4</th>
        <th style="text-align: center;vertical-align: middle;">5</th>
        <th style="text-align: center;vertical-align: middle;">6</th>
    </tr>
    @foreach ($arrayPressure as $key => $value)
        <tr>
            <td style="text-align: center;vertical-align: middle;">MAX</td>
            <td style="text-align: center;vertical-align: middle;">{{ $value['percobaan_1'] }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $value['percobaan_2'] }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $value['percobaan_3'] }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $value['percobaan_4'] }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $value['percobaan_5'] }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $value['percobaan_6'] }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($value['mean'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($value['mean_terkoreksi'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($value['stdev'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($value['u95'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($value['cu95'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($value['tol'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $value['hasil'] }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $scoreString }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $persyaratanString }}</td>
        </tr>
    @endforeach
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
            {{ $totalAll }}
        </td>
    </tr>
    <tr>
        <td style="text-align: center;">2</td>
        <td style="text-align: center;">Pengukuran Keselamatan Listrik
        </td>
        <td style="text-align: center;">
            {{ $point }}
        </td>
    </tr>
    <tr>
        <td style="text-align: center;">3</td>
        <td style="text-align: center;">Hasil Pengukuran Kinerja</td>
        <td style="text-align: center;">
            {{ $scoreKinerja}}
        </td>
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

