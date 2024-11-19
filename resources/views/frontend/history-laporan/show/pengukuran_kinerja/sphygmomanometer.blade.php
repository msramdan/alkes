@php
    $laporan = [
        "kebocoran_tekanan" => is_string(optional($data['kebocoran_tekanan'])->data_laporan)
            ? json_decode(optional($data['kebocoran_tekanan'])->data_laporan, true)
            : optional($data['kebocoran_tekanan'])->data_laporan,
        "laju_buang_cepat" => is_string(optional($data['laju_buang_cepat'])->data_laporan)
            ? json_decode(optional($data['laju_buang_cepat'])->data_laporan, true)
            : optional($data['laju_buang_cepat'])->data_laporan,
        "akurasi_tekanan" => is_string(optional($data['akurasi_tekanan'])->data_laporan)
            ? json_decode(optional($data['akurasi_tekanan'])->data_laporan, true)
            : optional($data['akurasi_tekanan'])->data_laporan,
    ];
@endphp

<b>A. CEK KEBOCORAN TEKANAN</b>
<div class="alert alert-secondary" role="alert">
    <span>Setting (mmHg) : 250</span>
    <p>Toleransi : < 15 mmHg/menit</p>
    <div class="col">
        <input type="number" step="0.000000001" id="kebocoran_tekanan" name="kebocoran_tekanan"
            class="form-control"
            required placeholder="Kebocoran (mmHg)"
            value="{{ $laporan['kebocoran_tekanan']['value'] ?? '' }}">
        <div class="valid-feedback">
            Okay!
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
            class="form-control"
            required placeholder="Waktu Buang Cepat dari 260 ke 15 mmHg (dtk)"
            value="{{ $laporan['laju_buang_cepat']['value'] ?? '' }}">
        <div class="valid-feedback">
            Okay!
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
            <th rowspan="3">Setting Alat <br> (mmHg)</th>
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
        @foreach ([0, 50, 100, 150, 200, 250] as $setting)
            <tr>
                <td>{{ $setting }}</td>
                @for ($i = 1; $i <= 3; $i++)
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001"
                            class="form-control"
                            name="percobaan{{ $setting }}_{{ $i }}_naik"
                            required
                            value="{{ $laporan['akurasi_tekanan']["percobaan{$setting}_{$i}_naik"] ?? '' }}">
                    </td>
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001"
                            class="form-control"
                            name="percobaan{{ $setting }}_{{ $i }}_turun"
                            required
                            value="{{ $laporan['akurasi_tekanan']["percobaan{$setting}_{$i}_turun"] ?? '' }}">
                    </td>
                @endfor
                @if ($loop->first)
                    <td rowspan="6">+ 3 mmHg</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
