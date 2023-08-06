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
if ($hitungPhaseNetral < 5) {
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
