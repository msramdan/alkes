<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama-ruangan">{{ __('Nama Ruangan') }}</label>
            <input type="text" name="nama_ruangan" id="nama-ruangan" class="form-control @error('nama_ruangan') is-invalid @enderror" value="{{ isset($room) ? $room->nama_ruangan : old('nama_ruangan') }}" placeholder="{{ __('Nama Ruangan') }}" required />
            @error('nama_ruangan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>