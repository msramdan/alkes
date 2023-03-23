<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama-nomenklatur">{{ __('Nama Nomenklatur') }}</label>
            <input type="text" name="nama_nomenklatur" id="nama-nomenklatur"
                class="form-control @error('nama_nomenklatur') is-invalid @enderror"
                value="{{ isset($nomenklatur) ? $nomenklatur->nama_nomenklatur : old('nama_nomenklatur') }}"
                placeholder="{{ __('Nama Nomenklatur') }}" required />
            @error('nama_nomenklatur')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="no_dokumen">{{ __('No Dokumen') }}</label>
            <input type="text" name="no_dokumen" id="no_dokumen"
                class="form-control @error('no_dokumen') is-invalid @enderror"
                value="{{ isset($nomenklatur) ? $nomenklatur->no_dokumen : old('no_dokumen') }}"
                placeholder="{{ __('No Dokumen') }}" required />
            @error('no_dokumen')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="metode_kerja">{{ __('Metode Kerja') }}</label>
            <div class="input-group">
                <input type="file" name="metode_kerja" id="metode_kerja"
                    class="form-control @error('metode_kerja') is-invalid @enderror"
                    value="{{ isset($nomenklatur) ? $nomenklatur->metode_kerja : old('metode_kerja') }}"
                    placeholder="{{ __('Banner Image') }}" @if (!isset($nomenklatur)) required @endif />

                @if (isset($nomenklatur))
                    &nbsp;
                    <button class="btn btn-success" type="button" data-bs-toggle="modal" id="view_dokumen"
                        data-metode_kerja="{{ $nomenklatur->metode_kerja }}" data-bs-target="#backdrop"> <i
                            class="fa fa-file"></i>
                        View
                    </button>
                @endif


            </div>
            <div id="passwordHelpBlock" class="form-text">
                {{ __('Saran format file pdf dan maksimal ukuran 10Mb') }}
            </div>
            @error('metode_kerja')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>


<div class="modal fade text-left" id="backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4"
    data-bs-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel4">
                    Dokumen Metode Kerja
                </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <center><embed src="" id="metode_kerja" style="width: 100%;height:500px; margin:0px" />
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                {{-- <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Accept</span>
                </button> --}}
            </div>
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
    <script type="text/javascript">
        $(document).on('click', '#view_dokumen', function() {
            var metode_kerja = $(this).data('metode_kerja');
            $('#backdrop #metode_kerja').attr("src", "../../../storage/img/metode_kerja/" + metode_kerja);
        })
    </script>
@endpush
