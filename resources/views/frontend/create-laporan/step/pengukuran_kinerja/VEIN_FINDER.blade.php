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
    <h5 class="mb-3">1. SPECTRAL IRRADIANCE</h5>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" class="align-middle">Setting Alat</th>
                    <th colspan="6">Penunjukan Standar (W/m²)</th>
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
                    <td><strong>MAX</strong></td>
                    <td>
                        <input type="number" step="0.01" class="form-control form-control-sm text-center" name="spectral_irradiance_1" value="">
                    </td>
                    <td>
                        <input type="number" step="0.01" class="form-control form-control-sm text-center" name="spectral_irradiance_2" value="">
                    </td>
                    <td>
                        <input type="number" step="0.01" class="form-control form-control-sm text-center" name="spectral_irradiance_3" value="">
                    </td>
                    <td>
                        <input type="number" step="0.01" class="form-control form-control-sm text-center" name="spectral_irradiance_4" value="">
                    </td>
                    <td>
                        <input type="number" step="0.01" class="form-control form-control-sm text-center" name="spectral_irradiance_5" value="">
                    </td>
                    <td>
                        <input type="number" step="0.01" class="form-control form-control-sm text-center" name="spectral_irradiance_6" value="">
                    </td>
                    <td>> 4 W/m²</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
