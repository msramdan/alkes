<table>
    <thead>
        <tr>
            <th style="background-color:#D3D3D3 ">{{ __('Nama') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Jenis Kelamin') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('No Telpon') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Email') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Tempat Lahir') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Tangal Lahir') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dt)
            <tr>
                <td>{{ $dt->nama }}</td>
                <td>{{ $dt->jenis_kelamin }}</td>
                <td>{{ $dt->no_telpon }}</td>
                <td>{{ $dt->email }}</td>
                <td>{{ $dt->tempat_lahir }}</td>
                <td>{{ $dt->tangal_lahir }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
