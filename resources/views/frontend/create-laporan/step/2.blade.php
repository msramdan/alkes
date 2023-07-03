<div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
    <form id="form-2">
        @foreach ($nomenklatur_type as $row)
            @php
                $inventaris = DB::table('inventaris')
                    ->where('jenis_alat_id', $row->type_id)
                    ->get();
            @endphp

            <div class="col mb-2">
                <label for="" style=" font-size: 12px;">{{ $row->jenis_alat }}</label>
                <input type="hidden" name="type-{{ $row->id }}" id="type-{{ $row->id }}">
                <select class="form-control select2" id="type_select-{{ $row->id }}"
                    name="type-{{ $row->id }}" required style="width: 100%;" required onchange="selectChange(this, '#type-{{ $row->id }}')">
                    <option selected disabled value="">-- Pilih --</option>
                    @foreach ($inventaris as $data)
                        <option value="{{ $data->id }}">{{ $data->kode_inventaris}}
                        </option>
                    @endforeach
                </select>
                <div class="valid-feedback">
                    Okay !
                </div>
                <div class="invalid-feedback">
                    Silahkan pilih {{ $row->jenis_alat }}.
                </div>
            </div>
        @endforeach
    </form>
</div>
