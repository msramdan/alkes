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
    <h6 class="fw-bold">Suhu Udara</h6>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">Setting Alat <br> Suhu (°C) </th>
                    <th colspan="6" class="text-center">Penunjukan Standar (D)</th>
                    <th rowspan="2">Penyimpangan yang diijinkan</th>
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
                    <td rowspan="2">22</td>
                    <td>
                        <input name="suhu_1" type="number" step="0.1" required
                            class="form-control form-control-sm " value="">
                    </td>
                    <td>
                        <input name="suhu_2" type="number" step="0.1" required
                            class="form-control form-control-sm " value="">
                    </td>
                    <td>
                        <input name="suhu_3" type="number" step="0.1" required
                            class="form-control form-control-sm " value="">
                    </td>
                    <td>
                        <input name="suhu_4" type="number" step="0.1" required
                            class="form-control form-control-sm " value="">
                    </td>
                    <td>
                        <input name="suhu_5" type="number" step="0.1" required
                            class="form-control form-control-sm " value="">
                    </td>
                    <td>
                        <input name="suhu_6" type="number" step="0.1" required
                            class="form-control form-control-sm " value="">
                    </td>
                    <td rowspan="2">± 1°C</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h6 class="fw-bold mt-4">Kelembaban Udara</h6>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">Setting Alat <br> (%) </th>
                    <th colspan="6" class="text-center">Penunjukan Standar (D)</th>
                    <th rowspan="2">Penyimpangan yang diijinkan</th>
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
                    <td rowspan="2">50</td>
                    <td>
                        <input name="kelembaban_1" type="number" step="0.1" required
                            class="form-control form-control-sm " value="">
                    </td>
                    <td>
                        <input name="kelembaban_2" type="number" step="0.1" required
                            class="form-control form-control-sm " value="">
                    </td>
                    <td>
                        <input name="kelembaban_3" type="number" step="0.1" required
                            class="form-control form-control-sm " value="">
                    </td>
                    <td>
                        <input name="kelembaban_4" type="number" step="0.1" required
                            class="form-control form-control-sm " value="">
                    </td>
                    <td>
                        <input name="kelembaban_5" type="number" step="0.1" required
                            class="form-control form-control-sm " value="">
                    </td>
                    <td>
                        <input name="kelembaban_6" type="number" step="0.1" required
                            class="form-control form-control-sm " value="">
                    </td>
                    <td rowspan="2">± 10%</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
