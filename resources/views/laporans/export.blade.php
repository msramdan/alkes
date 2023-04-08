<table>
    <thead>
        <tr>
            <th style="background-color:#D3D3D3 ">{{ __('Kode Inventaris') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Kode') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Tahun Pembelian') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Ruangan') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Merek') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Jenis Alat') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Tipe') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Serial Number') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Vendor') }}</th>
        </tr>
    </thead>
    <tbody>
        {{-- @foreach ($data as $dt)
            <tr>
                <td>{{ $dt->kode_inventaris }}</td>
                <td>{{ $dt->kode }}</td>
                <td>{{ $dt->tahun_pembelian }}</td>
                <td>{{ $dt->nama_ruangan }}</td>
                <td>{{ $dt->nama_merek }}</td>
                <td>{{ $dt->jenis_alat }}</td>
                <td>{{ $dt->tipe }}</td>
                <td>{{ $dt->serial_number }}</td>
                <td>{{ $dt->nama_vendor }}</td>
            </tr>
        @endforeach --}}
    </tbody>
</table>
