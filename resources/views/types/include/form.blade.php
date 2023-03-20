<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="jenis-alat">{{ __('Jenis Alat') }}</label>
            <input type="text" name="jenis_alat" id="jenis-alat" class="form-control @error('jenis_alat') is-invalid @enderror" value="{{ isset($type) ? $type->jenis_alat : old('jenis_alat') }}" placeholder="{{ __('Jenis Alat') }}" required />
            @error('jenis_alat')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>