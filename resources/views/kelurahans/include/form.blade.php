<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="kecamatan-id">{{ __('Kecamatan') }}</label>
            <select class="form-select @error('kecamatan_id') is-invalid @enderror" name="kecamatan_id" id="kecamatan-id"
                class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select kecamatan') }} --</option>

                @foreach ($kecamatans as $kecamatan)
                    <option value="{{ $kecamatan->id }}"
                        {{ isset($kelurahan) && $kelurahan->kecamatan_id == $kecamatan->id ? 'selected' : (old('kecamatan_id') == $kecamatan->id ? 'selected' : '') }}>
                        {{ $kecamatan->kecamatan }}
                    </option>
                @endforeach
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
            <label for="kelurahan">{{ __('Kelurahan') }}</label>
            <input type="text" name="kelurahan" id="kelurahan"
                class="form-control @error('kelurahan') is-invalid @enderror"
                value="{{ isset($kelurahan) ? $kelurahan->kelurahan : old('kelurahan') }}"
                placeholder="{{ __('Kelurahan') }}" required />
            @error('kelurahan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="kd-po">{{ __('Kd Pos') }}</label>
            <input type="text" name="kd_pos" id="kd-po"
                class="form-control @error('kd_pos') is-invalid @enderror"
                value="{{ isset($kelurahan) ? $kelurahan->kd_pos : old('kd_pos') }}" placeholder="{{ __('Kd Pos') }}"
                required />
            @error('kd_pos')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>
