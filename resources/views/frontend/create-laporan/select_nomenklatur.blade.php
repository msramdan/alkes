@extends('layouts.master-frontend')
@section('title', 'Create Laporan')
@push('css')
    <style>
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
                        <form action="{{ route('web-create_laporan_lk') }}" style="margin-top: 50%" method="GET">
                            <div class="col mb-2">
                                <label for="" style=" font-size: 12px;">Laporan</label>
                                <select class="form-control select2" id="laporan_id" name="laporan_id" required
                                    style="width: 100%;" required>
                                    <option selected disabled value="">-- Pilih --</option>
                                    @foreach ($laporan as $row)
                                        <option value="{{ $row->id }}">{{ $row->no_laporan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mb-2">
                                <label for="" style=" font-size: 12px;">Nomenklatur</label>
                                <select class="form-control select2" id="nomenklatur_id" name="nomenklatur_id" required
                                    style="width: 100%;" required>
                                    <option selected disabled value="">-- Pilih --</option>
                                    @foreach ($nomenklaturs as $row)
                                        <option value="{{ $row->id }}">{{ $row->nama_nomenklatur }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2" style="text-align: right">
                                <button class="btn btn-success">Selanjutnya <i class="fa fa-arrow-right"
                                        aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('js')
    @endpush
