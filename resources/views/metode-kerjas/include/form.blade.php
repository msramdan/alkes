<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="file">{{ __('File') }}</label>
            <input type="text" name="file" id="file" class="form-control @error('file') is-invalid @enderror" value="{{ isset($metodeKerja) ? $metodeKerja->file : old('file') }}" placeholder="{{ __('File') }}" required />
            @error('file')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>