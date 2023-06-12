@extends('layouts.master-frontend')
@section('title', 'Home')
@section('content')
    <div class="page-content-wrapper">
        <!-- Hero Wrapper -->
        <div class="hero-wrapper">
            <div class="container">
                <div class="pt-3">
                    <div class="hero-slides owl-carousel">
                        @foreach ($banner as $row)
                            <div class="single-hero-slide"
                                style="background-image: url('{{ asset('storage/img/banner_image/' . $row->banner_image) }}')">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="product-catagories-wrapper py-3">
            <div class="container">
                <div class="row g-2 rtl-flex-d-row-r">
                    <div class="col-3">
                        <div class="card catagory-card">
                            <div class="card-body px-2">
                                <a href="{{ route('web-laporan_lk') }}">
                                    <img src="{{ asset('frontend/img/new.png') }}" alt="Buat Laporan Baru">
                                    <span>Buat Laporan Baru</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card catagory-card">
                            <div class="card-body px-2">
                                <a href="{{ route('web-history_laporan') }}">
                                    <img src="{{ asset('frontend/img/list.png') }}" alt="History Laporam">
                                    <span>History Laporan</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card catagory-card">
                            <div class="card-body px-2">
                                <a href="{{ route('web-faskes') }}">
                                    <img src="{{ asset('frontend/img/hospital2.png') }}" alt="Fasilitas Kesehatan">
                                    <span>Fasilitas Kesehatan</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card catagory-card">
                            <div class="card-body px-2">
                                <a href="{{ route('web-inventaris') }}">
                                    <img src="{{ asset('frontend/img/toolbox.png') }}" alt="Inventaris Alat">
                                    <span>Inventaris Alat</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card catagory-card">
                            <div class="card-body px-2">
                                <a href="{{ route('web-listmetodekerja') }}">
                                    <img src="{{ asset('frontend/img/metode.png') }}" alt="List Metode Kerja">
                                    <span>List Metode Kerja</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
