<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="banner-iamge">{{ __('Banner Iamge') }}</label>
            <input type="text" name="banner_iamge" id="banner-iamge" class="form-control @error('banner_iamge') is-invalid @enderror" value="{{ isset($bannerManagement) ? $bannerManagement->banner_iamge : old('banner_iamge') }}" placeholder="{{ __('Banner Iamge') }}" required />
            @error('banner_iamge')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="posisi">{{ __('Posisi') }}</label>
            <input type="number" name="posisi" id="posisi" class="form-control @error('posisi') is-invalid @enderror" value="{{ isset($bannerManagement) ? $bannerManagement->posisi : old('posisi') }}" placeholder="{{ __('Posisi') }}" required />
            @error('posisi')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>