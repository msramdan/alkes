@extends('layouts.master-frontend')
@section('title', 'Inventaris')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- {{ dd($getid_ruangan) }} --}}
    <div class="page-content-wrapper">
        <div class="py-3">
            <div class="container">
                <div class="row g-1 align-items-center rtl-flex-d-row-r">
                    <div class="col-4">
                        <div class="select-product-catagory" style="width: 100%">
                            <select class=" small border-0" id="selectruangan" name="ruangan"
                                aria-label="Default select example">
                                <option value="allruangan">All Ruangan</option>
                                @foreach ($allruangan as $allruangans)
                                    {{-- <option value="{{ $allruangans->nama_ruangan }}">{{ $allruangans->nama_ruangan }}</option> --}}
                                    <option value="{{ $allruangans->nama_ruangan }}" {{ old('ruangan') == $allruangans->nama_ruangan || $selected_ruangan == $allruangans->nama_ruangan ? 'selected' : '' }}>
                                        {{ $allruangans->nama_ruangan }}
                                    </option>

                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="select-product-catagory">
                            <select class=" small border-0" id="selectmerek" name="merek"
                                aria-label="Default select example">
                                <option value="all">All Merek</option>
                                @foreach ($allmerek as $allmereks)
                                    <option value="all">{{ $allmereks->nama_merek }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="select-product-catagory">
                            <select class=" small border-0" id="selectjenisalat" name="jenisalat"
                                aria-label="Default select example">
                                <option value="all">All Jenis Alat</option>
                                @foreach ($alljenisalat as $alljenisalats)
                                    <option value="all">{{ $alljenisalats->jenis_alat }}</option>
                                @endforeach
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>

    <script>
        $(function(){
            $('#selectruangan').on('change', function () {
                var url1 = '/web/inventaris/filter';
                var nama_ruangan= $("#selectruangan option:selected").val()
                var url = url1+'?nama_ruangan='+nama_ruangan ;

                console.log(url);

                window.location.href=url;
            });
        });
    </script>

@endsection
