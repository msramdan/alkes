<div class="row">
    <div class="col-md-5">
        <p><b>Gambarkan Posisi Sensor</b></p>
        <div class="row g-3 align-items-center mb-2">
            <div class="col-auto" style="width: 100px">
                <label for="panjang" class="col-form-label">Panjang (m)</label>
            </div>
            <div class="col-auto">
                <input  type="number" step="0.000000001" id="panjang" name="panjang" class="form-control" required>
            </div>
        </div>
        <div class="row g-3 align-items-center mb-2">
            <div class="col-auto" style="width: 100px">
                <label for="lebar" class="col-form-label">Lebar (m)</label>
            </div>
            <div class="col-auto">
                <input  type="number" step="0.000000001" id="lebar" name="lebar" class="form-control" required>
            </div>
        </div>
        <div class="row g-3 align-items-center mb-2">
            <div class="col-auto" style="width: 100px">
                <label for="tinggi" class="col-form-label">Tinggi (m)</label>
            </div>
            <div class="col-auto">
                <input  type="number" step="0.000000001" id="tinggi" name="tinggi" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <center>
            <img src="{{ asset('kubus.png') }}" alt="">
        </center>
    </div>

</div>
<br>
<br>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th rowspan="3">Posisi Sensor <br>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="posisi_sensor"
                    required placeholder="°C">
            </th>
            <th colspan="6">Penunjukan Standar</th>
            <th rowspan="3">Toleransi</th>
        </tr>
        <tr>
            <th colspan="2">1</th>
            <th colspan="2">2</th>
            <th colspan="2">3</th>
        </tr>
        <tr>
            <th>Min</th>
            <th>Max</th>
            <th>Min</th>
            <th>Max</th>
            <th>Min</th>
            <th>Max</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan1_1_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan1_1_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan1_2_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan1_2_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan1_3_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan1_3_max" required>
            </td>
            <td rowspan="9"> ± 1,5 °C
            </td>
        </tr>

        <tr>
            <td>2 </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan2_1_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan2_1_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan2_2_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan2_2_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan2_3_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan2_3_max" required>
            </td>
        </tr>

        <tr>
            <td>3</td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan3_1_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan3_1_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan3_2_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan3_2_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan3_3_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan3_3_max" required>
            </td>
        </tr>

        <tr>
            <td>4 </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan4_1_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan4_1_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan4_2_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan4_2_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan4_3_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan4_3_max" required>
            </td>
        </tr>

        <tr>
            <td>5 </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan5_1_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan5_1_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan5_2_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan5_2_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan5_3_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan5_3_max" required>
            </td>
        </tr>

        <tr>
            <td>6</td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan6_1_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan6_1_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan6_2_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan6_2_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan6_3_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan6_3_max" required>
            </td>
        </tr>

        <tr>
            <td>7</td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan7_1_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan7_1_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan7_2_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan7_2_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan7_3_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan7_3_max" required>
            </td>
        </tr>

        <tr>
            <td>8</td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan8_1_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan8_1_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan8_2_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan8_2_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan8_3_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan8_3_max" required>
            </td>
        </tr>

        <tr>
            <td>9</td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan9_1_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan9_1_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan9_2_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan9_2_max" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan9_3_min" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan9_3_max" required>
            </td>
        </tr>
    </tbody>
</table>
