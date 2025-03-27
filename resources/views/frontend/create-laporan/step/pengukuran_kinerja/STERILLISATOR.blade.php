<div class="container bg-white p-4 rounded shadow">
    <h5 class="text-uppercase fw-bold">Gambarkan Posisi Sensor</h5>
    <div class="row mb-3">
        <!-- Input di kiri (Lebar 8 dari 12) -->
        <div class="col-md-6">
            <div class="row gap-2">
                <div class="col-12">
                    <label for="panjang" class="form-label">Panjang</label>
                    <input type="number" class="form-control form-control-sm" id="panjang" name="panjang" placeholder="m">
                </div>
                <div class="col-12">
                    <label for="lebar" class="form-label">Lebar</label>
                    <input type="number" class="form-control form-control-sm" id="lebar" name="lebar" placeholder="m">
                </div>
                <div class="col-12">
                    <label for="tinggi" class="form-label">Tinggi</label>
                    <input type="number" class="form-control form-control-sm" id="tinggi" name="tinggi" placeholder="m">
                </div>
            </div>
        </div>

        <!-- Gambar di kanan (Lebar 4 dari 12) -->
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
            <img src="{{ asset('kubus.png') }}" alt="Posisi Sensor" class="img-fluid" style="max-height: 200px;">
        </div>
    </div>


    <h5 class="text-uppercase fw-bold">F. Pengukuran Kinerja</h5>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th rowspan="2" class="align-middle">Posisi Sensor</th>
                    <th colspan="6">Penunjukan Alat</th>
                    <th rowspan="3" class="align-middle">Penyimpangan yang Diizinkan</th>
                </tr>
                <tr>
                    <th colspan="2">1</th>
                    <th colspan="2">2</th>
                    <th colspan="2">3</th>
                </tr>
                <tr>
                    <th>Setting Suhu: 100°C</th>
                    <th>Min</th>
                    <th>Max</th>
                    <th>Min</th>
                    <th>Max</th>
                    <th>Min</th>
                    <th>Max</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 12; $i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td><input name="sensor_{{ $i }}_1_min" type="number" step="0.000000001"
                                class="form-control form-control-sm" style="width: 100px" required></td>
                        <td><input name="sensor_{{ $i }}_1_max" type="number" step="0.000000001"
                                class="form-control form-control-sm" style="width: 100px" required></td>
                        <td><input name="sensor_{{ $i }}_2_min" type="number" step="0.000000001"
                                class="form-control form-control-sm" style="width: 100px" required></td>
                        <td><input name="sensor_{{ $i }}_2_max" type="number" step="0.000000001"
                                class="form-control form-control-sm" style="width: 100px" required></td>
                        <td><input name="sensor_{{ $i }}_3_min" type="number" step="0.000000001"
                                class="form-control form-control-sm" style="width: 100px" required></td>
                        <td><input name="sensor_{{ $i }}_3_max" type="number" step="0.000000001"
                                class="form-control form-control-sm" style="width: 100px" required></td>
                        @if ($i == 1)
                            <td rowspan="12" class="align-middle text-center">Variasi Total ≤ Ro</td>
                        @endif
                    </tr>
                @endfor
            </tbody>
        </table>

    </div>

</div>
