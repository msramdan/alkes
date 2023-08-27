
<style>
    .page_break { page-break-before: always; }

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
@if ($nomenklaturs->id == 10 || $nomenklaturs->id == 11)
    <?php
    $laporan_occlusion = DB::table('laporan_occlusion')
        ->where('no_laporan', $laporan->no_laporan)
        ->first();
    $flow_rate = DB::table('laporan_flow_rate')
        ->where('no_laporan', $laporan->no_laporan)
        ->first();

    // get chanel IDA
    $ida = DB::table('laporan_pendataan_administrasi')
        ->where('no_laporan', $laporan->no_laporan)
        ->where('slug', 'channel-ida')
        ->first();
    $resolusi = DB::table('laporan_pendataan_administrasi')
        ->where('no_laporan', $laporan->no_laporan)
        ->where('slug', 'resolusi')
        ->first();
    // get sertifikat ida
    $sertifikat_ida = DB::table('sertifikat_ida')
        ->where('inventaris_id', $laporan->no_laporan)
        ->first();

    if ($ida->value == 1) {
        $slope = $flow_rate->slope_1;
        $intercept = $flow_rate->intercept_1;
    } else {
        $slope = $flow_rate->slope_2;
        $intercept = $flow_rate->intercept_2;
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
                <th rowspan="2" style="text-align: center;vertical-align: middle;">Hasil</th>
                <th rowspan="2" style="text-align: center;vertical-align: middle;">Skorsing</th>
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
                <td style="text-align: center;vertical-align: middle;">{{ $mean_occlusion < 20 ? 'Lulus' : 'Tidak Lulus' }}</td>
                <td style="text-align: center;vertical-align: middle;">{{ $mean_occlusion < 20 ? 100 : 0 }}</td>
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
                <th rowspan="2" style="text-align: center;vertical-align: middle;">Penyimpangan yang diizinkan</th>
                <th rowspan="2" style="text-align: center;vertical-align: middle;">Toleransi</th>
                <th rowspan="2" style="text-align: center;vertical-align: middle;">Hasil</th>
                <th rowspan="2" style="text-align: center;vertical-align: middle;">Score</th>
                <th rowspan="2" style="text-align: center;vertical-align: middle;">Persyaratan</th>
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
                $mean1 = round(($satu1 + $dua1 + $tiga1 + $empat1 + $lima1 + $enam1) / 6, 2);


                $meanTerkoreksi1 = round($intercept + $slope * $mean1, 2);
                $arr = [];
                array_push($arr, $satu1, $dua1, $tiga1, $empat1, $lima1, $enam1);
                // stdev
                $stdev = round(standard_deviation($arr), 2);
                $koreksi = $meanTerkoreksi1 - 10;
                // hitung uncertainty
                $u95 = round(hitung_uncertainty($resolusi->value, $stdev), 3);
                $absU95 = abs($koreksi) + $u95;
                $score = $absU95 < 1 ? 'Lulus' : 'Tidak';
                // 2
                $satu2 = $flow_rate->percobaan2_1;
                $dua2 = $flow_rate->percobaan2_2;
                $tiga2 = $flow_rate->percobaan2_3;
                $empat2 = $flow_rate->percobaan2_4;
                $lima2 = $flow_rate->percobaan2_5;
                $enam2 = $flow_rate->percobaan2_6;
                $mean2 = round(($satu2 + $dua2 + $tiga2 + $empat2 + $lima2 + $enam2) / 6, 2);
                $meanTerkoreksi2 = round($intercept + $slope * $mean2, 2);
                $arr2 = [];
                array_push($arr2, $satu2, $dua2, $tiga2, $empat2, $lima2, $enam2);
                // stdev
                $stdev2 = round(standard_deviation($arr2), 2);
                $koreksi2 = $meanTerkoreksi2 - 50;
                $u952 = round(hitung_uncertainty($resolusi->value, $stdev2), 3);
                $absU952 = abs($koreksi2) + $u952;
                $score2 = $absU952 < 5 ? 'Lulus' : 'Tidak';
                // 3
                $satu3 = $flow_rate->percobaan3_1;
                $dua3 = $flow_rate->percobaan3_2;
                $tiga3 = $flow_rate->percobaan3_3;
                $empat3 = $flow_rate->percobaan3_4;
                $lima3 = $flow_rate->percobaan3_5;
                $enam3 = $flow_rate->percobaan3_6;
                $mean3 = round(($satu3 + $dua3 + $tiga3 + $empat3 + $lima3 + $enam3) / 6, 2);
                $meanTerkoreksi3 = round($intercept + $slope * $mean3, 2);
                $arr3 = [];
                array_push($arr3, $satu3, $dua3, $tiga3, $empat3, $lima3, $enam3);
                // stdev
                $stdev3 = round(standard_deviation($arr3), 2);
                $koreksi3 = $meanTerkoreksi3 - 100;
                $u953 = round(hitung_uncertainty($resolusi->value, $stdev3), 3);
                $absU953 = abs($koreksi3) + $u953;
                $score3 = $absU953 < 10 ? 'Lulus' : 'Tidak';
                // 4
                $satu4 = $flow_rate->percobaan4_1;
                $dua4 = $flow_rate->percobaan4_2;
                $tiga4 = $flow_rate->percobaan4_3;
                $empat4 = $flow_rate->percobaan4_4;
                $lima4 = $flow_rate->percobaan4_5;
                $enam4 = $flow_rate->percobaan4_6;
                $mean4 = round(($satu4 + $dua4 + $tiga4 + $empat4 + $lima4 + $enam4) / 6, 2);
                $meanTerkoreksi4 = round($intercept + $slope * $mean4, 2);
                $arr4 = [];
                array_push($arr4, $satu4, $dua4, $tiga4, $empat4, $lima4, $enam4);
                $stdev4 = round(standard_deviation($arr4), 2);
                $koreksi4 = $meanTerkoreksi4 - 500;
                $u954 = round(hitung_uncertainty($resolusi->value, $stdev4), 3);
                $absU954 = abs($koreksi4) + $u954;
                $score4 = $absU95 < 50 ? 'Lulus' : 'Tidak';

                // Hitung score
                $initScore = 0;
                if ($score == 'Lulus') {
                    $initScore = $initScore + 25;
                }
                if ($score2 == 'Lulus') {
                    $initScore = $initScore + 25;
                }
                if ($score3 == 'Lulus') {
                    $initScore = $initScore + 25;
                }
                if ($score4 == 'Lulus') {
                    $initScore = $initScore + 25;
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
                    {{ $mean1 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $meanTerkoreksi1 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $stdev }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $koreksi }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $u95 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $absU95 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    1
                </td>
                <td rowspan="4" style="text-align: center;vertical-align: middle;">
                    10 %
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $score }}
                </td>
                <td rowspan="4" style="text-align: center;vertical-align: middle;">
                    {{ $initScore }}
                </td>
                <td rowspan="4" style="text-align: center;vertical-align: middle;">
                    {{ $final }}
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
                    {{ $mean2 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $meanTerkoreksi2 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $stdev2 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $koreksi2 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $u952 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $absU952 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    5
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $score2 }}
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
                    {{ $mean3 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $meanTerkoreksi3 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $stdev3 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $koreksi3 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $u953 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $absU953 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    10
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $score3 }}
                </td>
            </tr>
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
                    {{ $mean4 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $meanTerkoreksi4 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $stdev4 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $koreksi4 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $u954 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $absU954 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    50
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $score4 }}
                </td>
            </tr>
        </tbody>
    </table>
@endif


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
            {{ $scoreOcc =  $mean_occlusion < 20 ? 100 : 0 }}
            <td style="text-align: center;vertical-align: middle;" rowspan="3">{{ $totalAll =  $score_fisik + $point + ((($kinerja = $scoreOcc + $initScore)/2)/2) }}</td>
        </tr>
        <tr>
            <td style="text-align: center;">2</td>
            <td style="text-align: center;">PENGUKURAN KESELAMATAN LISTRIK</td>
            <td style="text-align: center;">{{ $point }}</td>
        </tr>
        <tr>
            <td style="text-align: center;">3</td>
            <td style="text-align: center;">PENGUKURAN KINERJA</td>
            <td style="text-align: center;">{{ (($scoreOcc + $initScore)/2)/2 }}</td>
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
<div class="page_break"></div>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
    <tbody>
        <tr>
            <td style="width: 40%;text-align: center;vertical-align: middle;">Berdasarkan hasil pengujian dan/ atau
                hasil kalibrasi, alat ini dinyatakan </td>
            <td style="width: 20%;text-align: center;vertical-align: middle;">
                <div class="form-group" style="margin: 0px">
                    <input type="checkbox"  {{ $totalAll >= 70 ? 'checked' : '' }}>
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
