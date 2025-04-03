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
    <h4>Heart Rate</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Setting Standar (BPM)</th>
                <th colspan="6">Penunjukan Alat (BPM)</th>
                <th>Penyimpangan yang diijinkan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>30</td>
                <td><input name="hr_30_1" type="number" step="0.01" required class="form-control form-control-sm"></td>
                <td><input name="hr_30_2" type="number" step="0.01" required class="form-control form-control-sm"></td>
                <td><input name="hr_30_3" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_30_4" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_30_5" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_30_6" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td rowspan="4">± 5%</td>
            </tr>
            <tr>
                <td>2</td>
                <td>60</td>
                <td><input name="hr_60_1" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_60_2" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_60_3" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_60_4" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_60_5" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_60_6" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>120</td>
                <td><input name="hr_120_1" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_120_2" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_120_3" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_120_4" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_120_5" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_120_6" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>180</td>
                <td><input name="hr_180_1" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_180_2" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_180_3" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_180_4" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_180_5" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
                <td><input name="hr_180_6" type="number" step="0.01" required class="form-control form-control-sm">
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Respiration Rate -->
    <h4>Respiration Rate</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Setting Standar (BrPM)</th>
                <th colspan="6">Penunjukan Alat (BrPM)</th>
                <th>Penyimpangan yang diijinkan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>15</td>
                <td><input name="rr_15_1" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_15_2" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_15_3" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_15_4" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_15_5" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_15_6" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td rowspan="4">± 10%</td>
            </tr>
            <tr>
                <td>2</td>
                <td>30</td>
                <td><input name="rr_30_1" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_30_2" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_30_3" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_30_4" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_30_5" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_30_6" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
            </tr>
            <tr>
                <td>3</td>
                <td>60</td>
                <td><input name="rr_60_1" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_60_2" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_60_3" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_60_4" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_60_5" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_60_6" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
            </tr>
            <tr>
                <td>4</td>
                <td>120</td>
                <td><input name="rr_120_1" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_120_2" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_120_3" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_120_4" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_120_5" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="rr_120_6" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
            </tr>
        </tbody>
    </table>

    <!-- Saturasi Oksigen -->
    <h4>Saturasi Oksigen</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Setting Standar (%O2)</th>
                <th colspan="6">Penunjukan Alat (%O2)</th>
                <th>Penyimpangan yang diijinkan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Normal (98)</td>
                <td><input name="spo2_normal_1" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_normal_2" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_normal_3" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_normal_4" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_normal_5" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_normal_6" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td rowspan="4">± 1 %O2</td>
            </tr>
            <tr>
                <td>Obese (93)</td>
                <td><input name="spo2_obese_1" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_obese_2" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_obese_3" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_obese_4" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_obese_5" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_obese_6" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
            </tr>
            <tr>
                <td>Geriat (92)</td>
                <td><input name="spo2_geriat_1" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_geriat_2" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_geriat_3" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_geriat_4" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_geriat_5" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_geriat_6" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
            </tr>
            <tr>
                <td>Tech (85)</td>
                <td><input name="spo2_tech_1" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_tech_2" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_tech_3" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_tech_4" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_tech_5" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
                <td><input name="spo2_tech_6" type="number" step="0.01" required
                        class="form-control form-control-sm"></td>
            </tr>
        </tbody>
    </table>

    <h4>Blood Pressure ( Dewasa / Adult / Pediatric )</h4>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Setting Standar (mmHg)</th>
                    <th colspan="6">Penunjukan Alat (mmHg)</th>
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
                <!-- Row 1 -->
                <tr>
                    <td rowspan="3">1</td>
                    <td>Systole: 60</td>
                    <td><input name="bp_adult_1_systole_1" type="number" step="0.1"
                            class="form-control form-control-sm" value=""></td>
                    <td><input name="bp_adult_1_systole_2" type="number" step="0.1"
                            class="form-control form-control-sm" value=""></td>
                    <td><input name="bp_adult_1_systole_3" type="number" step="0.1"
                            class="form-control form-control-sm" value=""></td>
                    <td><input name="bp_adult_1_systole_4" type="number" step="0.1"
                            class="form-control form-control-sm" value=""></td>
                    <td><input name="bp_adult_1_systole_5" type="number" step="0.1"
                            class="form-control form-control-sm" value=""></td>
                    <td><input name="bp_adult_1_systole_6" type="number" step="0.1"
                            class="form-control form-control-sm" value=""></td>
                    <td rowspan="18">± 5 mmHg</td>
                </tr>
                <tr>
                    <td>MAP: 40</td>
                    <td><input name="bp_adult_1_map_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_1_map_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_1_map_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_1_map_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_1_map_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_1_map_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>Diastole: 30</td>
                    <td><input name="bp_adult_1_diastole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_1_diastole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_1_diastole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_1_diastole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_1_diastole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_1_diastole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>

                <!-- Row 2 -->
                <tr>
                    <td rowspan="3">2</td>
                    <td>Systole: 80</td>
                    <td><input name="bp_adult_2_systole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_2_systole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_2_systole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_2_systole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_2_systole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_2_systole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>

                </tr>
                <tr>
                    <td>MAP: 60</td>
                    <td><input name="bp_adult_2_map_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_2_map_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_2_map_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_2_map_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_2_map_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_2_map_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>Diastole: 50</td>
                    <td><input name="bp_adult_2_diastole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_2_diastole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_2_diastole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_2_diastole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_2_diastole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_2_diastole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>

                <!-- Row 3 -->
                <tr>
                    <td rowspan="3">3</td>
                    <td>Systole: 100</td>
                    <td><input name="bp_adult_3_systole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_3_systole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_3_systole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_3_systole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_3_systole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_3_systole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>MAP: 76</td>
                    <td><input name="bp_adult_3_map_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_3_map_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_3_map_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_3_map_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_3_map_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_3_map_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>Diastole: 65</td>
                    <td><input name="bp_adult_3_diastole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_3_diastole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_3_diastole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_3_diastole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_3_diastole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_3_diastole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>

                <!-- Row 4 -->
                <tr>
                    <td rowspan="3">4</td>
                    <td>Systole: 120</td>
                    <td><input name="bp_adult_4_systole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_4_systole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_4_systole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_4_systole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_4_systole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_4_systole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>

                </tr>
                <tr>
                    <td>MAP: 93</td>
                    <td><input name="bp_adult_4_map_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_4_map_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_4_map_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_4_map_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_4_map_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_4_map_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>Diastole: 80</td>
                    <td><input name="bp_adult_4_diastole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_4_diastole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_4_diastole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_4_diastole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_4_diastole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_4_diastole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>

                <!-- Row 5 -->
                <tr>
                    <td rowspan="3">5</td>
                    <td>Systole: 150</td>
                    <td><input name="bp_adult_5_systole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_5_systole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_5_systole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_5_systole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_5_systole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_5_systole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>

                </tr>
                <tr>
                    <td>MAP: 116</td>
                    <td><input name="bp_adult_5_map_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_5_map_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_5_map_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_5_map_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_5_map_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_5_map_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>Diastole: 100</td>
                    <td><input name="bp_adult_5_diastole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_5_diastole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_5_diastole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_5_diastole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_5_diastole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_5_diastole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>

                <!-- Row 6 -->
                <tr>
                    <td rowspan="3">6</td>
                    <td>Systole: 200</td>
                    <td><input name="bp_adult_6_systole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_6_systole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_6_systole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_6_systole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_6_systole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_6_systole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>

                </tr>
                <tr>
                    <td>MAP: 166</td>
                    <td><input name="bp_adult_6_map_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_6_map_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_6_map_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_6_map_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_6_map_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_6_map_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>Diastole: 150</td>
                    <td><input name="bp_adult_6_diastole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_6_diastole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_6_diastole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_6_diastole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_6_diastole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_adult_6_diastole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <h4 class="mt-4">Blood Pressure ( Bayi / Neonatal )</h4>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Setting Standar (mmHg)</th>
                    <th colspan="6">Penunjukan Alat (mmHg)</th>
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
                <!-- Row 1 -->
                <tr>
                    <td rowspan="3">1</td>
                    <td>Systole: 35</td>
                    <td><input name="bp_neonatal_1_systole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_1_systole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_1_systole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_1_systole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_1_systole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_1_systole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                            <td rowspan="12">± 5 mmHg</td>


                </tr>
                <tr>
                    <td>MAP: 22</td>
                    <td><input name="bp_neonatal_1_map_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_1_map_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_1_map_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_1_map_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_1_map_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_1_map_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>Diastole: 15</td>
                    <td><input name="bp_neonatal_1_diastole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_1_diastole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_1_diastole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_1_diastole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_1_diastole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_1_diastole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>

                <!-- Row 2 -->
                <tr>
                    <td rowspan="3">2</td>
                    <td>Systole: 60</td>
                    <td><input name="bp_neonatal_2_systole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_2_systole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_2_systole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_2_systole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_2_systole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_2_systole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>MAP: 40</td>
                    <td><input name="bp_neonatal_2_map_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_2_map_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_2_map_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_2_map_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_2_map_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_2_map_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>Diastole: 30</td>
                    <td><input name="bp_neonatal_2_diastole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_2_diastole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_2_diastole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_2_diastole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_2_diastole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_2_diastole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>

                <!-- Row 3 -->
                <tr>
                    <td rowspan="3">3</td>
                    <td>Systole: 80</td>
                    <td><input name="bp_neonatal_3_systole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_3_systole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_3_systole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_3_systole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_3_systole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_3_systole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>

                </tr>
                <tr>
                    <td>MAP: 60</td>
                    <td><input name="bp_neonatal_3_map_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_3_map_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_3_map_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_3_map_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_3_map_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_3_map_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>Diastole: 50</td>
                    <td><input name="bp_neonatal_3_diastole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_3_diastole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_3_diastole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_3_diastole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_3_diastole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_3_diastole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>

                <!-- Row 4 -->
                <tr>
                    <td rowspan="3">4</td>
                    <td>Systole: 100</td>
                    <td><input name="bp_neonatal_4_systole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_4_systole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_4_systole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_4_systole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_4_systole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_4_systole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>

                </tr>
                <tr>
                    <td>MAP: 80</td>
                    <td><input name="bp_neonatal_4_map_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_4_map_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_4_map_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_4_map_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_4_map_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_4_map_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>Diastole: 70</td>
                    <td><input name="bp_neonatal_4_diastole_1" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_4_diastole_2" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_4_diastole_3" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_4_diastole_4" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_4_diastole_5" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                    <td><input name="bp_neonatal_4_diastole_6" type="number" step="0.1"
                            class="form-control form-control-sm"></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
