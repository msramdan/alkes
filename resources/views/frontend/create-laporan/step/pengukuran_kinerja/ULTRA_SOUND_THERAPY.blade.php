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
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="row gap-2">
                <div class="col-12">
                    <label for="elektoda_tranduser" class="form-label">Elektoda Tranduser</label>
                    <div class="input-group">
                        <input type="number" step="0.01" class="form-control form-control-sm" id="elektoda_tranduser"
                            name="elektoda_tranduser">
                        <span class="input-group-text" style="width: 40px">MHz</span>
                    </div>
                </div>
                <div class="col-12">
                    <label for="luas_penampang_tranduser" class="form-label">Luas Penampang Tranduser</label>

                    <div class="input-group">
                        <input type="number" step="0.01" class="form-control form-control-sm"
                            id="luas_penampang_tranduser" name="luas_penampang_tranduser">
                        <span class="input-group-text" style="width: 40px">cm²</span>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Setting (Watt/cm²)</th>
                    <th colspan="6">Terukur Pada Standar (watt)</th>
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
                @php
                    $values = [0.3, 0.6, 0.9, 1.2, 1.5, 1.8, 2.1, 2.4, 2.7];
                @endphp

                @foreach ($values as $index => $value)
                    <tr>
                        <td>{{ $index + 3 }}</td>
                        <td>{{ number_format($value, 1) }}</td>
                        <td><input type="number" step="0.01" class="form-control form-control-sm text-center"
                                name="data_{{ $index + 3 }}_1"></td>
                        <td><input type="number" step="0.01" class="form-control form-control-sm text-center"
                                name="data_{{ $index + 3 }}_2"></td>
                        <td><input type="number" step="0.01" class="form-control form-control-sm text-center"
                                name="data_{{ $index + 3 }}_3"></td>
                        <td><input type="number" step="0.01" class="form-control form-control-sm text-center"
                                name="data_{{ $index + 3 }}_4"></td>
                        <td><input type="number" step="0.01" class="form-control form-control-sm text-center"
                                name="data_{{ $index + 3 }}_5"></td>
                        <td><input type="number" step="0.01" class="form-control form-control-sm text-center"
                                name="data_{{ $index + 3 }}_6"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="table-responsive mt-4">
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th rowspan="2">No</th>
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
                    <td>1</td>
                    <td>5 menit / 300 detik</td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm text-center"
                            name="time_1_1" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm text-center"
                            name="time_1_2" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm text-center"
                            name="time_1_3" value=""></td>
                    <td rowspan="2">10%</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>10 menit / 600 detik</td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm text-center"
                            name="time_2_1" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm text-center"
                            name="time_2_2" value=""></td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm text-center"
                            name="time_2_3" value=""></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
