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
{{-- Hasil Pengamatan Lensa Objektif --}}
<p style="font-size: 14px"><b>{{ $count_laporan_pengukuran_keselamatan_listrik > 0 ? 'F' : 'E' }}. PENGUKURAN
        KINERJA</b></p>
<?php
$resolusi = DB::table('laporan_pendataan_administrasi')->where('no_laporan', $laporan->no_laporan)->where('slug', 'resolusi')->first();
$skala_pembesaran = DB::table('laporan_kinerja')->where('type_laporan_kinerja', 'skala_pembesaran')->where('no_laporan', $laporan->no_laporan)->first();
$data_laporan = json_decode($skala_pembesaran->data_laporan, true);

// Hitung total point
$total_point = 0;
$jumlah_pengujian = 0;

// Hitung point Kuantitas
$point_kuantitas = 0;
for ($i = 1; $i <= 5; $i++) {
    if (isset($data_laporan['kualitas_' . $i])) {
        $point_kuantitas += $data_laporan['kualitas_' . $i] == '1' ? 10 : 0;
    }
}
$total_point += $point_kuantitas;
$jumlah_pengujian++;

// Hitung point Stage jika ada
$point_stage = 0;
$show_stage = false;
for ($i = 1; $i <= 5; $i++) {
    if (isset($data_laporan['stage_' . $i])) {
        $point_stage += $data_laporan['stage_' . $i] == '1' ? 10 : 0;
        $show_stage = true;
    }
}
if ($show_stage) {
    $total_point += $point_stage;
    $jumlah_pengujian++;
}

// Hitung point Okuler jika ada
$point_okuler = 0;
$show_okuler = false;
for ($i = 1; $i <= 5; $i++) {
    if (isset($data_laporan['okuler_' . $i])) {
        $point_okuler += $data_laporan['okuler_' . $i] == '1' ? 10 : 0;
        $show_okuler = true;
    }
}
if ($show_okuler) {
    $total_point += $point_okuler;
    $jumlah_pengujian++;
}

