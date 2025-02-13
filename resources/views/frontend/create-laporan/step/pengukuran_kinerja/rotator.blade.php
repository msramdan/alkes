<b>1. Kecepatan Putaran</b>

<table class="table table-borderless" style="line-height: 8px">
    <tr>
        <th style="text-align: left; line-height: 1;">setting</th>
        <td>:</td>
        <td>1</td>
        <td></td>
    </tr>
    <tr>
        <th style="text-align: left;">step</th>
        <td>:</td>
        <td>2</td>
        <td></td>
    </tr>
    <tr>
        <th style="text-align: left;">max</th>
        <td>:</td>
        <td><input style="width: 100px; float" type="number" step="0.000000001" class="form-control" required name="rpm_max"
                required></td>
        <th>Rpm</th>
    </tr>
</table>


<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th rowspan="2">Setting Alat</th>
            <th colspan="6">Penunjukan Standar (Rpm)</th>
            <th rowspan="2">Toleransi</th>
        </tr>
        <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>50 %</td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                    name="putaran_50_1" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                    name="putaran_50_2" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                    name="putaran_50_3" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                    name="putaran_50_4" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                    name="putaran_50_5" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                    name="putaran_50_6" required>
            </td>
            <td rowspan="2"> ± 10 % </td>
        </tr>
        <tr>
            <td>100 %</td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                    name="putaran_100_1" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                    name="putaran_100_2" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                    name="putaran_100_3" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                    name="putaran_100_4" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                    name="putaran_100_5" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                    name="putaran_100_6" required>
            </td>
        </tr>
    </tbody>
</table>
<br>
<b>2. Waktu Putaran</b>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th rowspan="2">Setting Alat</th>
            <th colspan="6">Penunjukan Standar (Second)</th>
            <th rowspan="2">Toleransi</th>
        </tr>
        <tr>
            <th colspan="2">1</th>
            <th colspan="2">2</th>
            <th colspan="2">3</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>600</td>
            <td colspan="2">
                <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                    name="waktu_putaran_1" required>
            </td>
            <td colspan="2">
                <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                    name="waktu_putaran_2" required>
            </td>
            <td colspan="2">
                <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                    name="waktu_putaran_3" required>
            </td>
            <td>± 10% </td>
        </tr>
    </tbody>
</table>
