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
