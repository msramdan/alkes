<style>
    .table-responsive {
        overflow-x: auto;
        width: 100%;
    }

    /* Atur lebar input di tampilan mobile */
    @media (max-width: 768px) {
        .table input {
            min-width: 100px;
            max-width: none;
        }
    }

</style>
<div class="container bg-white p-4 rounded shadow">
    <h6 class="fw-bold">TEKANAN TRACTION CONTROL ACCURACY</h6>
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th rowspan="2" class="align-middle">Setting Alat (Lbs)</th>
                    <th colspan="6">Penunjukan Standar (Lbs)</th>
                    <th rowspan="2" class="align-middle">Penyimpangan yang diijinkan</th>
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
                    <td class=""><input name="traction_1" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_1_1" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_1_2" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_1_3" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_1_4" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_1_5" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_1_6" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td rowspan="3" class="align-middle">±10%</td>
                </tr>
                <tr>
                    <td class=""><input name="traction_2" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_2_1" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_2_2" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_2_3" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_2_4" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_2_5" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_2_6" type="number" step="0.01" required class="form-control form-control-sm "></td>
                </tr>
                <tr>
                    <td class=""><input name="traction_3" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_3_1" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_3_2" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_3_3" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_3_4" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_3_5" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td><input name="traction_3_6" type="number" step="0.01" required class="form-control form-control-sm "></td>
                </tr>
            </tbody>
        </table>
    </div>

    <h6 class="fw-bold mt-4">TIMER</h6>
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>NO</th>
                    <th>Parameter dan Setting</th>
                    <th>Terukur pada Standar</th>
                    <th>Penyimpangan yang diijinkan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Waktu Therapy 5 Menit (300 detik)</td>
                    <td><input name="timer_1" type="number" step="0.01" required class="form-control form-control-sm "></td>
                    <td rowspan="3" class="align-middle">±10%</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Waktu Hold 20 detik</td>
                    <td><input name="timer_2" type="number" step="0.01" required class="form-control form-control-sm "></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Waktu Rest 20 detik</td>
                    <td><input name="timer_3" type="number" step="0.01" required class="form-control form-control-sm "></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
