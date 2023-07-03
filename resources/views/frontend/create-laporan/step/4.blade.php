<div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
    <form id="form-4">
        @foreach ($nomenklatur_fungsi as $res)
            <div class="col mb-2">
                <label for="" style=" font-size: 12px;">{{ $res->field_parameter }}</label>
                <input type="hidden" name="pemeriksaan_fisik_fungsi-{{ $res->id }}" id="pemeriksaan_fisik_fungsi-{{ $res->id }}">
                <select class="form-control select2" id="pemeriksaan-alat{{ $res->id }}"
                    name="pemeriksaan_fisik_fungsi-{{ $res->id }}" required style="width: 100%;" required onchange="selectChange(this, '#pemeriksaan_fisik_fungsi-{{ $res->id }}')">
                    <option selected disabled value="">-- Pilih --</option>
                    <option value="baik">Baik</option>
                    <option value="tidak-baik">Tidak baik</option>
                </select>
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan pilih kondisi {{ $res->field_parameter }}
                </div>
            </div>
        @endforeach
    </form>
</div>
