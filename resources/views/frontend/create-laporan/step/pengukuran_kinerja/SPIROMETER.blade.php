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
    <h6 class="fw-bold">Pengukuran Akurasi Volume Forced Vital Capacity (Liter)</h6>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Parameter dan Setting</th>
                    <th colspan="5" class="text-center">Terukur Pada Standar (mL/Jam)</th>
                    <th rowspan="2">Toleransi (+)</th>
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
                    <td>0.5 Liter</td>
                    <td><input name="fvc_0_5_1" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="fvc_0_5_2" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="fvc_0_5_3" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="fvc_0_5_4" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="fvc_0_5_5" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td rowspan="2">3% ATAU 50mL</td>
                </tr>
                <tr>
                    <td >2</td>
                    <td>3 Liter</td>
                    <td><input name="fvc_3_1" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="fvc_3_2" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="fvc_3_3" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="fvc_3_4" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="fvc_3_5" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                </tr>
            </tbody>
        </table>
    </div>

    <h6 class="fw-bold mt-4">Pengukuran Linearitas Forced Vital Capacity (Liter)</h6>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Parameter dan Setting</th>
                    <th colspan="5" class="text-center">Terukur Pada Standar (mL/Jam)</th>
                    <th rowspan="2">Toleransi (+)</th>
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
                    <td>0.4 Liter</td>
                    <td><input name="linearitas_0_4_1" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="linearitas_0_4_2" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="linearitas_0_4_3" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="linearitas_0_4_4" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="linearitas_0_4_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td rowspan="3">3%</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>0.5 Liter</td>
                    <td><input name="linearitas_0_5_1" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="linearitas_0_5_2" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="linearitas_0_5_3" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="linearitas_0_5_4" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="linearitas_0_5_5" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>0.6 Liter</td>
                    <td><input name="linearitas_0_6_1" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="linearitas_0_6_2" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="linearitas_0_6_3" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="linearitas_0_6_4" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                    <td><input name="linearitas_0_6_5" type="number" step="0.1"
                            class="form-control form-control-sm "></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
