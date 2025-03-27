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
    <!-- Spectral Irradiance -->
    <h5>1. Spectral Irradiance</h5>
    <div class="table-responsive mt-4">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th rowspan="2">Setting Alat</th>
                    <th colspan="3">Penunjukan Standar (µW/cm²)</th>
                    <th rowspan="2">Penyimpangan yang Diijinkan</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="4">MAX</td>
                    <td><input name="peak_a_1" required type="number" step="0.000000001"
                            class="form-control form-control-sm"></td>
                    <td><input name="peak_a_2" required type="number" step="0.000000001"
                            class="form-control form-control-sm"></td>
                    <td><input name="peak_a_3" required type="number" step="0.000000001"
                            class="form-control form-control-sm"></td>
                    <td rowspan="4">&gt; 40 µW/cm²</td>
                </tr>
                <tr>
                    <td><input name="peak_b_1" required type="number" step="0.000000001"
                            class="form-control form-control-sm"></td>
                    <td><input name="peak_b_2" required type="number" step="0.000000001"
                            class="form-control form-control-sm"></td>
                    <td><input name="peak_b_3" required type="number" step="0.000000001"
                            class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td><input name="peak_c_1" required type="number" step="0.000000001"
                            class="form-control form-control-sm"></td>
                    <td><input name="peak_c_2" required type="number" step="0.000000001"
                            class="form-control form-control-sm"></td>
                    <td><input name="peak_c_3" required type="number" step="0.000000001"
                            class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td><input name="peak_d_1" required type="number" step="0.000000001"
                            class="form-control form-control-sm"></td>
                    <td><input name="peak_d_2" required type="number" step="0.000000001"
                            class="form-control form-control-sm"></td>
                    <td><input name="peak_d_3" required type="number" step="0.000000001"
                            class="form-control form-control-sm"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Waktu Tunda -->
    <h5>3. Waktu Tunda</h5>
    <div class="table-responsive mt-4">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Setting Alat</th>
                    <th colspan="3">Penunjukan Standar (detik)</th>
                    <th>Penyimpangan yang Diijinkan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>300 detik</td>
                    <td><input name="delay_1" required type="number" step="0.000000001"
                            class="form-control form-control-sm"></td>
                    <td><input name="delay_2" required type="number" step="0.000000001"
                            class="form-control form-control-sm"></td>
                    <td><input name="delay_3" required type="number" step="0.000000001"
                            class="form-control form-control-sm"></td>
                    <td>± 10%</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
