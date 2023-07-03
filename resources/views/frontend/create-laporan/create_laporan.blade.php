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
                        </ul>
                        <hr>
                            <div class="tab-content">
                                @include('frontend.create-laporan.step.1')
                                @include('frontend.create-laporan.step.2')
                                @include('frontend.create-laporan.step.3')
                                @include('frontend.create-laporan.step.4')
                                @include('frontend.create-laporan.step.5')
                                @include('frontend.create-laporan.step.6')
                                @include('frontend.create-laporan.step.7')
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('web-submit-laporan') }}" id="form-laporan" method="POST" hidden enctype="multipart/form-data">
        @csrf
    </form>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript">
    </script>
    <script type="text/javascript">
        $('#faskes').change(function() {
            var value = $(this).find(":selected").val();
            $('#administrasi_faskes-pemilik').val(value);
        });

        function selectChange(elements, target) {
            var value = $(elements).find(":selected").val();
            $(target).val(value);
        }

        function onConfirm() {
            $('#form-laporan').html('');
            var nomenklatur_id = "{{ $nomenklatur_id }}";
            var laporan_id = "{{ $laporan_id }}";
            var csrf = "{{ csrf_token() }}";
            $('#form-laporan').append(`
                <input type="hidden" name="nomenklatur_id" value="${nomenklatur_id}"/>
                <input type="hidden" name="laporan_id" value="${laporan_id}"/>
                <input type="hidden" name="_token" value="${csrf}"/>
            `);
            var form1 = document.getElementById('form-1').elements;
            [...form1].forEach((item) => {
                $('#form-laporan').append(item.cloneNode(true));
            });
            var form2 = document.getElementById('form-2').elements;
            [...form2].forEach((item) => {
                $('#form-laporan').append(item.cloneNode(true));
            });
            var form3 = document.getElementById('form-3').elements;
            [...form3].forEach((item) => {
                $('#form-laporan').append(item.cloneNode(true));
            });
            var form4 = document.getElementById('form-4').elements;
            [...form4].forEach((item) => {
                $('#form-laporan').append(item.cloneNode(true));
            });
            var form5 = document.getElementById('form-5').elements;
            [...form5].forEach((item) => {
                $('#form-laporan').append(item.cloneNode(true));
            });
            // var form6 = document.getElementById('form-6').elements;
            // [...form6].forEach((item) => {
            //     $('#form-laporan').append(item.cloneNode(true));
            // });
            var form7 = document.getElementById('form-7').elements;
            [...form7].forEach((item) => {
                $('#form-laporan').append(item.cloneNode(true));
            });
            $('#form-laporan').submit();
        }

        function showConfirm() {
        }

        $(function() {
            // Leave step event is used for validating the forms
            $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx,
                stepDirection) {
                // Validate only on forward movement
                if (stepDirection == 'forward') {
                   // console.log(tes.elements);
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
