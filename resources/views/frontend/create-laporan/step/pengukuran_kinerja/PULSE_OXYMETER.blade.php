<b>Pengukuran Heart Rate</b>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th>Setting Standar</th>
            <th colspan="6">Penunjukan Standar</th>
            <th rowspan="2">Toleransi</th>
        </tr>
        <tr>
            <th>(BPM)</th>
            @for ($i = 1; $i <= 6; $i++)
                <th>{{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach ([30, 60, 120, 180] as $index => $heartRate)
            <tr>
                <td>{{ $heartRate }}</td>
                @for ($j = 1; $j <= 6; $j++)
                    <td>
                        <input type="number" step="0.000000001" class="form-control"
                               name="pengukuran_heart_rate_{{ $heartRate }}_{{ $j }}" required style="width: 100px">
                    </td>
                @endfor
                @if ($index == 0)
                    <td rowspan="4">± 5%</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

<br>

<b>Pengukuran Saturasi Oksigen</b>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th>Setting Standar</th>
            <th colspan="6">Penunjukan Standar</th>
            <th rowspan="2">Toleransi</th>
        </tr>
        <tr>
            <th>(%O2)</th>
            @for ($i = 1; $i <= 6; $i++)
                <th>{{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach ([
            'Normal' => 98,
            'Obese' => 93,
            'Geriat' => 92,
            'Tech' => 85,
            'Neonate' => 90,
            'Hypoxic' => 70,
            'Brad' => 88,
            'Weak' => 90
        ] as $setting => $saturasi)
            <tr>
                <td>{{ $setting }} ({{ $saturasi }})</td>
                @for ($j = 1; $j <= 6; $j++)
                    <td>
                        <input type="number" step="0.000000001" class="form-control"
                               name="pengukuran_saturasi_oksigen_{{ $setting }}_{{ $j }}" required style="width: 100px">
                    </td>
                @endfor
                @if ($loop->first)
                    <td rowspan="8">± 2%</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
