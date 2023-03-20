<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama-jenis-faske">{{ __('Nama Jenis Faskes') }}</label>
            <input type="text" name="nama_jenis_faskes" id="nama-jenis-faske" class="form-control @error('nama_jenis_faskes') is-invalid @enderror" value="{{ isset($jenisFaske) ? $jenisFaske->nama_jenis_faskes : old('nama_jenis_faskes') }}" placeholder="{{ __('Nama Jenis Faskes') }}" required />
            @error('nama_jenis_faskes')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>