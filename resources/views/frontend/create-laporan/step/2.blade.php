<div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
    <form id="form-2">
        @foreach ($nomenklatur_type as $row)
            @php
                $inventaris = DB::table('inventaris')
                    ->join('brands', 'inventaris.merk_id', '=', 'brands.id')
                    ->rightJoin('sertifikat_inventaris', 'inventaris.id', '=', 'sertifikat_inventaris.inventaris_id')
                    ->select('inventaris.*', 'brands.nama_merek')
                    ->where('inventaris.jenis_alat_id', $row->type_id)
                    ->whereNotNull('sertifikat_inventaris.inventaris_id')
                    ->groupBy('inventaris.id')
                    ->get();
            @endphp

            <div class="col mb-2">
                <label for="" style=" font-size: 12px;">{{ $row->jenis_alat }}</label>
                <input type="hidden" name="type-{{ $row->id }}" id="type-{{ $row->id }}">
                <select class="form-control select2" id="type_select-{{ $row->id }}"
                    name="type-{{ $row->id }}" style="width: 100%;"
                    onchange="selectChange(this, '#type-{{ $row->id }}')">
                    <option selected disabled value="">-- Pilih --</option>
                    @foreach ($inventaris as $data)
                        <option value="{{ $data->id }}">SN {{ $data->serial_number }} | KD
                            {{ $data->kode_inventaris }} | Merk {{ $data->nama_merek }} | Type {{ $data->tipe }}
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
