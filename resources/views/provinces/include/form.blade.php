<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="provinsi">{{ __('Provinsi') }}</label>
            <input type="text" name="provinsi" id="provinsi"
                class="form-control @error('provinsi') is-invalid @enderror"
                value="{{ isset($province) ? $province->provinsi : old('provinsi') }}" placeholder="{{ __('Provinsi') }}"
                required />
            @error('provinsi')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="ibukotum">{{ __('Ibukota') }}</label>
            <input type="text" name="ibukota" id="ibukotum"
                class="form-control @error('ibukota') is-invalid @enderror"
                value="{{ isset($province) ? $province->ibukota : old('ibukota') }}" placeholder="{{ __('Ibukota') }}"
                required />
            @error('ibukota')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="p_bsni">{{ __('P_bsni') }}</label>
            <input type="text" name="p_bsni" id="p_bsni"
                class="form-control @error('p_bsni') is-invalid @enderror"
                value="{{ isset($province) ? $province->p_bsni : old('p_bsni') }}" placeholder="{{ __('p_bsni') }}"
                required />
            @error('p_bsni')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>
