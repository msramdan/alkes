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


{{-- spectral_irradiance_phototherapy --}}
<?php
$resolusi = DB::table('laporan_pendataan_administrasi')->where('no_laporan', $laporan->no_laporan)->where('slug', 'resolusi')->first();
$spectral_irradiance_phototherapy = DB::table('laporan_kinerja')->where('type_laporan_kinerja', 'spectral_irradiance_phototherapy')->where('no_laporan', $laporan->no_laporan)->first();
$data_sertifikat = json_decode($spectral_irradiance_phototherapy->data_sertifikat);
$data_laporan = json_decode($spectral_irradiance_phototherapy->data_laporan);
$nilaiPembagi = $data_laporan->pembagi;

$spectralIrradiances = ['Max'];
$spectralIrradianceData = [];
$spectralIrradianceScore = 0;

foreach ($spectralIrradiances as $rate) {
    $prefix = 'spectral_irradiance';
    $measurements = [];

    // Collect all 6 measurements
    for ($i = 1; $i <= 6; $i++) {
        $field = "{$prefix}_{$i}";
        $measurements[$i] = $data_laporan->$field / $nilaiPembagi;
    }
    // Calculate statistics
    $mean = array_sum($measurements) / count($measurements);
    $mean_terkoreksi = $mean;
    $stdev = standard_deviation($measurements);
    $u95 = hitung_uncertainty($resolusi->value, $stdev, $data_sertifikat->uc, 0, 6);
    $cu95 = $mean_terkoreksi + $u95;
    $tolerance = 4;
    $result = $cu95 >= $tolerance ? 'Lulus' : 'Tidak';

    if ($result == 'Lulus') {
        $spectralIrradianceScore++;
    }

    $spectralIrradianceData[] = [
        'rate' => $rate,
        'measurements' => $measurements,
        'mean' => $mean,
        'mean_terkoreksi' => $mean_terkoreksi,
        'stdev' => $stdev,
        'correction' => '',
        'u95' => $u95,
        'cu95' => $cu95,
        'tolerance' => $tolerance,
        'result' => $result,
    ];
}

$spectralIrradianceFinalScore = ($spectralIrradianceScore / count($spectralIrradiances)) * 50;
$spectralIrradianceRequirement = $spectralIrradianceFinalScore >= 50 ? 'Lulus' : 'Tidak';
$totalAll = $score_fisik + $point + $spectralIrradianceFinalScore;
?>


<p style="font-size: 14px"><b>{{ $count_laporan_pengukuran_keselamatan_listrik > 0 ? 'F' : 'E' }}.
    PENGUKURAN KINERJA</b></p>

<p style="font-size: 11px;margin-left:18px"><b>Spectral Irradiance</b></p>
<table class="table table-bordered table-sm"
style="margin-left: 18px;font-size:9px;width:100%;margin-top:-10px; padding-right:18px">
<tr>
    <th rowspan="2" style="text-align: center;vertical-align: middle;">Setting Standar</th>
    <th colspan="6" style="text-align: center;vertical-align: middle;">Penunjukan Alat (BPM)</th>
    <th rowspan="2" style="text-align: center;vertical-align: middle;">Mean</th>
    <th rowspan="2" style="text-align: center;vertical-align: middle;">Toleransi</th>
</tr>
<tr>
    @for ($i = 1; $i <= 6; $i++)
        <th style="text-align: center;vertical-align: middle;">{{ $i }}</th>
    @endfor
</tr>
@foreach ($spectralIrradianceData as $data)
    <tr>
        <td style="text-align: center;vertical-align: middle;">{{ $data['rate'] }}</td>
        @for ($i = 1; $i <= 6; $i++)
            <td style="text-align: center;vertical-align: middle;">{{ round($data['measurements'][$i], 2) }}</td>
        @endfor
        <td style="text-align: center;vertical-align: middle;">{{ round($data['mean'], 2) }}</td>
        <td style="text-align: center;vertical-align: middle;">{{ round($data['tolerance'], 2) }}</td>
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
                <li>Hasil kalibrasi Heart Rate tertelusur ke sistem satuan internasional (SI) melalui Fluke
                    Biomedical
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
