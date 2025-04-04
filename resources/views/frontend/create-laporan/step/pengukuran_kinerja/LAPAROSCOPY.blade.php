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
    <h5 class="fw-bold">1. Electrical Surgery AnalyzerElectrical Surgery Analyzer</h5>
    <h6 class="fw-bold">Kalibrasi HF Leakage Current Mode Cutting</h6>
    <p>Atur Beban kalibrator pada 200 ohm, atur daya keluaran ESU pada 250 W. Tekan tombol cutting dan catat nilai HF
        Leakage Currentnya</p>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light text-center">
                <tr>
                    <th colspan="2">Setting</th>
                    <th colspan="3">Penunjukan Alat (mA)</th>
                    <th rowspan="2">Penyimpangan yang diijinkan</th>
                </tr>
                <tr>
                    <th rowspan="2">Ohm Kalibrator</th>
                    <th rowspan="2">Watt UUT</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <td>200</td>
                    <td>250</td>
                    <td><input name="cutting_current_1" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td><input name="cutting_current_2" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td><input name="cutting_current_3" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td>≤ 4.5 watt pada nilai 150 mA</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h6 class="fw-bold mt-4">Kalibrasi HF Leakage Current Mode Coagulating</h6>
    <p>Atur Beban kalibrator pada 80 ohm, atur daya keluaran ESU pada 250 W. Tekan tombol Coagulating dan catat nilai HF
        Leakage Currentnya</p>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light text-center">
                <tr>
                    <th colspan="2">Setting</th>
                    <th colspan="3">Penunjukan Alat (mA)</th>
                    <th rowspan="2">Penyimpangan yang diijinkan</th>
                </tr>
                <tr>
                    <th rowspan="2">Ohm Kalibrator</th>
                    <th rowspan="2">Watt UUT</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <td>200</td>
                    <td>80</td>
                    <td><input name="coagulating_current_1" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td><input name="coagulating_current_2" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td><input name="coagulating_current_3" type="number" step="0.01" required
                            class="form-control form-control-sm"></td>
                    <td>≤ 4.5 watt pada nilai 150 mA</td>
                </tr>
            </tbody>
        </table>
    </div>


    <h6 class="fw-bold mt-4">Pengujian Contact Quality Monitoring (REM)</h6>
    <div class="mb-3 d-flex flex-column gap-1">
        <div class="d-flex align-items-center">
            <label class="label-bold me-1 w-50">REM</label>
            <input name="rem_ohm" type="number" required class="form-control form-control-sm highlight w-25">
            <label class="ms-2">Ohm</label>
        </div>
    </div>

    <h6 class="fw-bold mt-4">Pengukuran Daya Energi Cutting</h6>
    <div class="mb-3 d-flex flex-column gap-1">
        <div class="d-flex align-items-center">
            <label class="label-bold me-1 w-50">Mode Keluaran Energi</label>
            <input name="cutting_energy_mode" type="number" required class="form-control form-control-sm highlight w-25">
            <label class="ms-2">Watt</label>
        </div>
        <div class="d-flex align-items-center">
            <label class="label-bold me-1 w-50">Load Impedance</label>
            <input name="cutting_load_impedance" type="number" required class="form-control form-control-sm highlight w-25">
            <label class="ms-2">Ohm</label>
        </div>
        <div class="d-flex align-items-center">
            <label class="label-bold me-1 w-50">Kemampuan Daya Energi Max</label>
            <input name="cutting_max_energy" type="number" required class="form-control form-control-sm highlight w-25">
            <label class="ms-2">Watt</label>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th rowspan="2" class="align-middle">Setting Alat (Watt)</th>
                    <th colspan="3">Penunjukan Standar (Watt)</th>
                    <th rowspan="2" class="align-middle">Penyimpangan yang diijinkan</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                </tr>
            </thead>
            <tbody>
                <tr class="highlight">
                    <td>10</td>
                    <td><input name="cutting_10w_1" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="cutting_10w_2" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="cutting_10w_3" type="number" required class="form-control form-control-sm" value=""></td>
                    <td rowspan="8" class="align-middle">± 5%</td>
                </tr>
                <tr class="highlight">
                    <td>20</td>
                    <td><input name="cutting_20w_1" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="cutting_20w_2" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="cutting_20w_3" type="number" required class="form-control form-control-sm" value=""></td>
                </tr>
                <tr class="highlight">
                    <td>30</td>
                    <td><input name="cutting_30w_1" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="cutting_30w_2" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="cutting_30w_3" type="number" required class="form-control form-control-sm" value=""></td>
                </tr>
                <tr class="highlight">
                    <td>40</td>
                    <td><input name="cutting_40w_1" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="cutting_40w_2" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="cutting_40w_3" type="number" required class="form-control form-control-sm" value=""></td>
                </tr>
                <tr class="highlight">
                    <td>50</td>
                    <td><input name="cutting_50w_1" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="cutting_50w_2" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="cutting_50w_3" type="number" required class="form-control form-control-sm" value=""></td>
                </tr>
                <tr class="highlight">
                    <td>60</td>
                    <td><input name="cutting_60w_1" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="cutting_60w_2" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="cutting_60w_3" type="number" required class="form-control form-control-sm" value=""></td>
                </tr>
                <tr class="highlight">
                    <td>70</td>
                    <td><input name="cutting_70w_1" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="cutting_70w_2" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="cutting_70w_3" type="number" required class="form-control form-control-sm" value=""></td>
                </tr>
                <tr class="highlight">
                    <td>80</td>
                    <td><input name="cutting_80w_1" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="cutting_80w_2" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="cutting_80w_3" type="number" required class="form-control form-control-sm" value=""></td>
                </tr>
            </tbody>
        </table>
    </div>


    <h6 class="fw-bold mt-4">Pengukuran Daya Energi Coagulating</h6>
    <div class="mb-3 d-flex flex-column gap-1">
        <div class="d-flex align-items-center">
            <label class="label-bold me-1 w-50">Mode Keluaran Energi</label>
            <input name="coagulating_energy_mode" type="number" required class="form-control form-control-sm highlight w-25">
            <label class="ms-2">Watt</label>
        </div>
        <div class="d-flex align-items-center">
            <label class="label-bold me-1 w-50">Load Impedance</label>
            <input name="coagulating_load_impedance" type="number" required class="form-control form-control-sm highlight w-25">
            <label class="ms-2">Ohm</label>
        </div>
        <div class="d-flex align-items-center">
            <label class="label-bold me-1 w-50">Kemampuan Daya Energi Max</label>
            <input name="coagulating_max_energy" type="number" required class="form-control form-control-sm highlight w-25">
            <label class="ms-2">Watt</label>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th rowspan="2" class="align-middle">Setting Alat (Watt)</th>
                    <th colspan="3">Penunjukan Standar (Watt)</th>
                    <th rowspan="2" class="align-middle">Penyimpangan yang diijinkan</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                </tr>
            </thead>
            <tbody>
                <tr class="highlight">
                    <td>10</td>
                    <td><input name="coagulating_10w_1" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="coagulating_10w_2" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="coagulating_10w_3" type="number" required class="form-control form-control-sm" value=""></td>
                    <td rowspan="8" class="align-middle">± 5%</td>
                </tr>
                <tr class="highlight">
                    <td>20</td>
                    <td><input name="coagulating_20w_1" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="coagulating_20w_2" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="coagulating_20w_3" type="number" required class="form-control form-control-sm" value=""></td>
                </tr>
                <tr class="highlight">
                    <td>30</td>
                    <td><input name="coagulating_30w_1" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="coagulating_30w_2" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="coagulating_30w_3" type="number" required class="form-control form-control-sm" value=""></td>
                </tr>
                <tr class="highlight">
                    <td>40</td>
                    <td><input name="coagulating_40w_1" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="coagulating_40w_2" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="coagulating_40w_3" type="number" required class="form-control form-control-sm" value=""></td>
                </tr>
                <tr class="highlight">
                    <td>50</td>
                    <td><input name="coagulating_50w_1" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="coagulating_50w_2" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="coagulating_50w_3" type="number" required class="form-control form-control-sm" value=""></td>
                </tr>
                <tr class="highlight">
                    <td>60</td>
                    <td><input name="coagulating_60w_1" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="coagulating_60w_2" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="coagulating_60w_3" type="number" required class="form-control form-control-sm" value=""></td>
                </tr>
                <tr class="highlight">
                    <td>70</td>
                    <td><input name="coagulating_70w_1" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="coagulating_70w_2" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="coagulating_70w_3" type="number" required class="form-control form-control-sm" value=""></td>
                </tr>
                <tr class="highlight">
                    <td>80</td>
                    <td><input name="coagulating_80w_1" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="coagulating_80w_2" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="coagulating_80w_3" type="number" required class="form-control form-control-sm" value=""></td>
                </tr>
            </tbody>
        </table>
    </div>

    <h5 class="fw-bold">2. Vaccum</h5>
    <div class="mb-3">
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="surgical_tracheal" type="checkbox" id="surgicalTracheal">
            <label class="form-check-label" for="surgicalTracheal">Surgical / Tracheal</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="low_volume_thoracic" type="checkbox" id="lowVolumeThoracic">
            <label class="form-check-label" for="lowVolumeThoracic">Low Volume Thoracic</label>
        </div>
    </div>

    <!-- Skala Vacuum -->
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th rowspan="2">Skala Vacuum <br> mmHg</th>
                    <th colspan="6">Penunjukan Standar</th>
                    <th rowspan="2">Penyimpangan yang diizinkan</th>
                </tr>
                <tr>
                    <th>Naik</th>
                    <th>Turun</th>
                    <th>Naik</th>
                    <th>Turun</th>
                    <th>Naik</th>
                    <th>Turun</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>-200</td>
                    <td><input name="vacuum_200_up_1" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_200_down_1" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_200_up_2" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_200_down_2" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_200_up_3" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_200_down_3" type="number" required class="form-control form-control-sm"></td>
                    <td rowspan="6" class="align-middle">± 10%</td>
                </tr>
                <tr>
                    <td>-300</td>
                    <td><input name="vacuum_300_up_1" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_300_down_1" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_300_up_2" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_300_down_2" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_300_up_3" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_300_down_3" type="number" required class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>-400</td>
                    <td><input name="vacuum_400_up_1" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_400_down_1" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_400_up_2" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_400_down_2" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_400_up_3" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_400_down_3" type="number" required class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>-500</td>
                    <td><input name="vacuum_500_up_1" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_500_down_1" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_500_up_2" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_500_down_2" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_500_up_3" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_500_down_3" type="number" required class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>-600</td>
                    <td><input name="vacuum_600_up_1" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_600_down_1" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_600_up_2" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_600_down_2" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_600_up_3" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_600_down_3" type="number" required class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>-700</td>
                    <td><input name="vacuum_700_up_1" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_700_down_1" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_700_up_2" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_700_down_2" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_700_up_3" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_700_down_3" type="number" required class="form-control form-control-sm"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Nilai Max -->
    <div class="d-flex align-items-center my-3">
        <label class="fw-bold me-2">Nilai Max :</label>
        <input name="vacuum_max_value" type="number" required class="form-control form-control-sm w-auto">
        <label class="ms-2">mmHg</label>
    </div>

    <!-- Skala Vacuum - MAX -->
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th rowspan="2">Skala Vacuum <br> (mmHg)</th>
                    <th colspan="3">Penunjukan Standar</th>
                    <th rowspan="2">Penyimpangan yang diizinkan</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>MAX</td>
                    <td><input name="vacuum_max_1" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_max_2" type="number" required class="form-control form-control-sm"></td>
                    <td><input name="vacuum_max_3" type="number" required class="form-control form-control-sm"></td>
                    <td class="align-middle">± 10%</td>
                </tr>
            </tbody>
        </table>
    </div>

    <p class="small text-muted">
        * Biasanya tertera pada label / di belakang alat suction dekat kabel power.<br>
        Untuk Low Volume Thoracic > 40 to 120 mmHg<br>
        Untuk Vakum Surgical / Tracheal > 300 mmHg
    </p>

    <!-- Intensitas Cahaya -->
    <h5 class="fw-bold">3. Intensitas Cahaya</h5>
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th rowspan="2">Setting Alat</th>
                    <th colspan="6">Penunjukan Standar (KLux)</th>
                    <th rowspan="2">Penyimpangan yang diizinkan</th>
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
                    <td><input name="light_intensity_1" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="light_intensity_2" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="light_intensity_3" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="light_intensity_4" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="light_intensity_5" type="number" required class="form-control form-control-sm" value=""></td>
                    <td><input name="light_intensity_6" type="number" required class="form-control form-control-sm" value=""></td>
                    <td class="align-middle">> 40 KLux</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
