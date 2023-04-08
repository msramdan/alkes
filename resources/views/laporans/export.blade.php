<table>
    <thead>
        <tr>
            <th style="background-color:#D3D3D3 ">{{ __('No Laporan') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Tgl Laporan') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Penginput') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Faskes') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Nomenklatur') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Status Laporan') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Reviewer') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Tgl Review') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dt)
            <tr>
                <td>{{ $dt->no_laporan }}</td>
                <td>{{ $dt->tgl_laporan }}</td>
                <td>{{ $dt->nama }}</td>
                <td>{{ $dt->nama_faskes }}</td>
                <td>{{ $dt->nama_nomenklatur }}</td>
                <td>{{ $dt->status_laporan }}</td>
                <td>{{ $dt->name }}</td>
                <td>{{ $dt->tgl_review }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
