<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama-vendor">{{ __('Nama Vendor') }}</label>
            <input type="text" name="nama_vendor" id="nama-vendor" class="form-control @error('nama_vendor') is-invalid @enderror" value="{{ isset($vendor) ? $vendor->nama_vendor : old('nama_vendor') }}" placeholder="{{ __('Nama Vendor') }}" required />
            @error('nama_vendor')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="no-telpon">{{ __('No Telpon') }}</label>
            <input type="text" name="no_telpon" id="no-telpon" class="form-control @error('no_telpon') is-invalid @enderror" value="{{ isset($vendor) ? $vendor->no_telpon : old('no_telpon') }}" placeholder="{{ __('No Telpon') }}" required />
            @error('no_telpon')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ isset($vendor) ? $vendor->email : old('email') }}" placeholder="{{ __('Email') }}" required />
            @error('email')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="alamat">{{ __('Alamat') }}</label>
            <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="{{ __('Alamat') }}" required>{{ isset($vendor) ? $vendor->alamat : old('alamat') }}</textarea>
            @error('alamat')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>