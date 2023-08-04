<!DOCTYPE html>
<html>

<head>
    <title>LK Scorsing {{ $nomenklaturs->nama_nomenklatur }} </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<style>
    hr.s1 {
        height: 1px;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        margin-top: 7px
    }

    .new {
        padding: 50px;
    }

    .form-group {
        display: block;
        margin-bottom: 15px;
    }

    .form-group input {
        padding: 0;
        height: initial;
        width: initial;
        margin-bottom: 0;
        display: none;
        cursor: pointer;
    }

    .form-group label {
        position: relative;
        cursor: pointer;
    }

    .form-group label:before {
        content: '';
        -webkit-appearance: none;
        background-color: transparent;
        border: 1px solid #000000;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
        padding: 5px;
        display: inline-block;
        position: relative;
        vertical-align: middle;
        cursor: pointer;
        margin-right: 5px;
    }

    .form-group input:checked+label:after {
        content: '';
        display: block;
        position: absolute;
        top: -5px;
        left: 5px;
        width: 6px;
        height: 12px;
        border: solid #000000;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    thead {
        display: table-row-group;
    }
</style>


<body>
    <table style="line-height: 8px; font-size:13px">
        <tr>
            <td style="width: 40%">
                <img src="../public/asset/logo.png" style="width: 100%">
            </td>
            <td>
                <h6>
                    <center>
                        <b>
                            LEMBAR KERJA PENGUJIAN/ KALIBRASI
                            {{ $nomenklaturs->nama_nomenklatur }}
                        </b>
                    </center>
                </h6>
                <center>
                    <span>{{ $laporan->no_dokumen }}</span>
                </center>
            </td>
        </tr>
    </table>
    <hr class="s1">
    <p style="font-size: 14px"><b>A. PENDATAAN ADMINISTRASI</b></p>
    <table class="table table-borderless  table-sm"
        style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px;float:left ">
        <tbody>
            @php($count = 1)
            @foreach ($laporan_pendataan_administrasi as $row)
                <?php if ($row->field_pendataan_administrasi == 'Faskes Pemilik') {
                    $value = get_data_rs($row->value);
                } else {
                    $value = $row->value;
                }
                ?>
                @if ($count <= $dataAwal)
                    <tr>
                        <td style="width: 1px">{{ $loop->iteration }}.</td>
                        <td style="width: 17%;text-align: justify">{{ $row->field_pendataan_administrasi }}</td>
                        <td style="width: 1px;text-align: justify">:</td>
                        <td style="text-align: justify"><b>{{ $value }} <span>{{ $row->satuan }}</span></b>
                        </td>
                    </tr>
                    @php($count++)
                @endif
            @endforeach
        </tbody>
    </table>
    <table class="table table-borderless table-sm"
        style="margin-left: 55%;font-size:11px;width:100%;margin-top:-10px;margin-bottom:0px">
        <tbody>
            @php($count2 = 1)
            @foreach ($laporan_pendataan_administrasi as $row)
                <?php if ($row->field_pendataan_administrasi == 'Faskes Pemilik') {
                    $value = get_data_rs($row->value);
                } else {
                    $value = $row->value;
                }
                ?>
                @if ($count2 > $dataAwal)
                    <tr>
                        <td style="width: 1px">{{ $loop->iteration }}.</td>
                        <td style="width: 17%;text-align: justify">{{ $row->field_pendataan_administrasi }}</td>
                        <td style="width: 1px;text-align: justify">:</td>
                        <td style="text-align: justify"> <b>{{ $value }} <span>{{ $row->satuan }}</span></b>
                        </td>
                    </tr>
                @endif
                @php($count2++)
            @endforeach
        </tbody>
    </table>

    <p style="font-size: 14px;"><b>B. DAFTAR ALAT</b></p>
    <table class="table table-bordered table-sm"
        style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
        <thead>
            <tr>
                <th style="width: 4%;text-align: center;">No</th>
                <th style="width: 24%;text-align: center;">Nama Alat</th>
                <th style="width: 24%;text-align: center;">Merk</th>
                <th style="width: 24%;text-align: center;">Tipe</th>
                <th style="width: 24%;text-align: center;">No Seri</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan_daftar_alat_ukur as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align: justify">{{ $row->jenis_alat }}</td>
                    <td style="text-align: justify">{{ $row->nama_merek }}</td>
                    <td style="text-align: justify">{{ $row->tipe }}</td>
                    <td style="text-align: justify">{{ $row->serial_number }}</td>
                </tr>
            @empty
                <tr>
                    <td style="text-align: center;">-</td>
                    <td style="text-align: center;">-</td>
                    <td style="text-align: center;">-</td>
                    <td style="text-align: center;">-</td>
                    <td style="text-align: center;">-</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p style="font-size: 14px"><b>C. PENGUKURAN KONDISI LINGKUNGAN </b></p>
    <table class="table table-bordered table-sm" style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
        <thead>
            <tr>
                <th style="width: 4%;text-align: center;">No</th>
                <th style="width: 20%;text-align: center;">Parameter</th>
                <th style="width: 35%;text-align: center;" colspan="2">Terukur</th>
                <th style="width: 15%;text-align: center;">Mean</th>
                <th style="width: 15%;text-align: center;">Mean Terkoreksi</th>
                <th style="width: 15%;text-align: center;">U95</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Thermohygrometer</td>
                <td>Awal : <b>{{ $laporan_kondisi_lingkungan->suhu_awal }}</b> <span style="float: right">&deg;C</span>
                </td>
                <td>Akhir : <b>{{ $laporan_kondisi_lingkungan->suhu_akhir }}</b> <span
                        style="float: right">&deg;C</span></td>
                <td>{{ ($laporan_kondisi_lingkungan->suhu_awal + $laporan_kondisi_lingkungan->suhu_akhir) / 2 }}
                </td>
                <td>{{ round($laporan_kondisi_lingkungan->intercept_suhu + $laporan_kondisi_lingkungan->x_variable_suhu * (($laporan_kondisi_lingkungan->suhu_awal + $laporan_kondisi_lingkungan->suhu_akhir) / 2), 2) }}
                </td>
                <td>{{ $laporan_kondisi_lingkungan->uc_suhu }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Kelembaban Ruangan </td>
                <td>Awal : <b>{{ $laporan_kondisi_lingkungan->kelembapan_ruangan_awal }}</b> <span
                        style="float: right">%RH</span>
                </td>
                <td>Akhir : <b>{{ $laporan_kondisi_lingkungan->kelembapan_ruangan_akhir }}</b> <span
                        style="float: right">%RH</span>
                </td>
                <td>{{ ($laporan_kondisi_lingkungan->kelembapan_ruangan_awal + $laporan_kondisi_lingkungan->kelembapan_ruangan_akhir) / 2 }}
                <td>{{ round($laporan_kondisi_lingkungan->intercept_kelembapan + $laporan_kondisi_lingkungan->x_variable_kelembapan * (($laporan_kondisi_lingkungan->kelembapan_ruangan_awal + $laporan_kondisi_lingkungan->kelembapan_ruangan_akhir) / 2), 2) }}
                </td>
                <td>{{ $laporan_kondisi_lingkungan->uc_kelembapan }}</td>
            </tr>

        </tbody>
    </table>

    <p style="font-size: 14px"><b>D. PEMERIKSAAAN KONDISI FISIK DAN FUNGSI</b></p>
    <table class="table table-bordered table-sm"
        style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
        <thead>
            <tr>
                <th style="width: 4%;text-align: center;">No</th>
                <th style="width: 24%;text-align: center;">Bagian Alat</th>
                {{-- <th style="width: 52%;text-align: center;">Hasil Pemeriksaan</th> --}}
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
                {{-- <td style="text-align: justify">{{ $row->field_batas_pemeriksaan }}</td> --}}
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

    <p style="font-size: 14px"><b>{{ $count_laporan_pengukuran_keselamatan_listrik > 0 ? 'F' : 'E' }}. PENGUKURAN
            KINERJA</b></p>
    @if ($nomenklaturs->id == 10 || $nomenklaturs->id == 11)
        <?php
        $laporan_occlusion = DB::table('laporan_occlusion')
            ->where('no_laporan', $laporan->no_laporan)
            ->first();
        ?>
        <p style="font-size: 12px;margin-left:18px"><b>OCCLUSION</b></p>
        <table class="table table-bordered table-sm"
            style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
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
                        {{ $mean =  round(($satu + $dua + $tiga + $empat + $lima + $enam) / 6, 2) }}</td>
                    <td style="text-align: center;vertical-align: middle;"><img src="../public/asset/kurang.png"
                            style="width: 6px; margin-top:3px"> 1379 mbar (20 psi)</td>
                    <td style="text-align: center;vertical-align: middle;">{{ $mean < 20 ? 'Lulus' : 'Tidak Lulus' }}</td>
                    <td style="text-align: center;vertical-align: middle;">{{ $mean < 20 ? 100 : 0 }}</td>
                </tr>
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
    <table class="table table-bordered table-sm"
        style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px; padding-right:18px">
        <tbody>
            <tr>
                <td style="width: 40%;text-align: center;vertical-align: middle;">Berdasarkan hasil pengujian dan/ atau
                    hasil kalibrasi, alat ini dinyatakan </td>
                <td style="width: 20%;text-align: center;vertical-align: middle;">
                    <div class="form-group" style="margin: 0px">
                        <input type="checkbox" checked>
                        <label><b style="font-size: 12px">LAIK PAKAI</b></label>
                    </div>
                </td>
                <td style="width: 20%;text-align: center;vertical-align: middle;">
                    <div class="form-group" style="margin: 0px">
                        <input type="checkbox">
                        <label><b style="font-size: 12px">TIDAK LAIK PAKAI</b></label>
                    </div>
                </td>
                <td style="width: 20%;text-align: center;vertical-align: middle;"><b
                        style="font-size: 12px">PENYELIA</b> </td>
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
</body>

</html>
