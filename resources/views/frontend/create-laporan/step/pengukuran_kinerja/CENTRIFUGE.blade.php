<style>
    .table-responsive {
        overflow-x: auto;
        width: 100%;
    }

    @media (max-width: 768px) {
        .table input {
            min-width: 100px;
            max-width: none;
        }
    }
</style>

<div class="container bg-white p-4 rounded shadow">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">Setting (RPM)</th>
                    <th colspan="6">Terukur Pada Standar (RPM)</th>
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
                    <td>1000</td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_1000_1" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_1000_2" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_1000_3" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_1000_4" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_1000_5" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_1000_6" required>
                    </td>
                    <td rowspan="4">10%</td>
                </tr>
                <tr>
                    <td>2000</td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_2000_1" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_2000_2" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_2000_3" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_2000_4" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_2000_5" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_2000_6" required>
                    </td>
                </tr>
                <tr>
                    <td>3000</td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_3000_1" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_3000_2" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_3000_3" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_3000_4" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_3000_5" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_3000_6" required>
                    </td>
                </tr>
                <tr>
                    <td>4000</td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_4000_1" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_4000_2" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_4000_3" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_4000_4" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_4000_5" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="percobaan_4000_6"
                            required>
                    </td>
                </tr>
                <tr>
                    <td colspan="8" style="background-color: gray; color:white">Bila pada setting kecepatan tidak terdapat
                        / tertera nilai angka kecepatan putaran</td>
                </tr>
                <tr>
                    <td>MIN</td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="min_1" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="min_2" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="min_3" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="min_4" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="min_5" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="min_6" required>
                    </td>
                    <td rowspan="3">10% dari Nilai Max <br>
                        yang tertulis pada <br>
                        Spec Alat*</td>
                </tr>
                <tr>
                    <td>MEDIUM</td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="medium_1" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="medium_2" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="medium_3" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="medium_4" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="medium_5" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="medium_6" required>
                    </td>
                </tr>
                <tr>
                    <td>MAX</td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="max_1" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="max_2" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="max_3" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="max_4" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="max_5" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="max_6" required>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <span>* Biasanya tertera pada label / dibelakang alat centrifuge dekat kabel power</span>

    <div class="table-responsive">
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th rowspan="2">Setting (Menit / Detik)</th>
                    <th colspan="3">Terukur Pada Standar (Menit / Detik)</th>
                    <th rowspan="2">Toleransi</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>5 menit/ 300 detik</td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="second_1" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="second_2" required>
                    </td>
                    <td>
                        <input type="number" step="0.000000001" class="form-control form-control-sm" name="second_3" required>
                    </td>
                    <td>10%</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
