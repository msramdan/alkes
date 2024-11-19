<b>Pengukuran Frekuensi</b>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th>Setting Alat</th>
            <th colspan="6">Penunjukan Standar</th>
            <th rowspan="2">Toleransi</th>
        </tr>
        <tr>
            <th>(Hz)</th>
            @for ($i = 1; $i <= 6; $i++)
                <th>{{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach ([10, 25, 50, 100, 500] as $index => $settingAlat)
            <tr>
                <td>{{ $settingAlat }}</td>
                @for ($j = 1; $j <= 6; $j++)
                    <td>
                        <input type="number" step="0.000000001" class="form-control"
                               name="pengukuran_frekuensi{{ $index + 1 }}_{{ $j }}" required style="width: 100px">
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

<b>Pengukuran Pulse Duration</b>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th>Setting Alat</th>
            <th colspan="6">Penunjukan Standar</th>
            <th rowspan="2">Toleransi</th>
        </tr>
        <tr>
            <th>(μs)</th>
            @for ($i = 1; $i <= 6; $i++)
                <th>{{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach ([100, 200, 500, 1000] as $index => $pulseDuration)
            <tr>
                <td>{{ $pulseDuration }}</td>
                @for ($j = 1; $j <= 6; $j++)
                    <td>
                        <input type="number" step="0.000000001" class="form-control"
                               name="pengukuran_pulse_duration{{ $index + 1 }}_{{ $j }}" required style="width: 100px">
                    </td>
                @endfor
                @if ($index == 0)
                    <td rowspan="4">± 10%</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

<br>

<b>Pengukuran Intensitas Therapy</b>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th>Setting Alat</th>
            <th colspan="6">Penunjukan Standar</th>
            <th rowspan="2">Toleransi</th>
        </tr>
        <tr>
            <th>mA            </th>
            @for ($i = 1; $i <= 6; $i++)
                <th>{{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach ([10, 20, 30, 40, 100] as $index => $intensity)
            <tr>
                <td>{{ $intensity }}</td>
                @for ($j = 1; $j <= 6; $j++)
                    <td>
                        <input type="number" step="0.000000001" class="form-control"
                               name="pengukuran_intensitas_therapy{{ $index + 1 }}_{{ $j }}" required style="width: 100px">
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

<b>Pengukuran Waktu Therapy</b>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th>Setting Alat</th>
            <th colspan="6">Penunjukan Standar</th>
            <th rowspan="2">Toleransi</th>
        </tr>
        <tr>
            <th>(s)</th>
            @for ($i = 1; $i <= 6; $i++)
                <th>{{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>300</td>
            @for ($j = 1; $j <= 6; $j++)
                <td>
                    <input type="number" step="0.000000001" class="form-control"
                           name="pengukuran_waktu_therapy_300_{{ $j }}" required style="width: 100px">
                </td>
            @endfor
            <td>± 10%</td>
        </tr>
    </tbody>
</table>
