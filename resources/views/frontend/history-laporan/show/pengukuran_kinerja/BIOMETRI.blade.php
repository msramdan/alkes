<b>Pengujian Horizontal Distance</b>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th>Setting Alat</th>
            <th colspan="5">Penunjukan Standar</th>
            <th rowspan="2">Toleransi</th>
        </tr>
        <tr>
            <th>Jarak Antar Titik <br> (mm)</th>
            @for ($i = 1; $i <= 5; $i++)
                <th>{{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach ([2.50, 20.50] as $index => $settingAlat)
            <tr>
                <td>{{ $settingAlat }}</td>
                @for ($j = 1; $j <= 5; $j++)
                    <td>
                        <input type="number" step="0.000000001" class="form-control"
                               name="horizontal_distance_{{ $index + 1 }}_{{ $j }}" required style="width: 100px">
                    </td>
                @endfor
                @if ($index == 0)
                    <td rowspan="5">± 10%</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

<br>

<b>Pengujian Vertikal Distance</b>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th>Setting Alat</th>
            <th colspan="5">Penunjukan Standar</th>
            <th rowspan="2">Toleransi</th>
        </tr>
        <tr>
            <th>Jarak Antar Titik <br>
                (mm)</th>
            @for ($i = 1; $i <= 5; $i++)
                <th>{{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach ([2.50, 5.00, 25.00] as $index => $settingAlat)
            <tr>
                <td>{{ $settingAlat }}</td>
                @for ($j = 1; $j <= 5; $j++)
                    <td>
                        <input type="number" step="0.000000001" class="form-control"
                               name="vertikal_distance_{{ $index + 1 }}_{{ $j }}" required style="width: 100px">
                    </td>
                @endfor
                @if ($index == 0)
                    <td rowspan="3">± 3 % O2</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
