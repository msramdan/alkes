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
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th rowspan="2">Setting Suhu</th>
                    <th rowspan="2">Titik Ukur</th>
                    <th colspan="6">Penunjukan Alat &deg;C</th>
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
                    <td rowspan="4">36&deg;C</td>
                    <td>T2A</td>
                    <td><input name="t2a_1" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2a_2" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2a_3" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2a_4" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2a_5" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2a_6" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td rowspan="4">&plusmn; 2&deg;C</td>
                </tr>
                <tr>
                    <td>T2B</td>
                    <td><input name="t2b_1" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2b_2" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2b_3" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2b_4" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2b_5" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2b_6" type="number" step="0.1" class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>T2C</td>
                    <td><input name="t2c_1" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2c_2" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2c_3" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2c_4" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2c_5" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2c_6" type="number" step="0.1" class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>T2D</td>
                    <td><input name="t2d_1" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2d_2" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2d_3" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2d_4" type="number" step="0.1" class="form-control form-control-sm"></td>
                    <td><input name="t2d_5" type="number" step="0.1" class="form-control form-control-sm">
                    </td>
                    <td><input name="t2d_6" type="number" step="0.1" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td colspan="9" class="text-center p-2" style="background-color: gray; color:white">
                        Tempatkan Skin Temperature sensor pada bagian atas tengah radiant baby adapter. <br>
                        Lalu catat data display skin temperature saat kestabilan suhu tercapat.
                    </td>
                </tr>
                <tr>
                    <td>35&deg;C</td>
                    <td>T2M</td>
                    <td><input name="t2m_1" type="number" step="0.1" class="form-control form-control-sm">
                    </td>
                    <td><input name="t2m_2" type="number" step="0.1" class="form-control form-control-sm">
                    </td>
                    <td><input name="t2a_3" type="number" step="0.1" class="form-control form-control-sm">
                    </td>
                    <td><input name="t2m_4" type="number" step="0.1" class="form-control form-control-sm">
                    </td>
                    <td><input name="t2m_5" type="number" step="0.1" class="form-control form-control-sm">
                    </td>
                    <td><input name="t2m_6" type="number" step="0.1" class="form-control form-control-sm">
                    </td>
                    <td>&plusmn; 0.5&deg;C</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
