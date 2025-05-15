<b>FLOW RATE</b>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th>Setting Alat</th>
            <th colspan="6">Penunjukan Standar</th>
            <th rowspan="2">Toleransi</th>
        </tr>
        <tr>
            <th>(LPM)</th>
            @for ($i = 1; $i <= 6; $i++)
                <th>{{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach ([3, 6, 9, 12, 15] as $index => $settingAlat)
            <tr>
                <td>{{ $settingAlat }}</td>
                @for ($j = 1; $j <= 6; $j++)
                    <td>
                        <input type="number" step="0.000000001" class="form-control"
                            name="flowmeter_{{ $settingAlat }}_{{ $j }}" required style="width: 100px">
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

<b>KONSENTRASI OKSIGEN</b>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th>Setting Alat</th>
            <th colspan="6">Penunjukan Standar</th>
            <th rowspan="2">Toleransi</th>
        </tr>
        <tr>
            <th>%</th>
            @for ($i = 1; $i <= 6; $i++)
                <th>{{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach ([21, 50, 100] as $index => $settingAlat)
            <tr>
                <td>{{ $settingAlat }}</td>
                @for ($j = 1; $j <= 6; $j++)
                    <td>
                        <input type="number" step="0.000000001" class="form-control"
                            name="percobaan_konsentrasi_oksigen_{{ $settingAlat + 1 }}_{{ $j }}" required
                            style="width: 100px">
                    </td>
                @endfor
                @if ($index == 0)
                    <td rowspan="3">± 3 % O2</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
