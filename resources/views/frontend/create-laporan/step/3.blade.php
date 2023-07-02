<div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
    <form id="form-3">
        <div class="row mb-2">
            @if (is_show($nomenklatur_id, 'field_kondisi_lingkungan', 'Suhu', 'nomenklatur_kondisi_lingkungan') == 'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Suhu Awal (°C)</label>
                <input required type="number" step="0.01" class="form-control" placeholder=""  name="lingkungan_suhu_awal">
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan input Suhu Awal
                </div>
            </div>
            @endif

            @if (is_show($nomenklatur_id, 'field_kondisi_lingkungan', 'Suhu', 'nomenklatur_kondisi_lingkungan') == 'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Suhu Akhir (°C)</label>
                <input required type="number" step="0.01" class="form-control" placeholder=""  name="lingkungan_suhu_akhir">
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan input Suhu Akhir
                </div>
            </div>
            @endif
        </div>

        <div class="row mb-2">
            @if (is_show($nomenklatur_id, 'field_kondisi_lingkungan', 'Kelembaban Ruangan', 'nomenklatur_kondisi_lingkungan') == 'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Kelembapan Ruangan Awal (%)</label>
                <input required type="number" step="0.01" class="form-control" placeholder=""  name="lingkungan_kelembapan_ruangan_awal">
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan input Kelembapan Ruangan Awal
                </div>
            </div>
            @endif

            @if (is_show($nomenklatur_id, 'field_kondisi_lingkungan', 'Kelembaban Ruangan', 'nomenklatur_kondisi_lingkungan') == 'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Kelembaban Ruangan Akhir (%)</label>
                <input required type="number" step="0.01" class="form-control" placeholder=""  name="lingkungan_kelembapan_ruangan_akhir">
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan input Kelembaban Ruangan Akhir
                </div>
            </div>
            @endif
        </div>
    </form>
</div>
