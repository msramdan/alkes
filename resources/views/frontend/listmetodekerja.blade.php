@extends('layouts.master-frontend')
@section('title', 'Kontak')
@section('content')
    <div class="page-content-wrapper">
        <div class="top-products-area py-3">
            <div class="container">
                <div class="top-products-area py-3">
                    <div class="container">
                        <div class="row g-1 align-items-center rtl-flex-d-row-r">
                            <div class="col-7">
                                <div class="select-product-catagory" style="width: 100%">
                                    <select class=" small border-0" id="selectProductCatagory" name="kategori"
                                        aria-label="Default select example">
                                        <option value="all">-- Search --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="select-product-catagory">
                                    <select class=" small border-0" id="selectProductCatagory" name="short"
                                        aria-label="Default select example">
                                        <option value="" disabled selected>Short By</option>
                                        <option value="" disabled>Nama A-Z</option>
                                        <option value="" disabled>Nama Z-A</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3"></div>

                        <div class="row g-2">
                            @foreach ($nomenklatur as $row)
                                <div class="col-4 col-md-4">
                                    <div class="card product-card">
                                        <div class="card-body">
                                            <a class="product-thumbnail d-block view_dokumen" data-bs-toggle="modal"
                                                id="" data-metode_kerja={{ $row->metode_kerja }}
                                                data-bs-target="#backdrop" href=""><img class="mb-2"
                                                    src="{{ asset('frontend/img/pdf.png') }}" alt="">
                                            </a>
                                            <center>
                                                <a class="product-title view_dokumen" href="#" data-bs-toggle="modal"
                                                    id="" data-metode_kerja={{ $row->metode_kerja }}
                                                    data-bs-target="#backdrop"
                                                    style="font-size: 10px">{{ $row->nama_nomenklatur }}</a>
                                            </center>

                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
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
                </div>
                <div class="modal-body">
                    <center><embed src="" id="metode_kerja" style="width: 100%;height:450px; margin:0px" />
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"
                            aria-hidden="true"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script type="text/javascript">
        $(document).on('click', '.view_dokumen', function() {
            var metode_kerja = $(this).data('metode_kerja');
            console.log(metode_kerja)
            $('#backdrop #metode_kerja').attr("src", "../../../../storage/img/metode_kerja/" + metode_kerja);
        })
    </script>
@endpush
