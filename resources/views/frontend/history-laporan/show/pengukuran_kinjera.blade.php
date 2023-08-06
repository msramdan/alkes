@extends('layouts.master-frontend')
@section('title', 'View Detail Laporan')
@section('content')
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
    <div class="page-content-wrapper">
        <div class="py-3">
            <div class="container">
                <b>A. OCCLUSION</b>
                    <table class="table table-bordered table-sm" style="border-color: black;overflow-x: scroll">
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
                                    <input style="width: 100px" type="number" value="{{ $laporan_occlusion->percobaan_1 }}"
                                        step="0.000000001" class="form-control" readonly name="percobaan_1">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" value="{{ $laporan_occlusion->percobaan_2 }}"
                                        step="0.000000001" class="form-control" readonly name="percobaan_2">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" value="{{ $laporan_occlusion->percobaan_3 }}"
                                        step="0.000000001" class="form-control" readonly name="percobaan_3">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" value="{{ $laporan_occlusion->percobaan_4 }}"
                                        step="0.000000001" class="form-control" readonly name="percobaan_4">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" value="{{ $laporan_occlusion->percobaan_5 }}"
                                        step="0.000000001" class="form-control" readonly name="percobaan_5">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" value="{{ $laporan_occlusion->percobaan_6 }}"
                                        step="0.000000001" class="form-control" readonly name="percobaan_6">
                                </td>
                                <td>≤ 1379 mbar (20 psi)</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <b>B. FLOW RATE</b>
                    <table class="table table-bordered table-sm" style="border-color: black">
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
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan1_1 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan1_2 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan1_3 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan1_4 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan1_5 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan1_6 }}">
                                </td>
                                <td rowspan="4">± 10%</td>
                            </tr>
                            <tr>
                                <td>50</td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan2_1 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan2_2 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan2_3 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan2_4 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan2_5 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan2_6 }}">
                                </td>
                            </tr>
                            <tr>
                                <td>100</td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan3_1 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan3_2 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan3_3 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan3_4 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan3_5 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan3_6 }}">
                                </td>
                            </tr>
                            <tr>
                                <td>500</td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan4_1 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan4_2 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan4_3 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan4_4 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan4_5 }}">
                                </td>
                                <td>
                                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                                        name="" readonly value="{{ $flow_rate->percobaan4_6 }}">
                                </td>
                            </tr>

                        </tbody>
                    </table>
            </div>
        </div>
    </div>
@endsection