// Hitung rata-rata
$score_kinerja = $jumlah_pengujian > 0 ? $total_point / $jumlah_pengujian : 0;
$totalAll = $score_fisik + $point + $score_kinerja;
?>
<p style="font-size: 11px;margin-left:18px"><b>Hasil Pengamatan Lensa Objektif</b></p>
<table class="table table-bordered table-sm"
    style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
    <thead>
        <tr>
            <th>Pengujian</th>
            <th>Skala Perbesaran</th>
            <th>Keterangan</th>
            <th>Score</th>
        </tr>
    </thead>
    <tbody>
        <!-- Kuantitas Section -->
        <tr>
            <td rowspan="5">Kualitas</td>
            <td><?php echo isset($data_laporan['terukur_1']) ? $data_laporan['terukur_1'] : '4'; ?> X</td>
            <td><?php echo isset($data_laporan['kualitas_1']) && $data_laporan['kualitas_1'] == '1' ? 'BAIK' : 'TIDAK BAIK'; ?></td>
            <td rowspan="5"><?php echo $point_kuantitas; ?></td>
        </tr>
        <tr>
            <td><?php echo isset($data_laporan['terukur_2']) ? $data_laporan['terukur_2'] : '10'; ?> X</td>
            <td><?php echo isset($data_laporan['kualitas_2']) && $data_laporan['kualitas_2'] == '1' ? 'BAIK' : 'TIDAK BAIK'; ?></td>
        </tr>
        <tr>
            <td><?php echo isset($data_laporan['terukur_3']) ? $data_laporan['terukur_3'] : '20'; ?> X</td>
            <td><?php echo isset($data_laporan['kualitas_3']) && $data_laporan['kualitas_3'] == '1' ? 'BAIK' : 'TIDAK BAIK'; ?></td>
        </tr>
        <tr>
            <td><?php echo isset($data_laporan['terukur_4']) ? $data_laporan['terukur_4'] : '50'; ?> X</td>
            <td><?php echo isset($data_laporan['kualitas_4']) && $data_laporan['kualitas_4'] == '1' ? 'BAIK' : 'TIDAK BAIK'; ?></td>
        </tr>
        <tr>
            <td><?php echo isset($data_laporan['terukur_5']) ? $data_laporan['terukur_5'] : '100'; ?> X</td>
            <td><?php echo isset($data_laporan['kualitas_5']) && $data_laporan['kualitas_5'] == '1' ? 'BAIK' : 'TIDAK BAIK'; ?></td>
        </tr>

        <!-- Stage Section -->
        <?php if ($show_stage): ?>
        <tr>
            <td rowspan="5">Stage</td>
            <td><?php echo isset($data_laporan['terukur_1']) ? $data_laporan['terukur_1'] : '4'; ?> X</td>
            <td><?php echo isset($data_laporan['stage_1']) && $data_laporan['stage_1'] == '1' ? 'BAIK' : 'TIDAK BAIK'; ?></td>
            <td rowspan="5"><?php echo $point_stage; ?></td>
        </tr>
        <tr>
            <td><?php echo isset($data_laporan['terukur_2']) ? $data_laporan['terukur_2'] : '10'; ?> X</td>
            <td><?php echo isset($data_laporan['stage_2']) && $data_laporan['stage_2'] == '1' ? 'BAIK' : 'TIDAK BAIK'; ?></td>
        </tr>
        <tr>
            <td><?php echo isset($data_laporan['terukur_3']) ? $data_laporan['terukur_3'] : '20'; ?> X</td>
            <td><?php echo isset($data_laporan['stage_3']) && $data_laporan['stage_3'] == '1' ? 'BAIK' : 'TIDAK BAIK'; ?></td>
        </tr>
        <tr>
            <td><?php echo isset($data_laporan['terukur_4']) ? $data_laporan['terukur_4'] : '50'; ?> X</td>
            <td><?php echo isset($data_laporan['stage_4']) && $data_laporan['stage_4'] == '1' ? 'BAIK' : 'TIDAK BAIK'; ?></td>
        </tr>
        <tr>
            <td><?php echo isset($data_laporan['terukur_5']) ? $data_laporan['terukur_5'] : '100'; ?> X</td>
            <td><?php echo isset($data_laporan['stage_5']) && $data_laporan['stage_5'] == '1' ? 'BAIK' : 'TIDAK BAIK'; ?></td>
        </tr>
        <?php endif; ?>

        <!-- Okuler Section -->
        <?php if ($show_okuler): ?>
        <tr>
            <td rowspan="5">Okuler</td>
            <td><?php echo isset($data_laporan['terukur_1']) ? $data_laporan['terukur_1'] : '4'; ?> X</td>
            <td><?php echo isset($data_laporan['okuler_1']) && $data_laporan['okuler_1'] == '1' ? 'BAIK' : 'TIDAK BAIK'; ?></td>
            <td rowspan="5"><?php echo $point_okuler; ?></td>
        </tr>
        <tr>
            <td><?php echo isset($data_laporan['terukur_2']) ? $data_laporan['terukur_2'] : '10'; ?> X</td>
            <td><?php echo isset($data_laporan['okuler_2']) && $data_laporan['okuler_2'] == '1' ? 'BAIK' : 'TIDAK BAIK'; ?></td>
        </tr>
        <tr>
            <td><?php echo isset($data_laporan['terukur_3']) ? $data_laporan['terukur_3'] : '20'; ?> X</td>
            <td><?php echo isset($data_laporan['okuler_3']) && $data_laporan['okuler_3'] == '1' ? 'BAIK' : 'TIDAK BAIK'; ?></td>
        </tr>
        <tr>
            <td><?php echo isset($data_laporan['terukur_4']) ? $data_laporan['terukur_4'] : '50'; ?> X</td>
            <td><?php echo isset($data_laporan['okuler_4']) && $data_laporan['okuler_4'] == '1' ? 'BAIK' : 'TIDAK BAIK'; ?></td>
        </tr>
        <tr>
            <td><?php echo isset($data_laporan['terukur_5']) ? $data_laporan['terukur_5'] : '100'; ?> X</td>
            <td><?php echo isset($data_laporan['okuler_5']) && $data_laporan['okuler_5'] == '1' ? 'BAIK' : 'TIDAK BAIK'; ?></td>
        </tr>
        <?php endif; ?>
        <tr>
            <td colspan="3" style="text-align:right"><strong>Rata-rata Score</strong></td>
            <td><strong><?php echo number_format($score_kinerja, 2); ?></strong></td>
        </tr>
    </tbody>
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
<div class="page_break"></div>
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
                {{ number_format($totalAll, 2) }}
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
                {{ number_format($score_kinerja, 2) }}
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
