<div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
    <form id="form-3">
        <div class="row mb-2">
            @if (is_show($nomenklatur_id, 'field_kondisi_lingkungan', 'Suhu', 'nomenklatur_kondisi_lingkungan') == 'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Suhu Awal (°C)</label>
                <input type="text" class="form-control" placeholder="" aria-label="First name" name="lingkungan_suhu_awal">
            </div>
            @endif

            @if (is_show($nomenklatur_id, 'field_kondisi_lingkungan', 'Suhu', 'nomenklatur_kondisi_lingkungan') == 'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Suhu Akhir (°C)</label>
                <input type="text" class="form-control" placeholder="" aria-label="Last name" name="lingkungan_suhu_akhir">
            </div>
            @endif
        </div>

        <div class="row mb-2">
            @if (is_show($nomenklatur_id, 'field_kondisi_lingkungan', 'Kelembaban Ruangan', 'nomenklatur_kondisi_lingkungan') == 'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Kelembapan Ruangan Awal (%)</label>
                <input type="text" class="form-control" placeholder="" aria-label="First name" name="lingkungan_kelembapan_ruangan_awal">
            </div>
            @endif

            @if (is_show($nomenklatur_id, 'field_kondisi_lingkungan', 'Kelembaban Ruangan', 'nomenklatur_kondisi_lingkungan') == 'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Kelembaban Ruangan Akhir (%)</label>
                <input type="text" class="form-control" placeholder="" aria-label="Last name" name="lingkungan_kelembapan_ruangan_akhir">
            </div>
            @endif
        </div>
    </form>
</div>
