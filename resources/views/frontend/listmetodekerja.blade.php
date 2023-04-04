@extends('layouts.master-frontend')
@section('title', 'List Metode Kerja')
{{-- {{ dd($filternomenklatur); }} --}}
@push('css')
    <style>
        /* body {
                                                                                                                                                                                                                                                        background: #2a2a2b;
                                                                                                                                                                                                                                                        color: #fff;
                                                                                                                                                                                                                                                        text-align: center;
                                                                                                                                                                                                                                                        font-family: Arial, Helvetica;
                                                                                                                                                                                                                                                    } */

        .big {
            font-size: 1.2em;
        }

        .small {
            font-size: .7em;
        }

        .square {
            width: .7em;
            height: .7em;
            margin: .5em;
            display: inline-block;
        }

        /* Custom dropdown */
        .custom-dropdown {
            position: relative;
            display: inline-block;
            vertical-align: middle;
            margin: 10px;
            /* demo only */
        }

        .custom-dropdown select {
            background-color: #1abc9c;
            color: #fff;
            font-size: inherit;
            padding: .5em;
            padding-right: 2.5em;
            border: 0;
            margin: 0;
            border-radius: 3px;
            text-indent: 0.01px;
            text-overflow: '';
            -webkit-appearance: button;
            /* hide default arrow in chrome OSX */
        }

        .custom-dropdown::before,
        .custom-dropdown::after {
            content: "";
            position: absolute;
            pointer-events: none;
        }

        .custom-dropdown::after {
            /*  Custom dropdown arrow */
            content: "\25BC";
            height: 1em;
            font-size: .625em;
            line-height: 1;
            right: 1.2em;
            top: 50%;
            margin-top: -.5em;
        }

        .custom-dropdown::before {
            /*  Custom dropdown arrow cover */
            width: 2em;
            right: 0;
            top: 0;
            bottom: 0;
            border-radius: 0 3px 3px 0;
        }

        .custom-dropdown select[disabled] {
            color: rgba(0, 0, 0, .3);
        }

        .custom-dropdown select[disabled]::after {
            color: rgba(0, 0, 0, .1);
        }

        .custom-dropdown::before {
            background-color: rgba(0, 0, 0, .15);
        }

        .custom-dropdown::after {
            color: rgba(0, 0, 0, .4);
        }
    </style>
@endpush
@section('content')
    <div class="page-content-wrapper">
         <div class="top-products-area py-3">
            <div class="container">
                <div class="top-products-area py-3">
                    <div class="container">
                        <div class="row g-1 align-items-center rtl-flex-d-row-r">
                            <div class="col-12">

                                <div class="select-product-catagory" style="width: 100%">
                                    {{-- <select class=" small border-0" id="selectProductCatagory" name="kategori"
                                        aria-label="Default select example">
                                        <option value="all">-- Search Nomenklatur --</option>
                                    </select> --}}
                                    {{-- <form action="#" method="GET"> --}}
                                    <div class="form-group mb-2">
                                        <select class="form-control select2" id="selectnomenklatur_id" name="nomenklatur_id" required
                                            style="width: 100%;" required>
                                            <option selected disabled value="">-- Search Nomenklatur --</option>
                                            <option value="allnomenklatur">All Nomenklatur</option>
                                            @foreach ($nomenklatur as $row)
                                                <option value="{{ $row->id }}">{{ $row->nama_nomenklatur }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>        
                                    {{-- </form> --}}

                                </div>

                            </div>
                        </div>
                        <div class="mb-3"></div>

                        <div class="row g-2">
                            @foreach ($filternomenklatur as $row)
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
                                            <a href="{{ route('web-listmetodekerja-download', ['file' => $row->metode_kerja, 'name' => $row->nama_nomenklatur]) }}"
                                                style="width: 100%" class="btn btn-secondary btn-block"><i
                                                    class="fa fa-download" aria-hidden="true"></i> Download</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>

    <script>
        $(function(){
            var url = '/web/listmetodekerja/filter';

            $('#selectnomenklatur_id').on('change', function () {
                var nomenklatur_id = $("#selectnomenklatur_id option:selected").val();
                
                var urlfull = url + '?nomenklatur_id=' + nomenklatur_id;
                console.log(urlfull);

                window.location.href = urlfull;
            });

        });
    </script>

@endsection
@push('js')
@endpush
