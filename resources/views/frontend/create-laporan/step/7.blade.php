<div id="step-7" class="tab-pane" role="tabpanel" aria-labelledby="step-7">
    @foreach ($nomeklatur_telaah_teknis as $res)
        <div class="col mb-2">
            <label for="" style=" font-size: 12px;">{{ $res->field_telaah_teknis }}</label>
            <select class="form-control select2" id="pemeriksaan-alat{{ $res->id }}"
                name="telaah_teknis-{{ $res->id }}" required style="width: 100%;" required>
                <option selected disabled value="">-- Pilih --</option>
                <option value="baik">Baik</option>
                <option value="tidak-baik">Tidak baik</option>
            </select>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a valid Condition.
            </div>
        </div>
    @endforeach
</div>
