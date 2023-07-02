@extends('layouts.master-frontend')
@section('title', 'History Laporan')
@section('content')
    <div class="page-content-wrapper">
        <div class="top-products-area py-3">
            <div class="container">
                <div class="row g-1 align-items-center rtl-flex-d-row-r">
                    <div class="col-4">
                        <div class="select-product-catagory" style="width: 100%">
                            <select class=" small border-0" id="selectProductCatagory" name="kategori"
                                aria-label="Default select example">
                                <option value="all">All Faskes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="select-product-catagory">
                            <select class=" small border-0" id="selectProductCatagory" name="label"
                                aria-label="Default select example">
                                <option value="all">All Status</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="select-product-catagory">
                            <select class=" small border-0" id="selectProductCatagory" name="label"
                                aria-label="Default select example">
                                <option value="all">All Tahun</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3"></div>
                <div class="row g-2">
                    {{-- mulai --}}
                    @foreach ($laporan as $row)
                        <div class="col-12" style="background-color: #FFF;  border-radius:5px">
                            <div class="horizontal-product-card">
                                <div class="d-flex align-items-center">
                                    <div class="product-thumbnail-side">
                                        <a class="product-thumbnail shadow-sm d-block" href="#"><img
                                                src="{{ asset('frontend/img/new.png') }}" alt=""
                                                style="width: 80%"></a>
                                    </div>
                                    <div class="product-description" style="margin-top: 5px; margin-bottom:5px">
                                        <a class="product-title d-block" href="#">{{ $row->no_laporan }}</a>
                                        <div class="product-rating"><i class="fa fa-bank" style="background-color: #332858"
                                                aria-hidden="true"></i>
                                            Faskes : {{ $row->status_laporan }}
                                        </div>
                                        <div class="product-rating"><i class="fa fa-calendar"
                                                style="background-color: green" aria-hidden="true"></i>
                                            Tanggal : {{ $row->tgl_laporan }}
                                        </div>
                                        <div class="product-rating"><i class="fa fa-tag" aria-hidden="true"></i>
                                            Status : {{ $row->status_laporan }}
                                        </div>
                                        <div style="margin-top: 5px">
                                            <a class="btn btn-secondary btn-sm" href="{{ url('/web/show/history_laporan/'. $row->no_laporan) }}"><i class="fa fa-eye"
                                                    aria-hidden="true"></i>
                                                View</a>&nbsp;
                                            <a class="btn btn-success btn-sm" href="{{ url('/web/history_laporan/'. $row->no_laporan) }}"><i class="fa fa-pencil"
                                                    aria-hidden="true"></i> Edit</a>&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

@endsection
