<b>A. CEK KEBOCORAN TEKANAN</b>
<div class="alert alert-secondary" role="alert">
    <span>Setting (mmHg) : 250</span>
    <p>Toleransi : < 15 mmHg/menit</p>
            <div class="col">
                <input type="number" step="0.000000001" id="kebocoran_tekanan" name="kebocoran_tekanan"
                    class="form-control" required placeholder="Kebocoran (mmHg)">
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan input Cek Kebocoran Tekanan
                </div>
            </div>

</div>

<b>B. LAJU BUANG CEPAT</b>
<div class="alert alert-secondary" role="alert">
    <span>Setting (mmHg) : 260</span>
    <p>Toleransi : < 10 detik</p>
            <div class="col">
                <input type="number" step="0.000000001" id="laju_buang_cepat" name="laju_buang_cepat"
                    class="form-control" required
                    placeholder="Waktu Buang Cepat dari 260 ke 15 mmHg (dtk)">
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan input Laju Buang Cepat
                </div>
            </div>
</div>
<b>C. KALIBRASI AKURASI TEKANAN</b>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th rowspan="3">Setting Alat <br>
                (mmHg)</th>
            <th colspan="6">Terukur Pada Standar (mmHg) </th>
            <th rowspan="3">Toleransi</th>
        </tr>
        <tr>
            <th colspan="2">1</th>
            <th colspan="2">2</th>
            <th colspan="2">3</th>
        </tr>
        <tr>
            <th>Naik</th>
            <th>Turun</th>
            <th>Naik</th>
            <th>Turun</th>
            <th>Naik</th>
            <th>Turun</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>0</td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan0_1_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan0_1_turun" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan0_2_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan0_2_turun" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan0_3_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan0_3_turun" required>
            </td>
            <td rowspan="6"> + 3 mmHg</td>
        </tr>
        <tr>
            <td>50</td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan50_1_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan50_1_turun" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan50_2_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan50_2_turun" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan50_3_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan50_3_turun" required>
            </td>
        </tr>
        <tr>
            <td>100</td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan100_1_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan100_1_turun" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan100_2_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan100_2_turun" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan100_3_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan100_3_turun" required>
            </td>
        </tr>
        <tr>
            <td>150</td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan150_1_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan150_1_turun" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan150_2_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan150_2_turun" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan150_3_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan150_3_turun" required>
            </td>
        </tr>
        <tr>
            <td>200</td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan200_1_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan200_1_turun" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan200_2_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan200_2_turun" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan200_3_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan200_3_turun" required>
            </td>
        </tr>
        <tr>
            <td>250</td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan250_1_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan250_1_turun" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan250_2_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan250_2_turun" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan250_3_naik" required>
            </td>
            <td>
                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                    name="percobaan250_3_turun" required>
            </td>
        </tr>
    </tbody>
</table>
