<!DOCTYPE html>
<html>

<head>
    <title>LK {{ $nomenklaturs->nama_nomenklatur }} </title>
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
                    <span>{{ $nomenklaturs->no_dokumen }}</span>
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
                @if ($count <= $dataAwal)
                    <tr>
                        <td style="width: 1px">{{ $loop->iteration }}.</td>
                        <td style="width: 20%;text-align: justify">{{ $row->field_pendataan_administrasi }}</td>
                        <td style="width: 1px;text-align: justify">:</td>
                        <td style="text-align: justify"><b>{{ $row->value }} <span>{{ $row->satuan }}</span></b>
                        </td>
                    </tr>
                    @php($count++)
                @endif
            @endforeach
        </tbody>
    </table>
    <table class="table table-borderless table-sm"
        style="margin-left: 50%;font-size:11px;width:100%;margin-top:-10px;margin-bottom:0px">
        <tbody>
            @php($count2 = 1)
            @foreach ($laporan_pendataan_administrasi as $row)
                @if ($count2 > $dataAwal)
                    <tr>
                        <td style="width: 1px">{{ $loop->iteration }}.</td>
                        <td style="width: 20%;text-align: justify">{{ $row->field_pendataan_administrasi }}</td>
                        <td style="width: 1px;text-align: justify">:</td>
                        <td style="text-align: justify"> <b>{{ $row->value }} <span>{{ $row->satuan }}</span></b>
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
    <table class="table table-bordered table-sm" style="margin-left: 18px;font-size:11px;width:75%;margin-top:-10px;">
        <thead>
            <tr>
                <th style="width: 4%;text-align: center;">No</th>
                <th style="width: 35%;text-align: center;">Parameter</th>
                <th style="width: 35%;text-align: center;">Terukur</th>
                <th style="width: 35%;text-align: center;">Terukur</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Thermohygrometer</td>
                <td>Awal : <b>{{ isset($laporan_kondisi_lingkungan->suhu_awal) }}</b> <span
                        style="float: right">&deg;C</span></td>
                <td>Akhir : <b>{{ isset($laporan_kondisi_lingkungan->suhu_akhir) }}</b> <span
                        style="float: right">&deg;C</span></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Kelembaban Ruangan </td>
                <td>Awal : <b>{{ isset($laporan_kondisi_lingkungan->kelembapan_ruangan_awal) }}</b> <span
                        style="float: right">%RH</span>
                </td>
                <td>Akhir : <b>{{ isset($laporan_kondisi_lingkungan->kelembapan_ruangan_akhir) }}</b> <span
                        style="float: right">%RH</span>
                </td>
            </tr>

        </tbody>
    </table>

    <p style="font-size: 14px"><b>D. PEMERIKSAAAN KONDISI FISIK DAN FUNGSI ( CEK KUALITATIF)</b></p>
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
</body>

</html>
