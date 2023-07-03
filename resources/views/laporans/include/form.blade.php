<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="no-laporan">{{ __('No Laporan') }}</label>
            <input type="text" name="no_laporan" id="no-laporan" readonly
                class="form-control @error('no_laporan') is-invalid @enderror" value="{{ $no_laporan }}"
                placeholder="{{ __('No Laporan') }}" required />
            @error('no_laporan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="user_created">{{ __('Pelaksana Teknisi') }}</label>
            <select class="form-select @error('user_created') is-invalid @enderror" name="user_created"
                id="user_created" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select Pelaksana Teknisi') }} --</option>
                @foreach ($PelaksanaTeknisi as $row)
                    <option value="{{ $row->id }}"
                        {{ isset($laporan) && $laporan->user_created == $row->id ? 'selected' : (old('user_created') == $row->id ? 'selected' : '') }}>
                        {{ $row->nama }}
                    </option>
                @endforeach
            </select>
            @error('user_created')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>
