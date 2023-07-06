{{-- modal update pin --}}
<div class="modal fade" id="modalPin{{ $model->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update PIN {{ $model->nama_faskes }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('updatePin') }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="{{ $model->id }}">
                        <div class="form-group">
                            <div class="border-pin">
                                <input type="text" name="satu" class="num" autocomplete="off" maxlength="1"
                                    value="{{ substr($model->pin, 0, 1) }}" required
                                    onkeypress="return onlyNumberKey(event)">
                                <input type="text" name="dua" class="num" autocomplete="off" maxlength="1" value="{{ substr($model->pin, 1, 1) }}"
                                    required onkeypress="return onlyNumberKey(event)">
                                <input type="text" name="tiga" class="num" autocomplete="off" maxlength="1" value="{{ substr($model->pin, 2, 1) }}"
                                    required onkeypress="return onlyNumberKey(event)">
                                <input type="text" name="empat" class="num" autocomplete="off" maxlength="1" value="{{ substr($model->pin, 3, 1) }}"
                                    required onkeypress="return onlyNumberKey(event)">
                                <input type="text" name="lima" class="num" autocomplete="off" maxlength="1" value="{{ substr($model->pin, 4, 1) }}"
                                    required onkeypress="return onlyNumberKey(event)">
                                <input type="text" name="enam" class="num" autocomplete="off" maxlength="1" value="{{ substr($model->pin, 5, 1) }}"
                                    required onkeypress="return onlyNumberKey(event)">
                            </div>
                            <span style="color: red; font-size:10px">* Hanya nomor yang di ijinkan</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<td>
    <a href="#" title="Update PIN" class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
        data-bs-target="#modalPin{{ $model->id }}">
        <i class="fa fa-cog"></i>
    </a>

    @can('faske edit')
        <a href="{{ route('faskes.edit', $model->id) }}" class="btn btn-outline-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endcan

    @can('faske delete')
        <form action="{{ route('faskes.destroy', $model->id) }}" method="post" class="d-inline"
            onsubmit="return confirm('Are you sure to delete this record?')">
            @csrf
            @method('delete')
            <button class="btn btn-outline-danger btn-sm">
                <i class="ace-icon fa fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</td>


<script>
    $(".num").keyup(function() {
        if (this.value.length == this.maxLength) {
            $(this).next('.num').focus();
        }
    });
</script>

<script>
    function onlyNumberKey(evt) {
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>
