<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="provinsi-id">{{ __('Province') }}</label>
            <select class="form-select @error('provinsi_id') is-invalid @enderror" name="provinsi_id" id="provinsi-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select province') }} --</option>
                
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}" {{ isset($kabkot) && $kabkot->provinsi_id == $province->id ? 'selected' : (old('provinsi_id') == $province->id ? 'selected' : '') }}>
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
            <label for="kabupaten-kotum">{{ __('Kabupaten Kota') }}</label>
            <input type="text" name="kabupaten_kota" id="kabupaten-kotum" class="form-control @error('kabupaten_kota') is-invalid @enderror" value="{{ isset($kabkot) ? $kabkot->kabupaten_kota : old('kabupaten_kota') }}" placeholder="{{ __('Kabupaten Kota') }}" required />
            @error('kabupaten_kota')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="ibukotum">{{ __('Ibukota') }}</label>
            <input type="text" name="ibukota" id="ibukotum" class="form-control @error('ibukota') is-invalid @enderror" value="{{ isset($kabkot) ? $kabkot->ibukota : old('ibukota') }}" placeholder="{{ __('Ibukota') }}" required />
            @error('ibukota')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="k-bsni">{{ __('K Bsni') }}</label>
            <input type="text" name="k_bsni" id="k-bsni" class="form-control @error('k_bsni') is-invalid @enderror" value="{{ isset($kabkot) ? $kabkot->k_bsni : old('k_bsni') }}" placeholder="{{ __('K Bsni') }}" required />
            @error('k_bsni')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>