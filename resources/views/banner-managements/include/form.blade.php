<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">

            @if (isset($bannerManagement))
                <img src="{{ Storage::url('public/img/banner_image/' . $bannerManagement->banner_image) }}" alt=""
                    style="width: 100%;margin-bottom:5px">
                <br>
            @endif
            <label for="posisi">{{ __('Banner Image') }}</label>
            <input type="file" name="banner_image" id="banner-image"
                class="form-control @error('banner_image') is-invalid @enderror"
                value="{{ isset($bannerManagement) ? $bannerManagement->banner_image : old('banner_image') }}"
                placeholder="{{ __('Banner Image') }}" @if (!isset($bannerManagement)) required @endif />
            <span class="text-danger">Saran ukuran gambar 1920x600 pixels</span>

            @error('banner_image')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="posisi">{{ __('Posisi') }}</label>
            <input type="number" name="posisi" id="posisi"
                class="form-control @error('posisi') is-invalid @enderror"
                value="{{ isset($bannerManagement) ? $bannerManagement->posisi : old('posisi') }}"
                placeholder="{{ __('Posisi') }}" required />

            @error('posisi')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>
