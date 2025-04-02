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
    <p>Posisikan jarak antara lampu phototherapy dan standar 40 cm</p>

    <h6 class="fw-bold">1. SPECTRAL IRRADIANCE</h6>

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th rowspan="2" class="align-middle">Setting Alat</th>
                    <th colspan="6">Penunjukan Standar (<span>&#181;W/cm<sup>2</sup>/nm</span>)</th>
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
                    <td>MAX</td>
                    <td><input name="spectral_irradiance_1" type="number" step="0.01" required class="form-control form-control-sm"></td>
                    <td><input name="spectral_irradiance_2" type="number" step="0.01" required class="form-control form-control-sm"></td>
                    <td><input name="spectral_irradiance_3" type="number" step="0.01" required class="form-control form-control-sm"></td>
                    <td><input name="spectral_irradiance_4" type="number" step="0.01" required class="form-control form-control-sm"></td>
                    <td><input name="spectral_irradiance_5" type="number" step="0.01" required class="form-control form-control-sm"></td>
                    <td><input name="spectral_irradiance_6" type="number" step="0.01" required class="form-control form-control-sm"></td>
                    <td>&gt; 4 &#181;W/cm<sup>2</sup>/nm</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
