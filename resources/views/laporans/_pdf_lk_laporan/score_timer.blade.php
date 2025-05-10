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

{{-- akurasi_waktu --}}
<?php
$resolusi = DB::table('laporan_pendataan_administrasi')->where('no_laporan', $laporan->no_laporan)->where('slug', 'resolusi')->first();
$akurasi_waktu = DB::table('laporan_kinerja')->where('type_laporan_kinerja', 'akurasi_waktu')->where('no_laporan', $laporan->no_laporan)->first();
$data_sertifikat = json_decode($akurasi_waktu->data_sertifikat);
$data_laporan = json_decode($akurasi_waktu->data_laporan);

$akurasiWaktus = [300, 600, 900];
$akurasiWaktuData = [];
$akurasiWaktuScore = 0;

foreach ($akurasiWaktus as $detik) {
    $prefix = "timer_{$detik}";
    $measurements = [];

    // Collect all 3 measurements
    for ($i = 1; $i <= 3; $i++) {
        $field = "{$prefix}_{$i}";
        $measurements[$i] = $data_laporan->$field;
    }
    // Calculate statistics
    $mean = array_sum($measurements) / count($measurements);
    $mean_terkoreksi = $data_sertifikat->intercept + $data_sertifikat->x_variable * $mean;
    $stdev = standard_deviation($measurements);
    $field_drift = "drift_{$detik}";
    $drift = $data_sertifikat->{$field_drift};
    $u95 = hitung_uncertainty($resolusi->value, $stdev, $data_sertifikat->u, $drift, 3);
    $correction = $mean_terkoreksi - $detik;
    $cu95 = abs($correction) + $u95;
    $tolerance = 0.1 * $detik;
    $result = abs($u95) <= $tolerance ? 'Lulus' : 'Tidak';

    if ($result == 'Lulus') {
        $akurasiWaktuScore++;
    }

    $akurasiWaktuData[] = [
        'detik' => $detik,
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

$akurasiWaktuFinalScore = ($akurasiWaktuScore / count($akurasiWaktus)) * 100 * 0.9;
$akurasiWaktuRequirement = $akurasiWaktuFinalScore >= 50 ? 'Lulus' : 'Tidak';
$totalAll = $score_fisik + $akurasiWaktuFinalScore;
?>

<p style="font-size: 14px;"><b>{{ $count_laporan_pengukuran_keselamatan_listrik > 0 ? 'F' : 'E' }}.
        PENGUKURAN KINERJA</b></p>
<!-- Heart Rate Table -->
<p style="font-size: 11px;margin-left:18px"><b>Akurasi Waktu</b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:9px;width:100%;margin-top:-10px; padding-right:18px">
    <tr>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Setting Standar</th>
        <th colspan="3" style="text-align: center;vertical-align: middle;">Penunjukan Alat (BPM)</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Mean Terkoreksi</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Koreksi</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Toleransi</th>
    </tr>
    <tr>
        @for ($i = 1; $i <= 3; $i++)
            <th style="text-align: center;vertical-align: middle;">{{ $i }}</th>
        @endfor
    </tr>
    @foreach ($akurasiWaktuData as $data)
        <tr>
            <td style="text-align: center;vertical-align: middle;">{{ $data['detik'] }}</td>
            @for ($i = 1; $i <= 3; $i++)
                <td style="text-align: center;vertical-align: middle;">{{ round($data['measurements'][$i], 2) }}</td>
            @endfor
            <td style="text-align: center;vertical-align: middle;">{{ round($data['mean_terkoreksi'], 2) }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ round($data['correction'], 2) }}</td>
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
