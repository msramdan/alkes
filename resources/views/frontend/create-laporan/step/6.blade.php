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
<div id="step-6" class="tab-pane" role="tabpanel" aria-labelledby="step-6">
    {{-- INFUSION PUMP --}}
    @if ($nomenklatur_id == 10)
        <b>A. OCCLUSION</b>
        <table class="table table-bordered" style="border-color: black">
            <thead>
                <tr>
                    <th>Setting Alat</th>
                    <th colspan="6">Penunjukan Standar (mbar) </th>
                    <th rowspan="2">Penyimpangan yang diijinkan</th>
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
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
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
                    <th rowspan="2">Penyimpangan yang diijinkan</th>
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
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td rowspan="4">± 10%</td>
                </tr>
                <tr>
                    <td>50</td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>100</td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>500</td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control" name="slope_1"
                            required>
                    </td>
                </tr>

            </tbody>
        </table>
    @else
    @endif
</div>
