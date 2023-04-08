@extends('layouts.master-frontend')
@section('title', 'List Faskes')
@section('content')
    {{-- {{ dd($faskesdata); }} --}}
    <div class="page-content-wrapper">
        <div class="py-3">
            <div class="container">
                <div class="row g-1">
                    <div class="col">
                        <select class="form-control select2" id="selectjenisfaskes" name="jenisfaskes"
                            aria-label="Default select example">
                            <option value="alljenisfaskes">All Jenis Faskes</option>
                            @foreach ($alljenis_faskes as $alljenis_faskess)
                                <option value="{{ $alljenis_faskess->nama_jenis_faskes }}"
                                    {{ old('jenisfaskes') == $alljenis_faskess->nama_jenis_faskes || $selected_jenisfaskes == $alljenis_faskess->nama_jenis_faskes ? 'selected' : '' }}>
                                    {{ $alljenis_faskess->nama_jenis_faskes }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-control select2" id="selectkabkot" name="kabkot"
                            aria-label="Default select example">
                            <option value="allkabkot">All Kabkot</option>
                            @foreach ($allkabkots as $allkabkotss)
                                <option value="{{ $allkabkotss->kabupaten_kota }}"
                                    {{ old('kabkot') == $allkabkotss->kabupaten_kota || $selected_kabkot == $allkabkotss->kabupaten_kota ? 'selected' : '' }}>
                                    {{ $allkabkotss->kabupaten_kota }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-control select2" id="selectshort" name="short"
                            aria-label="Default select example">
                            <option value="def" disabled selected>Short By</option>
                            <option value="ASC"
                                {{ old('short') == 'ASC' || $selected_short == 'ASC' ? 'selected' : '' }}>Nama A-Z
                            </option>
                            <option value="DESC"
                                {{ old('short') == 'DESC' || $selected_short == 'DESC' ? 'selected' : '' }}>Nama Z-A
                            </option>
                        </select>
                    </div>
                </div>

                <div class="mb-3"></div>
                <div class="row g-2">
                    {{-- mulai --}}
                    @foreach ($faskesdata as $faskesdatas)
                        <div class="col-12" style="background-color: #FFF;  border-radius:5px">
                            <div class="horizontal-product-card">
                                <div class="d-flex align-items-center">
                                    <div class="product-thumbnail-side">
                                        <a class="product-thumbnail shadow-sm d-block" href="#"><img
                                                src="{{ asset('frontend/img/hospital2.png') }}" alt=""
                                                style="width: 80%"></a>
                                    </div>
                                    <div class="product-description" style="margin-top: 5px; margin-bottom:5px">
                                        <a class="product-title d-block" href="#">{{ $faskesdatas->nama_faskes }}</a>
                                        <p class="sale-price"><i class="fa fa-tag" aria-hidden="true"></i>
                                            Jenis Faskes : {{ $faskesdatas->jenis_faske->nama_jenis_faskes }}</p>
                                        <div class="product-rating"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            {{ $faskesdatas->kabkot->kabupaten_kota }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="h-100 d-flex align-items-center justify-content-center" style="margin-top: 7px">
                {{ $faskesdata->links() }}
            </div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>

    <script>
        $(function() {
            var url = '/web/faskes/filter';
            var nama_jenisfaskes = 'alljenisfaskes';
            var nama_kabkot = 'allkabkot';

            $('#selectjenisfaskes, #selectkabkot, #selectshort').on('change', function() {
                nama_jenisfaskes = $("#selectjenisfaskes option:selected").val();
                nama_kabkot = $("#selectkabkot option:selected").val();
                var sorting = $("#selectshort option:selected").val();

                var urlfull = url + '?nama_jenisfaskes=' + nama_jenisfaskes + '&nama_kabkot=' +
                    nama_kabkot + '&sorting=' + sorting;

                console.log(urlfull);

                window.location.href = urlfull;
            });

        });
    </script>


@endsection
