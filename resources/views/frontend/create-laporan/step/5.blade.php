<div id="step-5" class="tab-pane" role="tabpanel" aria-labelledby="step-5">
    <form id="form-5">
        @foreach ($nomenklatur_keselamatan_listrik as $data)
        <div class="row mb-2">
            <div class="col">
                <label for="" style=" font-size: 12px;">{{ $data->field_keselamatan_listrik }}</label>
                <input type="text" name="keselamatan_listrik-{{ $data->id }}" class="form-control" placeholder="" aria-label="{{ $data->field_keselamatan_listrik }}">
            </div>
        </div>
        @endforeach
    </form>
</div>
