<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama-merek">{{ __('Nama Merek') }}</label>
            <input type="text" name="nama_merek" id="nama-merek" class="form-control @error('nama_merek') is-invalid @enderror" value="{{ isset($brand) ? $brand->nama_merek : old('nama_merek') }}" placeholder="{{ __('Nama Merek') }}" required />
            @error('nama_merek')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>