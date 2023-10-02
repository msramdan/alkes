<p style="font-size: 14px"><b>C. PENGUKURAN KONDISI LINGKUNGAN </b></p>
<table class="table table-bordered table-sm" style="margin-left: 18px;font-size:11px;width:75%;margin-top:-10px;">
    <thead>
        <tr>
            <th style="width: 4%;text-align: center;">No</th>
            <th style="width: 35%;text-align: center;">Parameter</th>
            <th style="width: 35%;text-align: center;" colspan="2">Terukur</th>
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
        </tr>

    </tbody>
</table>
