<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="kode-inventari">{{ __('Kode Inventaris') }}</label>
            <input type="text" name="kode_inventaris" id="kode-inventari"
                class="form-control @error('kode_inventaris') is-invalid @enderror"
                value="{{ isset($inventari) ? $inventari->kode_inventaris : old('kode_inventaris') }}"
                placeholder="{{ __('Kode Inventaris') }}" required />
            @error('kode_inventaris')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="kode">{{ __('Kode') }}</label>
            <input type="text" name="kode" id="kode" class="form-control @error('kode') is-invalid @enderror"
                value="{{ isset($inventari) ? $inventari->kode : old('kode') }}" placeholder="{{ __('Kode') }}"
                required />
            @error('kode')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tahun-pembelian">{{ __('Tahun Pembelian') }}</label>
            <select class="form-select @error('tahun_pembelian') is-invalid @enderror" name="tahun_pembelian"
                id="tahun-pembelian" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select tahun pembelian') }} --</option>

                @foreach (range(1900, strftime('%Y', time())) as $year)
                    <option value="{{ $year }}"
                        {{ isset($inventari) && $inventari->tahun_pembelian == $year ? 'selected' : (old('tahun_pembelian') == $year ? 'selected' : '') }}>
                        {{ $year }}
                    </option>
                @endforeach
            </select>
            @error('tahun_pembelian')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="ruangan-id">{{ __('Ruangan') }}</label>
            <select class="form-select @error('ruangan_id') is-invalid @enderror" name="ruangan_id" id="ruangan-id"
                class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select room') }} --</option>

                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}"
                        {{ isset($inventari) && $inventari->ruangan_id == $room->id ? 'selected' : (old('ruangan_id') == $room->id ? 'selected' : '') }}>
                        {{ $room->nama_ruangan }}
                    </option>
                @endforeach
            </select>
            @error('ruangan_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jenis-alat-id">{{ __('Jenis Alat') }}</label>
            <select class="form-select @error('jenis_alat_id') is-invalid @enderror" name="jenis_alat_id"
                id="jenis-alat-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select type') }} --</option>

                @foreach ($types as $type)
                    <option value="{{ $type->id }}"
                        {{ isset($inventari) && $inventari->jenis_alat_id == $type->id ? 'selected' : (old('jenis_alat_id') == $type->id ? 'selected' : '') }}>
                        {{ $type->jenis_alat }}
                    </option>
                @endforeach
            </select>
            @error('jenis_alat_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="merk-id">{{ __('Merek') }}</label>
            <select class="form-select @error('merk_id') is-invalid @enderror" name="merk_id" id="merk-id"
                class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select brand') }} --</option>

                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}"
                        {{ isset($inventari) && $inventari->merk_id == $brand->id ? 'selected' : (old('merk_id') == $brand->id ? 'selected' : '') }}>
                        {{ $brand->nama_merek }}
                    </option>
                @endforeach
            </select>
            @error('merk_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tipe">{{ __('Tipe') }}</label>
            <input type="text" name="tipe" id="tipe" class="form-control @error('tipe') is-invalid @enderror"
                value="{{ isset($inventari) ? $inventari->tipe : old('tipe') }}" placeholder="{{ __('Tipe') }}"
                required />
            @error('tipe')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="serial-number">{{ __('Serial Number') }}</label>
            <input type="text" name="serial_number" id="serial-number"
                class="form-control @error('serial_number') is-invalid @enderror"
                value="{{ isset($inventari) ? $inventari->serial_number : old('serial_number') }}"
                placeholder="{{ __('Serial Number') }}" required />
            @error('serial_number')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="vendor-id">{{ __('Vendor Alat') }}</label>
            <select class="form-select @error('vendor_id') is-invalid @enderror" name="vendor_id" id="vendor-id"
                class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select vendor') }} --</option>

                @foreach ($vendors as $vendor)
                    <option value="{{ $vendor->id }}"
                        {{ isset($inventari) && $inventari->vendor_id == $vendor->id ? 'selected' : (old('vendor_id') == $vendor->id ? 'selected' : '') }}>
                        {{ $vendor->nama_vendor }}
                    </option>
                @endforeach
            </select>
            @error('vendor_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>
