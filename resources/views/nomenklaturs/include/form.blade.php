<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama-nomenklatur">{{ __('Nama Nomenklatur') }}</label>
            <input type="text" name="nama_nomenklatur" id="nama-nomenklatur" class="form-control @error('nama_nomenklatur') is-invalid @enderror" value="{{ isset($nomenklatur) ? $nomenklatur->nama_nomenklatur : old('nama_nomenklatur') }}" placeholder="{{ __('Nama Nomenklatur') }}" required />
            @error('nama_nomenklatur')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>