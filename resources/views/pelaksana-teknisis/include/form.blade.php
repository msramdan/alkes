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
                value="{{ isset($pelaksanaTeknisi) && $pelaksanaTeknisi->tangal_lahir ? $pelaksanaTeknisi->tangal_lahir : old('tangal_lahir') }}"
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
            {{-- <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}"
                {{ empty($pelaksanaTeknisi) ? 'required' : '' }}>
            @error('password')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror --}}

            <div class="input-group">
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}"
                    {{ empty($pelaksanaTeknisi) ? 'required' : '' }}> &nbsp;
                <button class="btn btn-success" type="button" onclick="generatePassword()"
                    id="">Generate</button> &nbsp;
                <button class="btn btn-primary" type="button" onclick="toggleShowPassword()" id=""><i
                        class="fa fa-eye"></i></button>
            </div>
            @isset($pelaksanaTeknisi)
                <div id="passwordHelpBlock" class="form-text">
                    {{ __('Leave the password & password confirmation blank if you don`t want to change them.') }}
                </div>
            @endisset
        </div>
    </div>
</div>

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function toggleShowPassword() {
            const type = $('input#password').attr('type');
            if (type === "password") {
                $('input#password').attr('type', 'text');
            } else {
                $('input#password').attr('type', 'password');
            }
        }

        function generatePassword() {
            let password = "";
            let passwordLength = 1;

            const lowerCase = 'abcdefghijklmnopqrstuvwxyz'
            for (let i = 0; i < passwordLength; i++) {
                const randomNumber = Math.floor(Math.random() * lowerCase.length);
                password += lowerCase.substring(randomNumber, randomNumber + 1);
            }

            passwordLength = 1;
            const number = '0123456789'
            for (let i = 0; i < passwordLength; i++) {
                const randomNumber = Math.floor(Math.random() * number.length);
                password += number.substring(randomNumber, randomNumber + 1);
            }

            passwordLength = 1;
            const upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            for (let i = 0; i < passwordLength; i++) {
                const randomNumber = Math.floor(Math.random() * upperCase.length);
                password += upperCase.substring(randomNumber, randomNumber + 1);
            }

            passwordLength = 1;
            const character = '!@#$%^&*()'
            for (let i = 0; i < passwordLength; i++) {
                const randomNumber = Math.floor(Math.random() * character.length);
                password += character.substring(randomNumber, randomNumber + 1);
            }

            const allChars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            passwordLength = 4;
            for (let i = 0; i < passwordLength; i++) {
                const randomNumber = Math.floor(Math.random() * allChars.length);
                password += allChars.substring(randomNumber, randomNumber + 1);
            }

            const shuffled = password.split('').sort(function() {
                return 0.5 - Math.random()
            }).join('');
            $('input#password').val(shuffled);
            $('input#password').attr('type', 'text')
        }
    </script>
@endpush
