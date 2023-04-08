<table>
    <thead>
        <tr>
            <th style="background-color:#D3D3D3 ">{{ __('Nama Faskes') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Jenis Faskes') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Provinsi') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Kabukaten/Kota') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Kecamatan') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Kelurahan') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Alamat') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dt)
            <tr>
                <td>{{ $dt->nama_faskes }}</td>
                <td>{{ $dt->nama_jenis_faskes }}</td>
                <td>{{ $dt->provinsi }}</td>
                <td>{{ $dt->kabupaten_kota }}</td>
                <td>{{ $dt->kecamatan }}</td>
                <td>{{ $dt->kelurahan }}</td>
                <td>{{ $dt->alamat }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
