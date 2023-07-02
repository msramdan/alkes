<div id="step-8" class="tab-pane" role="tabpanel" aria-labelledby="step-8">
    <form id="form-8">
        <div class="col mb-2">
            <label for="" style=" font-size: 12px;">Berdasarkan hasil pengujian
                dan/ atau hasil kalibrasi, alat
                ini dinyatakan </label> <br>
            <input type="hidden" name="kesimpulan_telaah_teknis" id="kesimpulan_select_telaah_teknis">
            <select class="form-control select2" id="kesimpulan-telaah-teknis"
                name="kesimpulan_select_telaah_teknis" required style="width: 100%;"
                onchange="selectChange(this, '#kesimpulan_select_telaah_teknis')">
                <option selected disabled value="">-- Pilih --</option>
                <option value="baik">Baik</option>
                <option value="tidak-baik">Tidak baik</option>
            </select>
            <div class="valid-feedback">
                Okay !
            </div>
            <div class="invalid-feedback">
                Please select a valid Condition.
            </div>
        </div>
    </form>
    <div class="col mb-2">
        <label for="" style=" font-size: 12px;">Catatan</label> <br>
        <textarea name="catatan_kesimpulan_telaah_teknis" class="form-control" id="" required></textarea>
        <div class="valid-feedback">
            Okay !
        </div>
        <div class="invalid-feedback">
            Please select a valid Condition.
        </div>
    </div>
</div>
