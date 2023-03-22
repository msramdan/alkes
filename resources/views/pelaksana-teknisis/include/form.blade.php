<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama">{{ __('Nama') }}</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                value="{{ isset($pelaksanaTeknisi) ? $pelaksanaTeknisi->nama : old('nama') }}"
                placeholder="{{ __('Nama') }}" required />
            @error('nama')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jenis-kelamin">{{ __('Jenis Kelamin') }}</label>
            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
                id="jenis-kelamin" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select jenis kelamin') }} --</option>
                <option value="Laki Laki"
                    {{ isset($pelaksanaTeknisi) && $pelaksanaTeknisi->jenis_kelamin == 'Laki Laki' ? 'selected' : (old('jenis_kelamin') == 'Laki Laki' ? 'selected' : '') }}>
                    {{ __('Laki Laki') }}</option>
                <option value="Perempuan"
                    {{ isset($pelaksanaTeknisi) && $pelaksanaTeknisi->jenis_kelamin == 'Perempuan' ? 'selected' : (old('jenis_kelamin') == 'Perempuan' ? 'selected' : '') }}>
                    {{ __('Perempuan') }}</option>
            </select>
            @error('jenis_kelamin')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="no-telpon">{{ __('No Telpon') }}</label>
            <input type="text" name="no_telpon" id="no-telpon"
                class="form-control @error('no_telpon') is-invalid @enderror"
                value="{{ isset($pelaksanaTeknisi) ? $pelaksanaTeknisi->no_telpon : old('no_telpon') }}"
                placeholder="{{ __('No Telpon') }}" required />
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
            <input type="text" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ isset($pelaksanaTeknisi) ? $pelaksanaTeknisi->email : old('email') }}"
                placeholder="{{ __('Email') }}" required />
            @error('email')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tempat-lahir">{{ __('Tempat Lahir') }}</label>
            <input type="text" name="tempat_lahir" id="tempat-lahir"
                class="form-control @error('tempat_lahir') is-invalid @enderror"
                value="{{ isset($pelaksanaTeknisi) ? $pelaksanaTeknisi->tempat_lahir : old('tempat_lahir') }}"
                placeholder="{{ __('Tempat Lahir') }}" required />
            @error('tempat_lahir')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tangal-lahir">{{ __('Tangal Lahir') }}</label>
            <input type="date" name="tangal_lahir" id="tangal-lahir"
                class="form-control @error('tangal_lahir') is-invalid @enderror"
                value="{{ isset($pelaksanaTeknisi) && $pelaksanaTeknisi->tangal_lahir ? $pelaksanaTeknisi->tangal_lahir->format('Y-m-d') : old('tangal_lahir') }}"
                placeholder="{{ __('Tangal Lahir') }}" required />
            @error('tangal_lahir')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="photo">{{ __('Photo') }}</label>
            <input type="file" name="photo" id="photo"
                class="form-control @error('photo') is-invalid @enderror"
                value="{{ isset($pelaksanaTeknisi) ? $pelaksanaTeknisi->photo : old('photo') }}"
                placeholder="{{ __('Photo') }}" required />
            @error('photo')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}"
                {{ empty($pelaksanaTeknisi) ? 'required' : '' }}>
            @error('password')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
            @isset($pelaksanaTeknisi)
                <div id="passwordHelpBlock" class="form-text">
                    {{ __('Leave the password & password confirmation blank if you don`t want to change them.') }}
                </div>
            @endisset
        </div>
    </div>
</div>
