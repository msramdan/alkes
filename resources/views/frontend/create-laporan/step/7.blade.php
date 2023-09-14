<div id="step-{{$count_nomenklatur_keselamatan_listrik > 0 ? '7' : '6'}}" class="tab-pane" role="tabpanel" aria-labelledby="step-{{$count_nomenklatur_keselamatan_listrik > 0 ? '7' : '6'}}">
    <form id="form-{{$count_nomenklatur_keselamatan_listrik > 0 ? '7' : '6'}}">
        @foreach ($nomeklatur_telaah_teknis as $res)
        <div class="col mb-2">
            <label for="" style=" font-size: 12px;">{{ $res->field_telaah_teknis }}</label>
            <input type="hidden" name="telaah_teknis-{{ $res->id }}" id="telaah_teknis-{{ $res->id }}">
            <select class="form-control select2" id="telaah_teknis-{{ $res->id }}"
                name="telaah_select-teknis-{{ $res->id }}" required style="width: 100%;" required onchange="selectChange(this, '#telaah_teknis-{{ $res->id }}')">
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
        <div class="col mb-2">
            <label for="" style=" font-size: 12px;">Catatan</label> <br>
            <textarea name="catatan_kesimpulan_telaah_teknis" rows="5" class="form-control" id="catatan_kesimpulan_telaah_teknis" required></textarea>
            <div class="valid-feedback">
                Okay !
            </div>
            <div class="invalid-feedback">
                Please select a valid Condition.
            </div>
        </div>
    </form>
</div>
