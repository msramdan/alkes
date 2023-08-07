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
                    {{ $mean = round(($satu + $dua + $tiga + $empat + $lima + $enam) / 6, 2) }}</td>
                <td style="text-align: center;vertical-align: middle;"><img src="../public/asset/kurang.png"
                        style="width: 6px; margin-top:3px"> 1379 mbar (20 psi)</td>
                <td style="text-align: center;vertical-align: middle;">{{ $mean < 20 ? 'Lulus' : 'Tidak Lulus' }}</td>
                <td style="text-align: center;vertical-align: middle;">{{ $mean < 20 ? 100 : 0 }}</td>
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
                $koreksi = $meanTerkoreksi1 - 10;
                $u95 = 100;
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
                $koreksi2 = $meanTerkoreksi2 - 50;
                $u952 = 100;
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
                $koreksi3 = $meanTerkoreksi3 - 100;
                $u953 = 100;
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
                $koreksi4 = $meanTerkoreksi4 - 500;
                $u954 = 100;
                $absU954 = abs($koreksi4) + $u954;
                $score4 = $absU95 < 50 ? 'Lulus' : 'Tidak';

                // Hitung score
                $initScore = 0;
                if($score=='Lulus'){
                    $initScore =  $initScore + 25;
                }
                if($score2=='Lulus'){
                    $initScore =  $initScore + 25;
                }
                if($score3=='Lulus'){
                    $initScore =  $initScore + 25;
                }
                if($score4=='Lulus'){
                    $initScore =  $initScore + 25;
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
                    {{ round(standard_deviation($arr), 2) }}
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
                    {{$final}}
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
                    {{ round(standard_deviation($arr2), 2) }}
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
                    {{ round(standard_deviation($arr3), 2) }}
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
                    {{ round(standard_deviation($arr4), 2) }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $koreksi4 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $u954}}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $absU954}}
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
