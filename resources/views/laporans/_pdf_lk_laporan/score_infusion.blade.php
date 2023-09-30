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

<p style="font-size: 14px"><b>{{ $count_laporan_pengukuran_keselamatan_listrik > 0 ? 'F' : 'E' }}. PENGUKURAN
        KINERJA</b></p>
@if ($nomenklaturs->id == 10 || $nomenklaturs->id == 11)
    <?php
    $laporan_occlusion = DB::table('laporan_kinerja')
        ->where('type_laporan_kinerja', 'laporan_occlusion')
        ->where('no_laporan', $laporan->no_laporan)
        ->first();
    $flow_rate = DB::table('laporan_kinerja')
        ->where('type_laporan_kinerja', 'laporan_flow_rate')
        ->where('no_laporan', $laporan->no_laporan)
        ->first();

    $dataFlowRate = json_decode($flow_rate->data_sertifikat);
    $flow_rate = json_decode($flow_rate->data_laporan);
    $laporan_occlusion = json_decode($laporan_occlusion->data_laporan);

    // get chanel IDA
    $ida = DB::table('laporan_pendataan_administrasi')
        ->where('no_laporan', $laporan->no_laporan)
        ->where('slug', 'channel-ida')
        ->first();
    $resolusi = DB::table('laporan_pendataan_administrasi')
        ->where('no_laporan', $laporan->no_laporan)
        ->where('slug', 'resolusi')
        ->first();

    if ($ida->value == 1) {
        $slope = $dataFlowRate->slope_1;
        $intercept = $dataFlowRate->intercept_1;
        $uncert = $dataFlowRate->uc_1;
        $drift10 = $dataFlowRate->drift10_1;
        $drift50 = $dataFlowRate->drift50_1;
        $drift100 = $dataFlowRate->drift100_1;
        $drift500 = $dataFlowRate->drift500_1;
    } else {
        $slope = $dataFlowRate->slope_2;
        $intercept = $dataFlowRate->intercept_2;
        $uncert = $dataFlowRate->uc_2;
        $drift10 = $dataFlowRate->drift10_2;
        $drift50 = $dataFlowRate->drift50_2;
        $drift100 = $dataFlowRate->drift100_2;
        $drift500 = $dataFlowRate->drift500_2;
    }
    ?>
    <p style="font-size: 11px;margin-left:18px"><b>OCCLUSION</b></p>
    <table class="table table-bordered table-sm"
        style="margin-left: 18px;font-size:9px;width:100%;margin-top:-10px; padding-right:18px">
        <thead>
            <tr>
                <th style="text-align: center;vertical-align: middle;">Setting Alat</th>
                <th colspan="6" style="text-align: center;vertical-align: middle;">Penunjukan Standar (mbar)
                </th>
                <th rowspan="2" style="text-align: center;vertical-align: middle;">Mean</th>
                <th rowspan="2" style="text-align: center;vertical-align: middle;">Toleransi</th>
            </tr>
            <tr>
                <th style="text-align: center;vertical-align: middle;">(mL/h)</th>
                <th style="text-align: center;vertical-align: middle;">1</th>
                <th style="text-align: center;vertical-align: middle;">2</th>
                <th style="text-align: center;vertical-align: middle;">3</th>
                <th style="text-align: center;vertical-align: middle;">4</th>
                <th style="text-align: center;vertical-align: middle;">5</th>
                <th style="text-align: center;vertical-align: middle;">6</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center;vertical-align: middle;">100</td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $satu = $laporan_occlusion->percobaan_1 * 0.0145 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $dua = $laporan_occlusion->percobaan_2 * 0.0145 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $tiga = $laporan_occlusion->percobaan_3 * 0.0145 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $empat = $laporan_occlusion->percobaan_4 * 0.0145 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $lima = $laporan_occlusion->percobaan_5 * 0.0145 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $enam = $laporan_occlusion->percobaan_6 * 0.0145 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $mean_occlusion = round(($satu + $dua + $tiga + $empat + $lima + $enam) / 6, 2) }}</td>
                <td style="text-align: center;vertical-align: middle;"><img src="../public/asset/kurang.png"
                        style="width: 6px; margin-top:3px"> 1379 mbar (20 psi)</td>
            </tr>
        </tbody>
    </table>

    <p style="font-size: 11px;margin-left:18px"><b>FLOW RATE</b></p>
    <table class="table table-bordered table-sm"
        style="margin-left: 18px;font-size:9px;width:100%;margin-top:-10px; padding-right:18px">
        <thead>
            <tr>
                <th style="text-align: center;vertical-align: middle;">Setting Alat</th>
                <th colspan="6" style="text-align: center;vertical-align: middle;">Penunjukan Standar (mL/hr)
                </th>
                <th rowspan="2" style="text-align: center;vertical-align: middle;">Mean</th>
                <th rowspan="2" style="text-align: center;vertical-align: middle;">Mean Toleransi</th>
                <th rowspan="2" style="text-align: center;vertical-align: middle;">Stdv</th>
                <th rowspan="2" style="text-align: center;vertical-align: middle;">Koreksi</th>
                <th rowspan="2" style="text-align: center;vertical-align: middle;">U95</th>
                <th rowspan="2" style="text-align: center;vertical-align: middle;">C + U95</th>
                <th rowspan="2" style="text-align: center;vertical-align: middle;">Penyimpangan yang diizinkan
                </th>
                <th rowspan="2" style="text-align: center;vertical-align: middle;">Toleransi</th>
            </tr>
            <tr>
                <th style="text-align: center;vertical-align: middle;">(mL/hr)</th>
                <th style="text-align: center;vertical-align: middle;">1</th>
                <th style="text-align: center;vertical-align: middle;">2</th>
                <th style="text-align: center;vertical-align: middle;">3</th>
                <th style="text-align: center;vertical-align: middle;">4</th>
                <th style="text-align: center;vertical-align: middle;">5</th>
                <th style="text-align: center;vertical-align: middle;">6</th>
            </tr>
        </thead>
        <tbody>
            @php
                // 1
                $satu1 = $flow_rate->percobaan1_1;
                $dua1 = $flow_rate->percobaan1_2;
                $tiga1 = $flow_rate->percobaan1_3;
                $empat1 = $flow_rate->percobaan1_4;
                $lima1 = $flow_rate->percobaan1_5;
                $enam1 = $flow_rate->percobaan1_6;
                $mean1 = ($satu1 + $dua1 + $tiga1 + $empat1 + $lima1 + $enam1) / 6;

                $meanTerkoreksi1 = $intercept + $slope * $mean1;
                $arr = [];
                array_push($arr, $satu1, $dua1, $tiga1, $empat1, $lima1, $enam1);
                // stdev
                $stdev = standard_deviation($arr);
                $koreksi = $meanTerkoreksi1 - 10;
                // hitung uncertainty
                $u95 = hitung_uncertainty($resolusi->value, $stdev, $uncert, $drift10);
                $absU95 = abs($koreksi) + $u95;
                $score = $absU95 < 1 ? 'Lulus' : 'Tidak';
                // 2
                $satu2 = $flow_rate->percobaan2_1;
                $dua2 = $flow_rate->percobaan2_2;
                $tiga2 = $flow_rate->percobaan2_3;
                $empat2 = $flow_rate->percobaan2_4;
                $lima2 = $flow_rate->percobaan2_5;
                $enam2 = $flow_rate->percobaan2_6;
                $mean2 = ($satu2 + $dua2 + $tiga2 + $empat2 + $lima2 + $enam2) / 6;
                $meanTerkoreksi2 = $intercept + $slope * $mean2;
                $arr2 = [];
                array_push($arr2, $satu2, $dua2, $tiga2, $empat2, $lima2, $enam2);
                // stdev
                $stdev2 = standard_deviation($arr2);
                $koreksi2 = $meanTerkoreksi2 - 50;
                $u952 = hitung_uncertainty($resolusi->value, $stdev2, $uncert, $drift50);
                $absU952 = abs($koreksi2) + $u952;
                $score2 = $absU952 < 5 ? 'Lulus' : 'Tidak';
                // 3
                $satu3 = $flow_rate->percobaan3_1;
                $dua3 = $flow_rate->percobaan3_2;
                $tiga3 = $flow_rate->percobaan3_3;
                $empat3 = $flow_rate->percobaan3_4;
                $lima3 = $flow_rate->percobaan3_5;
                $enam3 = $flow_rate->percobaan3_6;
                $mean3 = ($satu3 + $dua3 + $tiga3 + $empat3 + $lima3 + $enam3) / 6;
                $meanTerkoreksi3 = $intercept + $slope * $mean3;
                $arr3 = [];
                array_push($arr3, $satu3, $dua3, $tiga3, $empat3, $lima3, $enam3);
                // stdev
                $stdev3 = standard_deviation($arr3);
                $koreksi3 = $meanTerkoreksi3 - 100;
                $u953 = hitung_uncertainty($resolusi->value, $stdev3, $uncert, $drift100);
                $absU953 = abs($koreksi3) + $u953;
                $score3 = $absU953 < 10 ? 'Lulus' : 'Tidak';
                // 4 sini

                if ($nomenklaturs->id == 10) {
                    $satu4 = $flow_rate->percobaan4_1;
                    $dua4 = $flow_rate->percobaan4_2;
                    $tiga4 = $flow_rate->percobaan4_3;
                    $empat4 = $flow_rate->percobaan4_4;
                    $lima4 = $flow_rate->percobaan4_5;
                    $enam4 = $flow_rate->percobaan4_6;
                    $mean4 = ($satu4 + $dua4 + $tiga4 + $empat4 + $lima4 + $enam4) / 6;
                    $meanTerkoreksi4 = $intercept + $slope * $mean4;
                    $arr4 = [];
                    array_push($arr4, $satu4, $dua4, $tiga4, $empat4, $lima4, $enam4);
                    $stdev4 = standard_deviation($arr4);
                    $koreksi4 = $meanTerkoreksi4 - 500;
                    $u954 = hitung_uncertainty($resolusi->value, $stdev4, $uncert, $drift500);
                    $absU954 = abs($koreksi4) + $u954;
                    $score4 = $absU95 < 50 ? 'Lulus' : 'Tidak';
                }

                if ($nomenklaturs->id == 10) {
                    $pembagi = 4;
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
                    $initScore = ($initScore / $pembagi) * 100;
                } elseif ($nomenklaturs->id == 11) {
                    $pembagi = 3;
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
                    $initScore = ($initScore / $pembagi) * 100;
                }

                $final = $initScore >= 70 ? 'Lulus' : 'Tidak';
            @endphp

            <tr>
                <td style="text-align: center;vertical-align: middle;">10</td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $satu1 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $dua1 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $tiga1 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $empat1 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $lima1 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $enam1 }}
                </td>

                <td style="text-align: center;vertical-align: middle;">
                    {{ round($mean1, 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round($meanTerkoreksi1, 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round($stdev, 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round($koreksi, 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round($u95, 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round($absU95, 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    1
                </td>
                <td rowspan="4" style="text-align: center;vertical-align: middle;">
                    10 %
                </td>
            </tr>
            <tr>
                <td style="text-align: center;vertical-align: middle;">50</td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $satu2 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $dua2 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $tiga2 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $empat2 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $lima2 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $enam2 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round($mean2, 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round($meanTerkoreksi2, 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round($stdev2, 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round($koreksi2, 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round($u952, 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round($absU952, 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    5
                </td>
            </tr>
            <tr>
                <td style="text-align: center;vertical-align: middle;">100</td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $satu3 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $dua3 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $tiga3 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $empat3 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $lima3 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $enam3 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round($mean3, 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round($meanTerkoreksi3, 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{  round($stdev3, 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round($koreksi3, 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round($u953, 2) }}
                </td>

                <td style="text-align: center;vertical-align: middle;">
                    {{ round($absU953, 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    10
                </td>
            </tr>

            @if ($nomenklaturs->id == 10)
                <tr>
                    <td style="text-align: center;vertical-align: middle;">500</td>
                    <td style="text-align: center;vertical-align: middle;">
                        {{ $satu4 }}
                    </td>
                    <td style="text-align: center;vertical-align: middle;">
                        {{ $dua4 }}
                    </td>
                    <td style="text-align: center;vertical-align: middle;">
                        {{ $tiga4 }}
                    </td>
                    <td style="text-align: center;vertical-align: middle;">
                        {{ $empat4 }}
                    </td>
                    <td style="text-align: center;vertical-align: middle;">
                        {{ $lima4 }}
                    </td>
                    <td style="text-align: center;vertical-align: middle;">
                        {{ $enam4 }}
                    </td>
                    <td style="text-align: center;vertical-align: middle;">
                        {{ round($mean4, 2)  }}
                    </td>
                    <td style="text-align: center;vertical-align: middle;">
                        {{ round($meanTerkoreksi4, 2) }}
                    </td>
                    <td style="text-align: center;vertical-align: middle;">
                        {{ round($stdev4, 2)  }}
                    </td>
                    <td style="text-align: center;vertical-align: middle;">
                        {{ round($koreksi4, 2) }}
                    </td>
                    <td style="text-align: center;vertical-align: middle;">
                        {{ round($u954, 2) }}
                    </td>
                    <td style="text-align: center;vertical-align: middle;">
                        {{  round($absU954, 2) }}
                    </td>
                    <td style="text-align: center;vertical-align: middle;">
                        50
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
@endif
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
                $scoreOcc = $mean_occlusion < 20 ? 100 : 0;
                $totalAll = $score_fisik + $point + ($kinerja = $scoreOcc + $initScore) / 2 / 2;
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
