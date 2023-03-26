@extends('layouts.master-frontend')
@section('title', 'Toko Online')
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

        <div class="container">
            <div class="dark-mode-wrapper mt-3 bg-img p-4 p-lg-5">
                <center>
                    <p class="text-white">AAAA Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </center>
            </div>
        </div>
    </div>
@endsection
