<div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
    <form id="form-1">
        @if (is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Merk', 'nomenklatur_pendataan_administrasi') == 'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Merek</label>
                <input type="text" class="form-control" value="" id="administrasi_merk" placeholder=""
                    name="administrasi_merk" required>
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan input Merek
                </div>
            </div>
        @endif

        @if (is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Tipe / Model', 'nomenklatur_pendataan_administrasi') ==
                'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Tipe / Model</label>
                <input type="text" class="form-control" value="" id="administrasi_tipe-model" placeholder=""
                    name="administrasi_tipe-model" required>
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan input Tipe / Model
                </div>
            </div>
        @endif

        @if (is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Nomor Seri', 'nomenklatur_pendataan_administrasi') ==
                'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Nomor Seri</label>
                <input type="text" class="form-control" value="" id="administrasi_nomor-seri" placeholder=""
                    name="administrasi_nomor-seri" required>
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan input Nomor Seri
                </div>
            </div>
        @endif

        @if (is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Resolusi', 'nomenklatur_pendataan_administrasi') ==
                'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Resolusi</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="" id="administrasi_resolusi"
                        name="administrasi_resolusi" value="" required>
                    <span class="input-group-text" id=""
                        style="width: 70px">{{ cek_satuan($nomenklatur_id, 'Resolusi') }}</span>
                    <div class="valid-feedback">
                        Okay !
                    </div>
                    <div class="invalid-feedback">
                        Silahkan input Resolusi
                    </div>
                </div>
            </div>
        @endif

        @if (is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Rentang Ukur', 'nomenklatur_pendataan_administrasi') ==
                'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Rentang Ukur</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="" id="administrasi_rentang-ukur"
                        name="administrasi_rentang-ukur" value="" required>
                    <span class="input-group-text" style="width: 70px"
                        id="">{{ cek_satuan($nomenklatur_id, 'Rentang Ukur') }}</span>
                    <div class="valid-feedback">
                        Okay !
                    </div>
                    <div class="invalid-feedback">
                        Silahkan input Rentang Ukur
                    </div>
                </div>
            </div>
        @endif

        @if (is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Kapasitas', 'nomenklatur_pendataan_administrasi') ==
                'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Kapasitas</label>
                <div class="input-group">
                    <input type="text" class="form-control" value="" id="administrasi_kapasitas"
                        name="administrasi_kapasitas" aria-describedby="" required>
                    <span class="input-group-text" id=""
                        style="width: 70px">{{ cek_satuan($nomenklatur_id, 'Kapasitas') }}</span>
                    <div class="valid-feedback">
                        Okay !
                    </div>
                    <div class="invalid-feedback">
                        Silahkan input Kapasitas
                    </div>
                </div>
            </div>
        @endif

        @if (is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Faskes Pemilik', 'nomenklatur_pendataan_administrasi') ==
                'show')
            <div class="col">
                <input type="hidden" name="administrasi_faskes-pemilik" id="administrasi_faskes-pemilik">
                <label for="" style=" font-size: 12px;">Faskes Pemilik</label>
                <select class="form-control select2" id="faskes" name="administrasi_faskes-pemilik-select" required
                    style="width: 100%;" required>
                    <option selected disabled value="">--
                        Pilih --</option>
                    @foreach ($faskes as $row)
                        <option value="{{ $row->id }}">{{ $row->nama_faskes }}
                        </option>
                    @endforeach
                </select>
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan pilih Faskes Pemilik
                </div>
            </div>
        @endif

        @if (is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Ruangan', 'nomenklatur_pendataan_administrasi') == 'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Ruangan</label>
                <input type="text" class="form-control" value="" id="" placeholder=""
                    name="administrasi_ruangan" required>
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan input Ruangan
                </div>
            </div>
        @endif

        @if (is_show(
                $nomenklatur_id,
                'field_pendataan_administrasi',
                'Tempat Kalibrasi',
                'nomenklatur_pendataan_administrasi') == 'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Tempat Kalibrasi</label>
                <input type="text" class="form-control" value="" id="" placeholder=""
                    name="administrasi_tempat-kalibrasi" required>
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan input Tempat Kalibrasi
                </div>
            </div>
        @endif

        @if (is_show(
                $nomenklatur_id,
                'field_pendataan_administrasi',
                'Tanggal Penerimaan',
                'nomenklatur_pendataan_administrasi') == 'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Tanggal Penerimaan</label>
                <input type="date" class="form-control" value="" id="" placeholder=""
                    name="administrasi_tanggal-penerimaan" required>
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan input Tanggal Penerimaan
                </div>
            </div>
        @endif

        @if (is_show(
                $nomenklatur_id,
                'field_pendataan_administrasi',
                'Tanggal Kalibrasi',
                'nomenklatur_pendataan_administrasi') == 'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Tanggal Kalibrasi</label>
                <input type="date" class="form-control" value="" id="" placeholder=""
                    name="administrasi_tanggal-kalibrasi" required>
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan input Tanggal Kalibrasi
                </div>
            </div>
        @endif

        @if (is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Channel IDA', 'nomenklatur_pendataan_administrasi') ==
                'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Channel IDA <span style="color: red">( Input Channel 1 / 2 )</span></label>
                <input type="number" class="form-control" value="" id="" placeholder="" required
                    name="administrasi_channel-ida" min="1" max="2">
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan input Channel IDA
                </div>
            </div>
        @endif

        @if (is_show($nomenklatur_id, 'field_pendataan_administrasi', 'Jenis Timbangan', 'nomenklatur_pendataan_administrasi') ==
                'show')
            <div class="col">
                <label for="" style=" font-size: 12px;">Jenis Timbangan</label>
                <input type="text" class="form-control" value="" id="" placeholder="" required
                    name="administrasi_jenis-timbangan">
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan input Jenis Timbangan
                </div>
            </div>
        @endif
    </form>
</div>
