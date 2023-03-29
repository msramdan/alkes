@extends('layouts.master-frontend')
@section('title', 'Kontak')
@section('content')
    <div class="page-content-wrapper">
        <div class="top-products-area py-3">
            <div class="container">
                <div class="top-products-area py-3">
                    <div class="container">
                        <div class="row g-1 align-items-center rtl-flex-d-row-r">
                            <div class="col-12">
                                <div class="select-product-catagory" style="width: 100%">
                                    <select class=" small border-0" id="selectProductCatagory" name="kategori"
                                        aria-label="Default select example">
                                        <option value="all">-- Search Nomenklatur --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3"></div>

                        <div class="row g-2">
                            @foreach ($nomenklatur as $row)
                                <div class="col-6 col-md-4">
                                    <div class="card product-card">
                                        <div class="card-header">
                                            <center>
                                                <span class="product-title"
                                                    style="font-size: 11px">{{ $row->nama_nomenklatur }}</span>
                                            </center>
                                        </div>
                                        <div class="card-body">
                                            <center>
                                                <a class="product-thumbnail d-block" href=""><img class="mb-1"
                                                        src="{{ asset('frontend/img/pdf.png') }}" alt="">
                                                </a>
                                            </center>
                                            <button type="button" style="width: 100%"
                                                class="btn btn-secondary btn-block"><i class="fa fa-download"
                                                    aria-hidden="true"></i> Download</button>


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

@endsection
