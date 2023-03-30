@extends('layouts.master-frontend')
@section('title', 'Create Laporan')
@section('content')
    <br>
    <div class="page-content-wrapper">
        <div class="py-3">
            <div class="container">
                <div class="row g-1 align-items-center rtl-flex-d-row-r">
                    <div id="smartwizard" dir="" class="sw sw-justified sw-theme-arrows">
                        <ul class="nav nav-progress">
                            <li class="nav-item">
                                <a class="nav-link default active" href="#step-1">
                                    <div class="num">1</div>
                                    Pilih Nomenklatur
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link default" href="#step-2">
                                    <span class="num">2</span>
                                    Pendataan Administrasi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link default" href="#step-3">
                                    <span class="num">3</span>
                                    Daftar Alat Ukur
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link default" href="#step-4">
                                    <span class="num">4</span>
                                    Pengukuran Kondisi Lingkungan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link default" href="#step-5">
                                    <span class="num">5</span>
                                    Pemeriksaan Fisik Dan Fungsi Alat
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link default" href="#step-6">
                                    <span class="num">6</span>
                                    Pengukuran Keselamatan Listrik
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link default" href="#step-7">
                                    <span class="num">7</span>
                                    Pengukuran Kinerja
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link default" href="#step-8">
                                    <span class="num">8</span>
                                    Telaah Teknis
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link default" href="#step-9">
                                    <span class="num">9</span>
                                    Kesimpulan Telaah Teknis Kalibrasi
                                </a>
                            </li>
                        </ul>
                        <hr>

                        <div class="tab-content">
                            <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                <form id="form-1" class="" novalidate>
                                    <label for="validationCustom04" class="form-label">Nomenklatur</label>
                                    <select class="form-select" id="state" required>
                                        <option selected disabled value="">Pilih...</option>
                                        <option>State 1</option>
                                        <option>State 2</option>
                                        <option>State 3</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please select a valid nomenklatur.
                                    </div>
                                </form>
                            </div>
                            <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                Step content 2
                            </div>
                            <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                Step content 3
                            </div>
                            <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                                Step content 4
                            </div>
                            <div id="step-5" class="tab-pane" role="tabpanel" aria-labelledby="step-5">
                                Step content 5
                            </div>
                            <div id="step-6" class="tab-pane" role="tabpanel" aria-labelledby="step-6">
                                Step content 6
                            </div>
                            <div id="step-7" class="tab-pane" role="tabpanel" aria-labelledby="step-7">
                                Step content 7
                            </div>
                            <div id="step-8" class="tab-pane" role="tabpanel" aria-labelledby="step-8">
                                Step content 8
                            </div>
                            <div id="step-9" class="tab-pane" role="tabpanel" aria-labelledby="step-9">
                                Step content 9
                            </div>
                        </div>


                        {{-- <div class="tab-content" style="height: 164.8px;">
                            <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1"
                                style="display: block;">
                                <form id="form-1" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate="">
                                    <div class="col">
                                        <label for="first-name" class="form-label">First name</label>
                                        <input type="text" class="form-control" id="first-name" value=""
                                            required="">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide first name.
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="validationCustom02" class="form-label">Last name</label>
                                        <input type="text" class="form-control" id="last-name" value=""
                                            required="">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide last name.
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2"
                                style="display: none;">
                                <form id="form-2" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate="">
                                    <div class="col-md-6">
                                        <label for="validationCustom04" class="form-label">Product</label>
                                        <select class="form-select" id="sel-products" multiple="" required="">
                                            <option value="Apple iPhone 13">Apple iPhone 13</option>
                                            <option value="Apple iPhone 12">Apple iPhone 12</option>
                                            <option value="Samsung Galaxy S10">Samsung Galaxy S10</option>
                                            <option value="Motorola G5">Motorola G5</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please select product.
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3"
                                style="display: none;">
                                <form id="form-3" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate="">
                                    <div class="col">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" placeholder="1234 Main St"
                                            required="">
                                        <div class="invalid-feedback">
                                            Please enter your shipping address.
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="validationCustom04" class="form-label">State</label>
                                        <select class="form-select" id="state" required="">
                                            <option selected="" disabled="" value="">Choose...</option>
                                            <option>State 1</option>
                                            <option>State 2</option>
                                            <option>State 3</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please select a valid state.
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="validationCustom05" class="form-label">Zip</label>
                                        <input type="text" class="form-control" id="zip" required="">
                                        <div class="invalid-feedback">
                                            Please provide a valid zip.
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4"
                                style="display: none;">

                                <form id="form-4" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate="">
                                    <div class="col">
                                        <div class="mb-3 text-muted">Please confirm your order details</div>

                                        <div id="order-details"></div>

                                        <h4 class="mt-3">Payment</h4>
                                        <hr class="my-2">

                                        <div class="row gy-3">
                                            <div class="col-md-3">
                                                <label for="cc-name" class="form-label">Name on card</label>
                                                <input type="text" class="form-control" id="cc-name"
                                                    value="My Name" placeholder="" required="">
                                                <small class="text-muted">Full name as displayed on card</small>
                                                <div class="invalid-feedback">
                                                    Name on card is required
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="cc-number" class="form-label">Credit card number</label>
                                                <input type="text" class="form-control" id="cc-number"
                                                    value="54545454545454" placeholder="" required="">
                                                <div class="invalid-feedback">
                                                    Credit card number is required
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="cc-expiration" class="form-label">Expiration</label>
                                                <input type="text" class="form-control" id="cc-expiration"
                                                    value="1/28" placeholder="" required="">
                                                <div class="invalid-feedback">
                                                    Expiration date required
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="cc-cvv" class="form-label">CVV</label>
                                                <input type="text" class="form-control" id="cc-cvv" value="123"
                                                    placeholder="" required="">
                                                <div class="invalid-feedback">
                                                    Security code required
                                                </div>
                                            </div>

                                            <div class="col">
                                                <input type="checkbox" class="form-check-input" id="save-info"
                                                    required="">
                                                <label class="form-check-label" for="save-info">I agree to the terms and
                                                    conditions</label>
                                            </div>

                                            <small class="text-muted">This is an example page, do not enter any real data,
                                                even tho we don't submit this information!</small>

                                        </div>
                                    </div>
                                </form>



                            </div>
                        </div> --}}
                        {{-- <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
