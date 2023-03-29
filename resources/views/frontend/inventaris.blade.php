@extends('layouts.master-frontend')
@section('title', 'Inventaris')
@section('content')
    <div class="page-content-wrapper">
        <div class="py-3">
            <div class="container">
                <div class="row g-1 align-items-center rtl-flex-d-row-r">
                    <div class="col-4">
                        <div class="select-product-catagory" style="width: 100%">
                            <select class=" small border-0" id="selectProductCatagory" name="kategori"
                                aria-label="Default select example">
                                <option value="all">All Ruangan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="select-product-catagory">
                            <select class=" small border-0" id="selectProductCatagory" name="label"
                                aria-label="Default select example">
                                <option value="all">All Merek</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="select-product-catagory">
                            <select class=" small border-0" id="selectProductCatagory" name="label"
                                aria-label="Default select example">
                                <option value="all">All Jenis Alat</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3"></div>
                <div class="row g-2">
                    {{-- mulai --}}
                    @foreach ($inventaris as $row)
                        <div class="col-12" style="background-color: #FFF;  border-radius:5px">
                            <div class="horizontal-product-card">
                                <div class="d-flex align-items-center">
                                    <div class="product-thumbnail-side">
                                        <a class="product-thumbnail shadow-sm d-block" href="#"><img
                                                src="{{ asset('frontend/img/toolbox.png') }}" alt=""
                                                style="width: 80%"></a>
                                    </div>
                                    <div class="product-description" style="margin-top: 5px; margin-bottom:5px">
                                        <a class="product-title d-block" href="#">{{ $row->kode_inventaris }} -
                                            SN{{ $row->serial_number }} </a>
                                        <p class="sale-price"><i class="fa fa-cube" aria-hidden="true"></i>
                                            Ruangan : {{ $row->room->nama_ruangan }}</p>
                                        <p class="sale-price"><i class="fa fa-tag" style="background-color: green"
                                                aria-hidden="true"></i>
                                            Merek : {{ $row->brand->nama_merek }}</p>
                                        <div class="product-rating"><i class="fa fa-list" aria-hidden="true"></i>
                                            Jenis Alat : {{ $row->type->jenis_alat }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="h-100 d-flex align-items-center justify-content-center" style="margin-top: 7px">
                {{ $inventaris->links() }}
            </div>
        </div>
    </div>
@endsection
