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
            <tr>
                <td style="text-align: center;vertical-align: middle;">10</td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $satu1 = $flow_rate->percobaan1_1  }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $dua1 = $flow_rate->percobaan1_2  }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $tiga1 = $flow_rate->percobaan1_3  }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $empat1 = $flow_rate->percobaan1_4 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $lima1 = $flow_rate->percobaan1_5}}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $enam1 = $flow_rate->percobaan1_6 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round(( $satu1 + $dua1 + $tiga1 + $empat1 + $lima1 + $enam1) / 6,2)  }}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;vertical-align: middle;">50</td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $satu2 = $flow_rate->percobaan2_1  }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $dua2 = $flow_rate->percobaan2_2  }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $tiga2 = $flow_rate->percobaan2_3  }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $empat2 = $flow_rate->percobaan2_4 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $lima2 = $flow_rate->percobaan2_5}}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $enam2 = $flow_rate->percobaan2_6 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round(( $satu2 + $dua2 + $tiga2 + $empat2 + $lima2 + $enam2) / 6,2)  }}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;vertical-align: middle;">100</td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $satu3 = $flow_rate->percobaan3_1  }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $dua3 = $flow_rate->percobaan3_2  }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $tiga3 = $flow_rate->percobaan3_3  }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $empat3 = $flow_rate->percobaan3_4 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $lima3 = $flow_rate->percobaan3_5}}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $enam3 = $flow_rate->percobaan3_6 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round(( $satu3 + $dua3 + $tiga3 + $empat3 + $lima3 + $enam3) / 6,2)  }}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;vertical-align: middle;">500</td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $satu4 = $flow_rate->percobaan4_1  }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $dua4 = $flow_rate->percobaan4_2  }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $tiga4 = $flow_rate->percobaan4_3  }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $empat4 = $flow_rate->percobaan4_4 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $lima4 = $flow_rate->percobaan4_5}}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ $enam4 = $flow_rate->percobaan4_6 }}
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    {{ round(( $satu4 + $dua4 + $tiga4 + $empat4 + $lima4 + $enam4) / 6,2)  }}
                </td>
            </tr>
        </tbody>
    </table>
@endif
