<style>
    th,
    td {
        text-align: center;
        vertical-align: middle;
    }

    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
</style>
<div id="step-{{$count_nomenklatur_keselamatan_listrik > 0 ? '6' : '5'}}" class="tab-pane" role="tabpanel" aria-labelledby="step-{{$count_nomenklatur_keselamatan_listrik > 0 ? '6' : '5'}}">
    <form id="form-{{$count_nomenklatur_keselamatan_listrik > 0 ? '6' : '5'}}">
        {{-- INFUSION PUMP & SYRINGE PUMP --}}
        @if ($nomenklatur_id == 10 || $nomenklatur_id == 11)
            <b>A. OCCLUSION</b>
            <table class="table table-bordered" style="border-color: black">
                <thead>
                    <tr>
                        <th>Setting Alat</th>
                        <th colspan="6">Penunjukan Standar (mbar) </th>
                        <th rowspan="2">Toleransi</th>
                    </tr>
                    <tr>
                        <th>(mL/h)</th>
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
                        <td>100</td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                                name="percobaan_1" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                                name="percobaan_2" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                                name="percobaan_3" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                                name="percobaan_4" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                                name="percobaan_5" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                                name="percobaan_6" required>
                        </td>
                        <td>≤ 1379 mbar (20 psi)</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <b>B. FLOW RATE</b>
            <table class="table table-bordered" style="border-color: black">
                <thead>
                    <tr>
                        <th>Setting Alat</th>
                        <th colspan="6">Penunjukan Standar (mbar) </th>
                        <th rowspan="2">Toleransi</th>
                    </tr>
                    <tr>
                        <th>(ml/hr)</th>
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
                        <td>10</td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan1_1" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan1_2" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan1_3" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan1_4" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan1_5" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan1_6" required>
                        </td>
                        <td rowspan="4">± 10%</td>
                    </tr>
                    <tr>
                        <td>50</td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan2_1" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan2_2" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan2_3" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan2_4" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan2_5" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan2_6" required>
                        </td>
                    </tr>
                    <tr>
                        <td>100</td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan3_1" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan3_2" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan3_3" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan3_4" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan3_5" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan3_6" required>
                        </td>
                    </tr>
                    @if ($nomenklatur_id == 10)
                        <tr>
                            <td>500</td>
                            <td>
                                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                    name="percobaan4_1" required>
                            </td>
                            <td>
                                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                    name="percobaan4_2" required>
                            </td>
                            <td>
                                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                    name="percobaan4_3" required>
                            </td>
                            <td>
                                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                    name="percobaan4_4" required>
                            </td>
                            <td>
                                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                    name="percobaan4_5" required>
                            </td>
                            <td>
                                <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                    name="percobaan4_6" required>
                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>
        @elseif($nomenklatur_id == 9)
            <b>A. CEK KEBOCORAN TEKANAN</b>
            <div class="alert alert-secondary" role="alert">
                <span>Setting (mmHg) : 250</span>
                <p>Toleransi : < 15 mmHg/menit</p>
                        <div class="col">
                            <input type="number" step="0.000000001" id="kebocoran_tekanan" name="kebocoran_tekanan"
                                class="form-control" required placeholder="Kebocoran (mmHg)">
                            <div class="valid-feedback">
                                Okay !
                            </div>
                            <div class="invalid-feedback">
                                Silahkan input Cek Kebocoran Tekanan
                            </div>
                        </div>

            </div>

            <b>B. LAJU BUANG CEPAT</b>
            <div class="alert alert-secondary" role="alert">
                <span>Setting (mmHg) : 260</span>
                <p>Toleransi : < 10 detik</p>
                        <div class="col">
                            <input type="number" step="0.000000001" id="laju_buang_cepat" name="laju_buang_cepat"
                                class="form-control" required
                                placeholder="Waktu Buang Cepat dari 260 ke 15 mmHg (dtk)">
                            <div class="valid-feedback">
                                Okay !
                            </div>
                            <div class="invalid-feedback">
                                Silahkan input Laju Buang Cepat
                            </div>
                        </div>
            </div>
            <b>C. KALIBRASI AKURASI TEKANAN</b>
            <table class="table table-bordered" style="border-color: black">
                <thead>
                    <tr>
                        <th rowspan="3">Setting Alat <br>
                            (mmHg)</th>
                        <th colspan="6">Terukur Pada Standar (mmHg) </th>
                        <th rowspan="3">Toleransi</th>
                    </tr>
                    <tr>
                        <th colspan="2">1</th>
                        <th colspan="2">2</th>
                        <th colspan="2">3</th>
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
                        <td>0</td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan0_1_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan0_1_turun" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan0_2_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan0_2_turun" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan0_3_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan0_3_turun" required>
                        </td>
                        <td rowspan="6"> + 3 mmHg</td>
                    </tr>
                    <tr>
                        <td>50</td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan50_1_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan50_1_turun" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan50_2_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan50_2_turun" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan50_3_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan50_3_turun" required>
                        </td>
                    </tr>
                    <tr>
                        <td>100</td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan100_1_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan100_1_turun" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan100_2_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan100_2_turun" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan100_3_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan100_3_turun" required>
                        </td>
                    </tr>
                    <tr>
                        <td>150</td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan150_1_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan150_1_turun" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan150_2_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan150_2_turun" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan150_3_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan150_3_turun" required>
                        </td>
                    </tr>
                    <tr>
                        <td>200</td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan200_1_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan200_1_turun" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan200_2_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan200_2_turun" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan200_3_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan200_3_turun" required>
                        </td>
                    </tr>
                    <tr>
                        <td>250</td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan250_1_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan250_1_turun" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan250_2_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan250_2_turun" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan250_3_naik" required>
                        </td>
                        <td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                name="percobaan250_3_turun" required>
                        </td>
                    </tr>
                </tbody>
            </table>
        @elseif($nomenklatur_id == 12)

        @endif
    </form>
</div>
