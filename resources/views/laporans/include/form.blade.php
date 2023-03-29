<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="no-laporan">{{ __('No Laporan') }}</label>
            <input type="text" name="no__laporan" id="no-laporan" class="form-control @error('no__laporan') is-invalid @enderror" value="{{ isset($laporan) ? $laporan->no__laporan : old('no__laporan') }}" placeholder="{{ __('No Laporan') }}" required />
            @error('no__laporan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="user-created">{{ __('User') }}</label>
            <select class="form-select @error('user_created') is-invalid @enderror" name="user_created" id="user-created" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select user') }} --</option>
                
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ isset($laporan) && $laporan->user_created == $user->id ? 'selected' : (old('user_created') == $user->id ? 'selected' : '') }}>
                                {{ $user->name }}
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
    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl-laporan">{{ __('Tgl Laporan') }}</label>
            <input type="datetime-local" name="tgl_laporan" id="tgl-laporan" class="form-control @error('tgl_laporan') is-invalid @enderror" value="{{ isset($laporan) && $laporan->tgl_laporan ? $laporan->tgl_laporan->format('Y-m-d\TH:i') : old('tgl_laporan') }}" placeholder="{{ __('Tgl Laporan') }}" required />
            @error('tgl_laporan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="status-laporan">{{ __('Status Laporan') }}</label>
            <input type="text" name="status_laporan" id="status-laporan" class="form-control @error('status_laporan') is-invalid @enderror" value="{{ isset($laporan) ? $laporan->status_laporan : old('status_laporan') }}" placeholder="{{ __('Status Laporan') }}" required />
            @error('status_laporan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="user-review">{{ __('User') }}</label>
            <select class="form-select @error('user_review') is-invalid @enderror" name="user_review" id="user-review" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select user') }} --</option>
                
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ isset($laporan) && $laporan->user_review == $user->id ? 'selected' : (old('user_review') == $user->id ? 'selected' : '') }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
            </select>
            @error('user_review')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl-review">{{ __('Tgl Review') }}</label>
            <input type="datetime-local" name="tgl_review" id="tgl-review" class="form-control @error('tgl_review') is-invalid @enderror" value="{{ isset($laporan) && $laporan->tgl_review ? $laporan->tgl_review->format('Y-m-d\TH:i') : old('tgl_review') }}" placeholder="{{ __('Tgl Review') }}" required />
            @error('tgl_review')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>