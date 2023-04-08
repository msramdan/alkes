@extends('layouts.master-frontend')
@section('title', 'Create Laporan')
@push('css')
    <link href="{{ asset('frontend/css/smartwizard.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <br>
    <div class="page-content-wrapper">
        <div class="py-3">
            <div class="container">
                <div class="row g-1 align-items-center rtl-flex-d-row-r">
                    <div id="smartwizard" dir="" class="sw sw-justified sw-theme-arrows">
                        <ul class="nav nav-progress" id="step">
                            <li class="nav-item">
                                <a class="nav-link default" href="#step-1">
                                    <span class="num">1</span>
                                    Pendataan Administrasi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link default" href="#step-2">
                                    <span class="num">2</span>
                                    Daftar Alat Ukur
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link default" href="#step-3">
                                    <span class="num">3</span>
                                    Kondisi Lingkungan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link default" href="#step-4">
                                    <span class="num">4</span>
                                    Pemeriksaan Fisik & Fungsi Alat
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link default" href="#step-5">
                                    <span class="num">5</span>
                                    Pengukuran Keselamatan Listrik
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link default" href="#step-6">
                                    <span class="num">6</span>
                                    Pengukuran Kinerja
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link default" href="#step-7">
                                    <span class="num">7</span>
                                    Telaah Teknis
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link default" href="#step-8">
                                    <span class="num">8</span>
                                    Kesimpulan Telaah Teknis Kalibrasi
                                </a>
                            </li>
                        </ul>
                        <hr>
                        <form id="form-laporan" action="{{ route('web-submit-laporan') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content">
                                <input type="hidden" name="nomenklatur_id" value="{{ $nomenklatur_id }}">
                                @include('frontend.create-laporan.step.1')
                                @include('frontend.create-laporan.step.2')
                                @include('frontend.create-laporan.step.3')
                                @include('frontend.create-laporan.step.4')
                                @include('frontend.create-laporan.step.5')
                                @include('frontend.create-laporan.step.6')
                                @include('frontend.create-laporan.step.7')
                                @include('frontend.create-laporan.step.8')
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript">
    </script>
    <script type="text/javascript">
        // const myModal = new bootstrap.Modal(document.getElementById('confirmModal'));

        function onConfirm() {
            // let form = document.getElementById('form-9');
            // if (form) {
            //     if (!form.checkValidity()) {
            //         form.classList.add('was-validated');
            //         $('#smartwizard').smartWizard("setState", [3], 'error');
            //         $("#smartwizard").smartWizard('fixHeight');
            //         return false;
            //     }
            // }
            //alert("Selesai");
            $('#form-laporan').submit();
        }

        function showConfirm() {
            // const name = $('#first-name').val() + ' ' + $('#last-name').val();
            // const products = $('#sel-products').val();
            // const shipping = $('#address').val() + ' ' + $('#state').val() + ' ' + $('#zip').val();
            // let html = `<h4 class="mb-3-">Customer Details</h4>
        //       <hr class="my-2">
        //       <div class="row g-3 align-items-center">
        //         <div class="col-auto">
        //           <label class="col-form-label">Name</label>
        //         </div>
        //         <div class="col-auto">
        //           <span class="form-text-">${name}</span>
        //         </div>
        //       </div>

        //       <h4 class="mt-3">Products</h4>
        //       <hr class="my-2">
        //       <div class="row g-3 align-items-center">
        //         <div class="col-auto">
        //           <span class="form-text-">${products}</span>
        //         </div>
        //       </div>

        //       <h4 class="mt-3">Shipping</h4>
        //       <hr class="my-2">
        //       <div class="row g-3 align-items-center">
        //         <div class="col-auto">
        //           <span class="form-text-">${shipping}</span>
        //         </div>
        //       </div>`;
            // $("#order-details").html(html);
            // $('#smartwizard').smartWizard("fixHeight");
        }

        $(function() {
            // Leave step event is used for validating the forms
            $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx,
                stepDirection) {
                // Validate only on forward movement
                if (stepDirection == 'forward') {
                    let form = document.getElementById('form-' + (currentStepIdx + 1));
                    if (form) {
                        if (!form.checkValidity()) {
                            form.classList.add('was-validated');
                            $('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                            $("#smartwizard").smartWizard('fixHeight');
                            return false;
                        }
                        $('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                    }
                }
            });

            // Step show event
            $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
                $("#prev-btn").removeClass('disabled').prop('disabled', false);
                $("#next-btn").removeClass('disabled').prop('disabled', false);
                if (stepPosition === 'first') {
                    $("#prev-btn").addClass('disabled').prop('disabled', true);
                } else if (stepPosition === 'last') {
                    $("#next-btn").addClass('disabled').prop('disabled', true);
                } else {
                    $("#prev-btn").removeClass('disabled').prop('disabled', false);
                    $("#next-btn").removeClass('disabled').prop('disabled', false);
                }

                // Get step info from Smart Wizard
                let stepInfo = $('#smartwizard').smartWizard("getStepInfo");
                $("#sw-current-step").text(stepInfo.currentStep + 1);
                $("#sw-total-step").text(stepInfo.totalSteps);

                if (stepPosition == 'last') {
                    showConfirm();
                    $("#btnFinish").prop('disabled', false);
                } else {
                    $("#btnFinish").prop('disabled', true);
                }

                // Focus first name
                if (stepIndex == 1) {
                    setTimeout(() => {
                        $('#first-name').focus();
                    }, 0);
                }
            });

            // Smart Wizard
            $('#smartwizard').smartWizard({
                selected: 0,
                // autoAdjustHeight: false,
                theme: 'dots', // basic, arrows, square, round, dots
                transition: {
                    animation: 'fade'
                },
                lang: {
                    next: 'Selanjutnya',
                    previous: 'Kembali'
                },
                toolbar: {
                    showNextButton: true, // show/hide a Next button
                    showPreviousButton: true, // show/hide a Previous button
                    position: 'bottom', // none/ top/ both bottom
                    extraHtml: `<button class="btn btn-success" id="btnFinish" disabled onclick="onConfirm()"> <i class="fas fa-save" aria-hidden="true"></i> Simpan</button>`
                },
                anchor: {
                    enableNavigation: true, // Enable/Disable anchor navigation
                    enableNavigationAlways: false, // Activates all anchors clickable always
                    enableDoneState: true, // Add done state on visited steps
                    markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                    unDoneOnBackNavigation: true, // While navigate back, done state will be cleared
                    enableDoneStateNavigation: true // Enable/Disable the done state navigation
                },
            });

            $("#state_selector").on("change", function() {
                $('#smartwizard').smartWizard("setState", [$('#step_to_style').val()], $(this).val(), !$(
                    '#is_reset').prop("checked"));
                return true;
            });

            $("#style_selector").on("change", function() {
                $('#smartwizard').smartWizard("setStyle", [$('#step_to_style').val()], $(this).val(), !$(
                    '#is_reset').prop("checked"));
                return true;
            });

        });
    </script>
@endpush
