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
{{-- tekanan_traksi --}}
<?php
$resolusi = DB::table('laporan_pendataan_administrasi')->where('no_laporan', $laporan->no_laporan)->where('slug', 'resolusi')->first();
$tekanan_traksi = DB::table('laporan_kinerja')->where('type_laporan_kinerja', 'tekanan_traksi')->where('no_laporan', $laporan->no_laporan)->first();
$data_sertifikat = json_decode($tekanan_traksi->data_sertifikat);
$data_laporan = json_decode($tekanan_traksi->data_laporan);

$tekananTraksi = [1, 2, 3];
$tekananTraksiData = [];
$tekananTraksicore = 0;

foreach ($tekananTraksi as $tekanan) {
    $prefix = "traction_{$tekanan}";
    $measurements = [];

    // Collect all 6 measurements
    for ($i = 1; $i <= 6; $i++) {
        $field = "{$prefix}_{$i}";
        $measurements[$i] = $data_laporan->$field;
    }
    // Calculate statistics
    $mean = array_sum($measurements) / count($measurements);
    $mean_terkoreksi = $data_sertifikat->intercept + $data_sertifikat->x_variable * $mean;
    $stdev = standard_deviation($measurements);
    $tekanan_real = $data_laporan->$prefix;
    if ($tekanan == 1) {
        $drift = $data_sertifikat->drift_10;
    } elseif ($tekanan == 2) {
        $drift = $data_sertifikat->drift_50;
    } else {
        $drift = $data_sertifikat->drift_100;
    }

    $u95 = hitung_uncertainty($resolusi->value, $stdev, $data_sertifikat->u, $drift, 6);

    $correction = $mean_terkoreksi - $tekanan_real;
    $cu95 = $correction + $u95;
    $tolerance = 0.1 * $tekanan_real;
    $result = abs($correction) <= $tolerance ? 'Lulus' : 'Tidak';

    if ($result == 'Lulus') {
        $tekananTraksicore++;
    }

    $tekananTraksiData[] = [
        'tekanan' => $tekanan_real,
        'measurements' => $measurements,
        'mean' => $mean,
        'mean_terkoreksi' => $mean_terkoreksi,
        'stdev' => $stdev,
        'correction' => $correction,
        'u95' => $u95,
        'cu95' => $cu95,
        'tolerance' => $tolerance,
        'result' => $result,
    ];
}

$tekananTraksiFinalScore = ($tekananTraksicore / count($tekananTraksi)) * 100;
$tekananTraksiRequirement = $tekananTraksiFinalScore >= 50 ? 'Lulus' : 'Tidak';
?>
<p style="font-size: 14px;"><b>{{ $count_laporan_pengukuran_keselamatan_listrik > 0 ? 'F' : 'E' }}.
        PENGUKURAN KINERJA</b></p>

<!-- Heart Rate Table -->
<p style="font-size: 11px;margin-left:18px"><b>TEKANAN TRACTION CONTROL ACCURACY</b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:9px;width:100%;margin-top:-10px; padding-right:18px">
    <tr>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Setting Standar</th>
        <th colspan="6" style="text-align: center;vertical-align: middle;">Penunjukan Alat (BPM)</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Mean</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Mean Terkoreksi</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Stdev</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Koreksi</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">U95</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">C + U95</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Toleransi</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Hasil</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Score</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Persyaratan</th>
    </tr>
    <tr>
        @for ($i = 1; $i <= 6; $i++)
            <th style="text-align: center;vertical-align: middle;">{{ $i }}</th>
        @endfor
    </tr>
    @foreach ($tekananTraksiData as $data)
        <tr>
            <td style="text-align: center;vertical-align: middle;">{{ $data['tekanan'] }}</td>
            @for ($i = 1; $i <= 6; $i++)
                <td style="text-align: center;vertical-align: middle;">{{ round($data['measurements'][$i], 2) }}</td>
            @endfor
            <td style="text-align: center;vertical-align: middle;">{{ round($data['mean'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($data['mean_terkoreksi'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($data['stdev'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($data['correction'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($data['u95'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($data['cu95'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($data['tolerance'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $data['result'] }}</td>
            @if ($data['tekanan'] == 10)
                <td style="text-align: center;vertical-align: middle;" rowspan="3">{{ $tekananTraksiFinalScore }}
                </td>
                <td style="text-align: center;vertical-align: middle;" rowspan="3">{{ $tekananTraksiRequirement }}
                </td>
            @endif
        </tr>
    @endforeach
</table>
