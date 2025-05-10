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
    <h5 class="mb-3">Akurasi Waktu</h5>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th rowspan="2" class="align-middle text-center">Setting Alat<br>(Detik)</th>
                    <th colspan="3" class="text-center">Penunjukan Standar</th>
                    <th rowspan="2" class="align-middle text-center">Penyimpangan yang diijinkan</th>
                </tr>
                <tr>
                    <th class="text-center">1</th>
                    <th class="text-center">2</th>
                    <th class="text-center">3</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $durasi = [300, 600, 900];
                @endphp

                @foreach ($durasi as $index => $detik)
                <tr>
                    <td class="text-center"><strong>{{ $detik }}</strong></td>
                    @for ($i = 1; $i <= 3; $i++)
                        <td>
                            <input type="number" step="0.01"
                                   class="form-control form-control-sm text-center"
                                   name="timer_{{ $detik }}_{{ $i }}" value="">
                        </td>
                    @endfor
                    @if ($index === 0)
                        <td rowspan="3" class="align-middle text-center">± 10 %</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
