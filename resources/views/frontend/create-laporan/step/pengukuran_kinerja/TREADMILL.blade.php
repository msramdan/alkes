<style>
    .table-responsive {
        overflow-x: auto;
        width: 100%;
    }

    /* Atur lebar input di tampilan mobile */
    @media (max-width: 768px) {
        .table input {
            min-width: 100px;
            /* Lebar minimal lebih besar */
            max-width: none;
            /* Hilangkan batas maksimum */
        }
    }
</style>

<div class="container bg-white p-4 rounded shadow">
    <!-- Tabel Kecepatan Trek -->
    <h5>Kecepatan Trek</h5>
    <div class="table-responsive mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Setting Kecepatan</th>
                    <th colspan="5">Terukur Pada Standar (m/minute)</th>
                    <th rowspan="2">Toleransi (±)</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Min</td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="kecepatan_min_1" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="kecepatan_min_2" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="kecepatan_min_3" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="kecepatan_min_4" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="kecepatan_min_5" value=""></td>
                    <td rowspan="3">10%</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Medium</td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="kecepatan_medium_1" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="kecepatan_medium_2" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="kecepatan_medium_3" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="kecepatan_medium_4" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="kecepatan_medium_5" value=""></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Max</td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="kecepatan_max_1" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="kecepatan_max_2" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="kecepatan_max_3" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="kecepatan_max_4" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="kecepatan_max_5" value=""></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Tabel Heart Rate (BPM) -->
    <h5>Heart Rate (BPM)</h5>
    <p>Setting Kecepatan kertas pada treadmill ke 25 mm/sec dan gunakan lead II</p>
    <div class="table-responsive mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">Terukur pada Standar</th>
                    <th colspan="5">Setting BPM di treadmill</th>
                    <th rowspan="2">Toleransi (±)</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="heart_rate_1_1" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="heart_rate_1_2" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="heart_rate_1_3" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="heart_rate_1_4" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="heart_rate_1_5" value=""></td>
                    <td rowspan="3">5%</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="heart_rate_2_1" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="heart_rate_2_2" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="heart_rate_2_3" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="heart_rate_2_4" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="heart_rate_2_5" value=""></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="heart_rate_3_1" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="heart_rate_3_2" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="heart_rate_3_3" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="heart_rate_3_4" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="heart_rate_3_5" value=""></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
