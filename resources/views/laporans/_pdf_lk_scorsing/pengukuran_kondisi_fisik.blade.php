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
