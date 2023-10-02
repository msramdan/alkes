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
            @php
                $data_laporan = json_decode($laporan_kondisi_lingkungan->data_laporan);
                $data_sertifikat = json_decode($laporan_kondisi_lingkungan->data_sertifikat);
            @endphp
            <td>Awal : <b>{{ $data_laporan->suhu_awal }}</b> <span style="float: right">&deg;C</span>
            </td>
            <td>Akhir : <b>{{ $data_laporan->suhu_akhir }}</b> <span
                    style="float: right">&deg;C</span></td>
            <td>{{ ($data_laporan->suhu_awal + $data_laporan->suhu_akhir) / 2 }}
            </td>
            <td>{{ round($data_sertifikat->intercept_suhu + $data_sertifikat->x_variable_suhu * (($data_laporan->suhu_awal + $data_laporan->suhu_akhir) / 2), 2) }}
            </td>
            <td>{{ $data_sertifikat->uc_suhu }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Kelembaban Ruangan </td>
            <td>Awal : <b>{{ $data_laporan->kelembapan_ruangan_awal }}</b> <span
                    style="float: right">%RH</span>
            </td>
            <td>Akhir : <b>{{ $data_laporan->kelembapan_ruangan_akhir }}</b> <span
                    style="float: right">%RH</span>
            </td>
            <td>{{ ($data_laporan->kelembapan_ruangan_awal + $data_laporan->kelembapan_ruangan_akhir) / 2 }}
            <td>{{ round($data_sertifikat->intercept_kelembapan + $data_sertifikat->x_variable_kelembapan * (($data_laporan->kelembapan_ruangan_awal + $data_laporan->kelembapan_ruangan_akhir) / 2), 2) }}
            </td>
            <td>{{ $data_sertifikat->uc_kelembapan }}</td>
        </tr>

    </tbody>
</table>
