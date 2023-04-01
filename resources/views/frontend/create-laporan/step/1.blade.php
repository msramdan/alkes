<div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
    <form id="form-1" class="" novalidate>
        <div class="col "
            style="display:  {{ is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Merk', 'nomenklatur_pendataan_administrasi') }}">
            <label for="" style=" font-size: 12px;">Merek</label>
            <input type="text" class="form-control" value="" id="state" placeholder="" name="merek"
                required="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a valid nomenklatur.
            </div>
        </div>

        <div class="col "
            style="display:  {{ is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Tipe / Model', 'nomenklatur_pendataan_administrasi') }}">
            <label for="" style=" font-size: 12px;">Tipe / Model</label>
            <input type="text" class="form-control" value="" id="state" placeholder="" name="merek"
                required="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a valid nomenklatur.
            </div>
        </div>

        <div class="col "
            style="display:  {{ is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Nomor Seri', 'nomenklatur_pendataan_administrasi') }}">
            <label for="" style=" font-size: 12px;">Nomor Seri</label>
            <input type="text" class="form-control" value="" id="state" placeholder="" name="merek"
                required="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a valid nomenklatur.
            </div>
        </div>

        <div class="col"
            style="display:  {{ is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Resolusi', 'nomenklatur_pendataan_administrasi') }}">
            <label for="" style=" font-size: 12px;">Resolusi</label>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="">
                <span class="input-group-text" id=""
                    style="width: 70px">{{ cek_satuan($nomenklatur_id, 'Resolusi') }}</span>
            </div>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a valid nomenklatur.
            </div>
        </div>
        <div class="col"
            style="display:  {{ is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Rentang Ukur', 'nomenklatur_pendataan_administrasi') }}">
            <label for="" style=" font-size: 12px;">Rentang Ukur</label>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="">
                <span class="input-group-text" style="width: 70px"
                    id="">{{ cek_satuan($nomenklatur_id, 'Rentang Ukur') }}</span>
            </div>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a valid nomenklatur.
            </div>
        </div>

        <div class="col"
            style="display:  {{ is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Kapasitas', 'nomenklatur_pendataan_administrasi') }}">
            <label for="" style=" font-size: 12px;">Kapasitas</label>
            <div class="input-group">
                <input type="text" class="form-control" aria-describedby="">
                <span class="input-group-text" id=""
                    style="width: 70px">{{ cek_satuan($nomenklatur_id, 'Kapasitas') }}</span>
            </div>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a valid nomenklatur.
            </div>
        </div>

        <div class="col "
            style="display:  {{ is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Faskes Pemilik', 'nomenklatur_pendataan_administrasi') }}">
            <label for="" style=" font-size: 12px;">Faskes Pemilik</label>
            <input type="text" class="form-control" value="" id="state" placeholder="" name="merek"
                required="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a valid nomenklatur.
            </div>
        </div>


        <div class="col "
            style="display:  {{ is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Ruangan', 'nomenklatur_pendataan_administrasi') }}">
            <label for="" style=" font-size: 12px;">Ruangan</label>
            <input type="text" class="form-control" value="" id="state" placeholder="" name="merek"
                required="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a valid nomenklatur.
            </div>
        </div>

        <div class="col "
            style="display:  {{ is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Tempat Kalibrasi', 'nomenklatur_pendataan_administrasi') }}">
            <label for="" style=" font-size: 12px;">Tempat Kalibrasi</label>
            <input type="text" class="form-control" value="" id="state" placeholder="" name="merek"
                required="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a valid nomenklatur.
            </div>
        </div>

        <div class="col "
            style="display:  {{ is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Tanggal Penerimaan', 'nomenklatur_pendataan_administrasi') }}">
            <label for="" style=" font-size: 12px;">Tanggal Penerimaan</label>
            <input type="date" class="form-control" value="" id="state" placeholder="" name="merek"
                required="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a valid nomenklatur.
            </div>
        </div>

        <div class="col "
            style="display:  {{ is_show($nomenklatur_id, 'field_pendataan_administrasi', 'TTanggal Kalibrasi', 'nomenklatur_pendataan_administrasi') }}">
            <label for="" style=" font-size: 12px;">Tanggal Kalibrasi</label>
            <input type="date" class="form-control" value="" id="state" placeholder="" name="merek"
                required="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a valid nomenklatur.
            </div>
        </div>

        <div class="col "
            style="display:  {{ is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Channel IDA', 'nomenklatur_pendataan_administrasi') }}">
            <label for="" style=" font-size: 12px;">Channel IDA</label>
            <input type="text" class="form-control" value="" id="state" placeholder="" name="merek"
                required="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a valid nomenklatur.
            </div>
        </div>
        <div class="col "
            style="display:  {{ is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Jenis Timbangan', 'nomenklatur_pendataan_administrasi') }}">
            <label for="" style=" font-size: 12px;">Jenis Timbangan</label>
            <input type="text" class="form-control" value="" id="state" placeholder="" name="merek"
                required="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a valid nomenklatur.
            </div>
        </div>
    </form>
</div>
