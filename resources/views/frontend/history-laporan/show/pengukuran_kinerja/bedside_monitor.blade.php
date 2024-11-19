<b>1. Heart Rate</b><br>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th>Setting Standar</th>
            <th colspan="6">Penunjukan Alat (BPM)</th>
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
                            name="pengukuran_heart_rate{{ $index + 1 }}_{{ $j }}" required
                            style="width: 100px">
                    </td>
                @endfor
                @if ($index == 0)
                    <td rowspan="4">± 5%</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
<b>2. Respiration Rate</b><br>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th>Setting Standar</th>
            <th colspan="6">Penunjukan Alat (BPM)</th>
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
        @foreach ([15, 30, 60, 120] as $index => $heartRate)
            <tr>
                <td>{{ $heartRate }}</td>
                @for ($j = 1; $j <= 6; $j++)
                    <td>
                        <input type="number" step="0.000000001" class="form-control"
                            name="pengukuran_heart_rate{{ $index + 1 }}_{{ $j }}" required
                            style="width: 100px">
                    </td>
                @endfor
                @if ($index == 0)
                    <td rowspan="4">± 10%</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
<b>3. Saturasi Oksigen</b><br>
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
        'Weak' => 90,
    ] as $setting => $saturasi)
            <tr>
                <td>{{ $setting }} ({{ $saturasi }})</td>
                @for ($j = 1; $j <= 6; $j++)
                    <td>
                        <input type="number" step="0.000000001" class="form-control"
                            name="pengukuran_saturasi_oksigen_{{ $setting }}_{{ $j }}" required
                            style="width: 100px">
                    </td>
                @endfor
                @if ($loop->first)
                    <td rowspan="8">± 1 %O2</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
<b>4. Blood Pressure ( Dewasa / Adult / Pediatric )</b> <br>
<table class="table table-bordered text-center" style="border-color: black">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Setting Standar (mmHg)</th>
            <th colspan="6">Penunjukan Alat (mmHg)</th>
            <th rowspan="2">Penyimpangan yang diijinkan</th>
        </tr>
        <tr>
            @for ($i = 1; $i <= 6; $i++)
                <th>{{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        <!-- Row 1 -->
        <tr>
            <td rowspan="3">1</td>
            <td>Systole 60</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="systole_60_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
            <td rowspan="3">± 5 mmHg</td>
        </tr>
        <tr>
            <td>MAP 40</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="map_40_{{ $i }}" style="width: 80px;">
                </td>
            @endfor
        </tr>
        <tr>
            <td>Diastole 30</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="diastole_30_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
        </tr>

        <!-- Row 2 -->
        <tr>
            <td rowspan="3">2</td>
            <td>Systole 80</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="systole_80_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
            <td rowspan="3">± 5 mmHg</td>
        </tr>
        <tr>
            <td>MAP 60</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="map_60_{{ $i }}" style="width: 80px;">
                </td>
            @endfor
        </tr>
        <tr>
            <td>Diastole 50</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="diastole_50_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
        </tr>

        <!-- Row 3 -->
        <tr>
            <td rowspan="3">3</td>
            <td>Systole 100</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="systole_100_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
            <td rowspan="3">± 5 mmHg</td>
        </tr>
        <tr>
            <td>MAP 76</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="map_76_{{ $i }}" style="width: 80px;">
                </td>
            @endfor
        </tr>
        <tr>
            <td>Diastole 65</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="diastole_65_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
        </tr>

        <!-- Row 4 -->
        <tr>
            <td rowspan="3">4</td>
            <td>Systole 120</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="systole_120_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
            <td rowspan="3">± 5 mmHg</td>
        </tr>
        <tr>
            <td>MAP 93</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="map_93_{{ $i }}" style="width: 80px;">
                </td>
            @endfor
        </tr>
        <tr>
            <td>Diastole 80</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="diastole_80_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
        </tr>

        <!-- Row 5 -->
        <tr>
            <td rowspan="3">5</td>
            <td>Systole 150</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="systole_150_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
            <td rowspan="3">± 5 mmHg</td>
        </tr>
        <tr>
            <td>MAP 116</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="map_116_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
        </tr>
        <tr>
            <td>Diastole 100</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="diastole_100_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
        </tr>

        <!-- Row 6 -->
        <tr>
            <td rowspan="3">6</td>
            <td>Systole 200</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="systole_200_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
            <td rowspan="3">± 5 mmHg</td>
        </tr>
        <tr>
            <td>MAP 166</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="map_166_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
        </tr>
        <tr>
            <td>Diastole 150</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="diastole_150_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
        </tr>

    </tbody>
</table>
<b>5. Blood Pressure ( Bayi / Neonatal )</b><br>
<table class="table table-bordered text-center" style="border-color: black">
    <thead>
        <tr>
            <th>No</th>
            <th>Setting Standar (mmHg)</th>
            <th colspan="6">Penunjukan Alat (mmHg)</th>
            <th>Penyimpangan yang diijinkan</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            @for ($i = 1; $i <= 6; $i++)
                <th>{{ $i }}</th>
            @endfor
            <th></th>
        </tr>
    </thead>
    <tbody>
        <!-- Row Group 1 -->
        <tr>
            <td rowspan="3">1</td>
            <td>Systole 35</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="systole_35_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
            <td rowspan="3">± 3 mmHg</td>
        </tr>
        <tr>
            <td>MAP 22</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="map_22_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
        </tr>
        <tr>
            <td>Diastole 15</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="diastole_15_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
        </tr>

        <!-- Row Group 2 -->
        <tr>
            <td rowspan="3">2</td>
            <td>Systole 60</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="systole_60_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
            <td rowspan="3">± 3 mmHg</td>
        </tr>
        <tr>
            <td>MAP 40</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="map_40_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
        </tr>
        <tr>
            <td>Diastole 30</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="diastole_30_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
        </tr>

        <!-- Row Group 3 -->
        <tr>
            <td rowspan="3">3</td>
            <td>Systole 80</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="systole_80_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
            <td rowspan="3">± 3 mmHg</td>
        </tr>
        <tr>
            <td>MAP 60</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="map_60_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
        </tr>
        <tr>
            <td>Diastole 50</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="diastole_50_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
        </tr>

        <!-- Row Group 4 -->
        <tr>
            <td rowspan="3">4</td>
            <td>Systole 100</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="systole_100_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
            <td rowspan="3">± 3 mmHg</td>
        </tr>
        <tr>
            <td>MAP 80</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="map_80_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
        </tr>
        <tr>
            <td>Diastole 70</td>
            @for ($i = 1; $i <= 6; $i++)
                <td><input type="number" class="form-control" name="diastole_70_{{ $i }}"
                        style="width: 80px;"></td>
            @endfor
        </tr>
    </tbody>
</table>
