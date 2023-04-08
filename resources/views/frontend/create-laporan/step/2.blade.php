<div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
    @foreach ($nomenklatur_type as $row)
        @php
            $inventaris = DB::table('inventaris')
                ->where('jenis_alat_id', $row->type_id)
                ->get();
        @endphp
        <div class="col mb-2">
            <label for="" style=" font-size: 12px;">{{ $row->jenis_alat }}</label>
            <select class="form-control select2" id="type-{{ $row->type_id }}"
                name="type-{{ $row->type_id }}" required style="width: 100%;" required>
                <option selected disabled value="">-- Pilih --</option>
                @foreach ($inventaris as $data)
                    <option value="{{ $data->id }}">{{ $data->kode_inventaris }}
                    </option>
                @endforeach
            </select>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a valid {{ $row->jenis_alat }}.
            </div>
        </div>
    @endforeach
</div>
