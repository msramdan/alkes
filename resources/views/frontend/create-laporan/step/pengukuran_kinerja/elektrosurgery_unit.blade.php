<b>1. Kalibrasi HF Leakage Current Mode Cutting</b><br>

<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th colspan="2">Setting</th>
            <th colspan="3">Penunjukan Standar (Watt)</th>
            <th rowspan="2">Toleransi</th>
        </tr>
        <tr>
            <th>Ohm Kalibrator</th>
            <th>Watt UUT</th>
            @for ($i = 1; $i <= 3; $i++)
                <th>{{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>200</td>
            <td>250</td>
            <td><input type="number" step="0.000000001" class="form-control" name="hf_leakage_cutting_1" required
                    style="width: 100px">
            </td>
            <td><input type="number" step="0.000000001" class="form-control" name="hf_leakage_cutting_2" required
                    style="width: 100px"></td>
            <td><input type="number" step="0.000000001" class="form-control" name="hf_leakage_cutting_3" required
                    style="width: 100px"></td>
            <td>≤ 4.5 watt pada nilai 150 mA</td>
        </tr>
    </tbody>
</table>

<br>
<b>2. Kalibrasi HF Leakage Current Mode Coagulating</b> <br>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th colspan="2">Setting</th>
            <th colspan="3">Penunjukan Standar (Watt)</th>
            <th rowspan="2">Toleransi</th>
        </tr>
        <tr>
            <th>Ohm Kalibrator</th>
            <th>Watt UUT</th>
            @for ($i = 1; $i <= 3; $i++)
                <th>{{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>200</td>
            <td>80</td>
            <td><input type="number" step="0.000000001" class="form-control" name="hf_leakage_coagulating_1" required
                    style="width: 100px">
            </td>
            <td><input type="number" step="0.000000001" class="form-control" name="hf_leakage_coagulating_2" required
                    style="width: 100px"></td>
            <td><input type="number" step="0.000000001" class="form-control" name="hf_leakage_coagulating_3" required
                    style="width: 100px"></td>
            <td>≤ 4.5 watt pada nilai 150 mA</td>
        </tr>
    </tbody>
</table>
<br>
<b>3. Pengujian Contact Quality Monitoring (REM)</b> <br>
<table class="table table-bordered" style="border-color: black">
    <tbody>
        <tr>
            <td>REM : </td>
            <td><input type="number" step="0.000000001" class="form-control" name="rem" required
                    style="width: 100px">
            </td>
            <td>ohm</td>
        </tr>
    </tbody>
</table>

<b>4. Pengukuran Daya Energi Cutting</b> <br>
<div class="row mb-1 align-items-center">
    <label for="mode_keluaran_energi_1" class="col-sm-3 col-form-label">Mode Keluaran Energi</label>
    <div class="col-sm-9">
        <input type="number" style="width: 100px" step="0.000000001" class="form-control" id="mode_keluaran_energi_1"
            name="mode_keluaran_energi_1" placeholder="Watt">
    </div>
</div>
<div class="row mb-1 align-items-center">
    <label for="load_impedance_1" class="col-sm-3 col-form-label">Load Impedance</label>
    <div class="col-sm-9">
        <input type="number" style="width: 100px" step="0.000000001" class="form-control" id="load_impedance_1"
            name="load_impedance_1" placeholder="Ohm">
    </div>
</div>
<div class="row mb-1 align-items-center">
    <label for="daya_energi_max_1" class="col-sm-3 col-form-label">Kemampuan Daya Energi Max</label>
    <div class="col-sm-9">
        <input type="number" style="width: 100px" step="0.000000001" class="form-control" id="daya_energi_max_1"
            name="daya_energi_max_1" placeholder="Watt">
    </div>
</div> <br>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th>Setting Alat</th>
            <th colspan="6">Penunjukan Standar (Watt)</th>
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
        @foreach ([10, 20, 30, 40, 50, 60, 70, 80] as $index => $heartRate)
            <tr>
                <td>{{ $heartRate }} %</td>
                @for ($j = 1; $j <= 6; $j++)
                    <td>
                        <input type="number" step="0.000000001" class="form-control"
                            name="energi_cutting{{ $index + 1 }}_{{ $j }}" required style="width: 100px">
                    </td>
                @endfor
                @if ($index == 0)
                    <td rowspan="8">± 5 %</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

<b>5. Pengukuran Daya Energi Coagulating</b> <br>
<div class="row mb-1 align-items-center">
    <label for="mode_keluaran_energi_2" class="col-sm-3 col-form-label">Mode Keluaran Energi</label>
    <div class="col-sm-9">
        <input type="number" style="width: 100px" step="0.000000001" class="form-control" id="mode_keluaran_energi_2"
            name="mode_keluaran_energi_2" placeholder="Watt">
    </div>
</div>
<div class="row mb-1 align-items-center">
    <label for="load_impedance_2" class="col-sm-3 col-form-label">Load Impedance</label>
    <div class="col-sm-9">
        <input type="number" style="width: 100px" step="0.000000001" class="form-control" id="load_impedance_2"
            name="load_impedance_2" placeholder="Ohm">
    </div>
</div>
<div class="row mb-1 align-items-center">
    <label for="daya_energi_max_3" class="col-sm-3 col-form-label">Kemampuan Daya Energi Max</label>
    <div class="col-sm-9">
        <input type="number" style="width: 100px" step="0.000000001" class="form-control" id="daya_energi_max_3"
            name="daya_energi_max_3" placeholder="Watt">
    </div>
</div> <br>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th>Setting Alat</th>
            <th colspan="6">Penunjukan Standar (Watt)</th>
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
        @foreach ([10, 20, 30, 40, 50, 60, 70, 80] as $index => $heartRate)
            <tr>
                <td>{{ $heartRate }} %</td>
                @for ($j = 1; $j <= 6; $j++)
                    <td>
                        <input type="number" step="0.000000001" class="form-control"
                            name="energi_coagulating{{ $index + 1 }}_{{ $j }}" required
                            style="width: 100px">
                    </td>
                @endfor
                @if ($index == 0)
                    <td rowspan="8">± 5 %</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
