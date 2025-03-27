<style>

    .table-responsive {
        overflow-x: auto;
        /* Mencegah tabel terlalu besar */
        width: 100%;
        /* Agar sesuai layar */
    }


    .table input {
        min-width: 80px;
        /* Ukuran minimal */
        width: 100%;
        /* Menyesuaikan kolom */
        max-width: 100px;
        /* Batas maksimum */
    }
</style>
<div class="container bg-white p-4 rounded shadow">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th rowspan="2" class="align-middle text-center">No</th>
                    <th rowspan="2" class="align-middle text-center">Setting (RPM)</th>
                    <th colspan="6" class="text-center">Terukur Pada Standar (RPM)</th>
                    <th rowspan="2" class="align-middle text-center">Toleransi</th>
                </tr>
                <tr>
                    <th class="text-center">1</th>
                    <th class="text-center">2</th>
                    <th class="text-center">3</th>
                    <th class="text-center">4</th>
                    <th class="text-center">5</th>
                    <th class="text-center">6</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">50%</td>
                    <td><input name="rpm_50_1" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td><input name="rpm_50_2" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td><input name="rpm_50_3" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td><input name="rpm_50_4" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td><input name="rpm_50_5" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td><input name="rpm_50_6" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td rowspan="2" class="text-center">10%</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td class="text-center">Max</td>
                    <td><input name="rpm_max_1" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td><input name="rpm_max_2" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td><input name="rpm_max_3" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td><input name="rpm_max_4" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td><input name="rpm_max_5" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td><input name="rpm_max_6" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td colspan="9" class="text-muted">*Biasanya tertera pada label / di belakang alat centrifuge
                        dekat kabel power</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="table-responsive mt-4">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th rowspan="2" class="align-middle text-center">No</th>
                    <th rowspan="2" class="align-middle text-center">Setting (Menit / Detik)</th>
                    <th colspan="3" class="text-center">Terukur Pada Standar (Menit / Detik)</th>
                    <th rowspan="2" class="align-middle text-center">Toleransi</th>
                </tr>
                <tr>
                    <th class="text-center">1</th>
                    <th class="text-center">2</th>
                    <th class="text-center">3</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">5 menit / 300 detik</td>
                    <td><input name="time_5min_1" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td><input name="time_5min_2" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td><input name="time_5min_3" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td class="text-center">10%</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
