<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama-faske">{{ __('Nama Faskes') }}</label>
            <input type="text" name="nama_faskes" id="nama-faske"
                class="form-control @error('nama_faskes') is-invalid @enderror"
                value="{{ isset($faske) ? $faske->nama_faskes : old('nama_faskes') }}"
                placeholder="{{ __('Nama Faskes') }}" required />
            @error('nama_faskes')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jenis-faskes-id">{{ __('Jenis Faske') }}</label>
            <select class="form-select @error('jenis_faskes_id') is-invalid @enderror" name="jenis_faskes_id"
                id="jenis-faskes-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select jenis faske') }} --</option>

                @foreach ($jenisFaskes as $jenisFaske)
                    <option value="{{ $jenisFaske->id }}"
                        {{ isset($faske) && $faske->jenis_faskes_id == $jenisFaske->id ? 'selected' : (old('jenis_faskes_id') == $jenisFaske->id ? 'selected' : '') }}>
                        {{ $jenisFaske->nama_jenis_faskes }}
                    </option>
                @endforeach
            </select>
            @error('jenis_faskes_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="provinsi-id">{{ __('Province') }}</label>
            <select class="form-select @error('provinsi_id') is-invalid @enderror" name="provinsi_id" id="provinsi-id"
                class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select province') }} --</option>
                @foreach ($provinces as $province)
                    <option value="{{ $province->id }}"
                        {{ isset($faske) && $faske->provinsi_id == $province->id ? 'selected' : (old('provinsi_id') == $province->id ? 'selected' : '') }}>
                        {{ $province->provinsi }}
                    </option>
                @endforeach
            </select>
            @error('provinsi_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="kabkot-id">{{ __('Kabkot') }}</label>
            <select class="form-select @error('kabkot_id') is-invalid @enderror" name="kabkot_id" id="kabkot-id"
                class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select kabkot') }} --</option>
                @if (isset($faske))
                    @foreach ($kabkot as $kabkot)
                        <option value="{{ $kabkot->id }}"
                            {{ isset($faske) && $faske->kabkot_id == $kabkot->id ? 'selected' : (old('kabkot_id') == $kabkot->id ? 'selected' : '') }}>
                            {{ $kabkot->kabupaten_kota }}
                        </option>
                    @endforeach
                @endif
            </select>

            @error('kabkot_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="kecamatan-id">{{ __('Kecamatan') }}</label>
            <select class="form-select @error('kecamatan_id') is-invalid @enderror" name="kecamatan_id"
                id="kecamatan-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select kecamatan') }} --</option>
                @if (isset($faske))
                    @foreach ($kecamatan as $kecamatan)
                        <option value="{{ $kecamatan->id }}"
                            {{ isset($faske) && $faske->kecamatan_id == $kecamatan->id ? 'selected' : (old('kecamatan_id') == $kecamatan->id ? 'selected' : '') }}>
                            {{ $kecamatan->kecamatan }}
                        </option>
                    @endforeach
                @endif
            </select>
            @error('kecamatan_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="kelurahan-id">{{ __('Kelurahan') }}</label>
            <select class="form-select @error('kelurahan_id') is-invalid @enderror" name="kelurahan_id"
                id="kelurahan-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select kelurahan') }} --</option>
                @if (isset($faske))
                    @foreach ($kelurahan as $kelurahan)
                        <option value="{{ $kelurahan->id }}"
                            {{ isset($faske) && $faske->kelurahan_id == $kelurahan->id ? 'selected' : (old('kelurahan_id') == $kelurahan->id ? 'selected' : '') }}>
                            {{ $kelurahan->kelurahan }}
                        </option>
                    @endforeach
                @endif
            </select>
            @error('kelurahan_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="zip-kode">{{ __('Zip Kode') }}</label>
            <input readonly type="text" name="zip_kode" id="zip-kode"
                class="form-control @error('zip_kode') is-invalid @enderror"
                value="{{ isset($faske) ? $faske->zip_kode : old('zip_kode') }}" placeholder="{{ __('Zip Kode') }}"
                required />
            @error('zip_kode')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="alamat">{{ __('Alamat') }}</label>
            <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror"
                placeholder="{{ __('Alamat') }}" required>{{ isset($faske) ? $faske->alamat : old('alamat') }}</textarea>
            @error('alamat')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>
