@extends('layouts.master-frontend')
@section('title', 'History Laporan')
@section('content')
    <div class="page-content-wrapper">
        <div class="top-products-area py-3">
            <div class="container">
                <div class="row g-1 align-items-center rtl-flex-d-row-r">
                    <div class="col-6">
                        <div class="select-product-catagory" style="width: 100%">
                            <select class="form-control select2" id="selectFaskes" name="faskes"
                                aria-label="Default select example">
                                <option value="all">All Faskes</option>
                                @foreach ($faskes as $row)
                                    <option value="{{ $row->id }}"
                                        {{ old('faskes') == $row->id || $selected_faskes == $row->id ? 'selected' : '' }}>
                                        {{ $row->nama_faskes }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="select-product-catagory">
                            <select class="form-control select2" id="selectStatus" name="status"
                                aria-label="Default select example">
                                <option value="all">All Status</option>
                                <option value="Approved"
                                    {{ old('status') == 'Approved' || $selected_status == 'Approved' ? 'selected' : '' }}>
                                    Approved
                                </option>
                                <option value="Need Review"
                                    {{ old('status') == 'Need Review' || $selected_status == 'Need Review' ? 'selected' : '' }}>
                                    Need Review
                                </option>
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
                                            Faskes : {{ $row->nama_faskes }}
                                        </div>
                                        <div class="product-rating"><i class="fa fa-calendar"
                                                style="background-color: green" aria-hidden="true"></i>
                                            Tanggal : {{ $row->tgl_laporan }}
                                        </div>
                                        <div class="product-rating"><i class="fa fa-tag" aria-hidden="true"></i>
                                            Status : {{ $row->status_laporan }}
                                        </div>
                                        <div style="margin-top: 5px">
                                            <a class="btn btn-secondary btn-sm"
                                                href="{{ url('/web/show/history_laporan/' . $row->no_laporan) }}"><i
                                                    class="fa fa-eye" aria-hidden="true"></i>
                                                View</a>&nbsp;

                                            {{-- @if ($row->status_laporan == 'Need Review')
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ url('/web/history_laporan/' . $row->no_laporan) }}"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                            @else
                                                <button class="btn btn-success btn-sm" disabled><i class="fa fa-pencil"
                                                        aria-hidden="true"></i> Edit</button>
                                            @endif --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="h-100 d-flex align-items-center justify-content-center" style="margin-top: 7px">
                    {{ $laporan->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>

    <script>
        $(function() {
            var url = '/web/laporan/filter';
            var selected_faskes = 'all';
            var selected_status = 'all';

            $('#selectFaskes, #selectStatus').on('change', function() {
                selected_faskes = $("#selectFaskes option:selected").val();
                selected_status = $("#selectStatus option:selected").val();
                var urlfull = url + '?selected_faskes=' + selected_faskes + '&selected_status=' +
                selected_status;
                console.log(urlfull);
                window.location.href = urlfull;
            });

        });
    </script>

@endsection
