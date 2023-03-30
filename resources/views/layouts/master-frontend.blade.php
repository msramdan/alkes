<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#100DD1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>DiGi Form</title>

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/brands.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/solid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
    <link rel="manifest" href="{{ asset('frontend/manifest.json') }}">
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
        type="text/css" />
</head>

<body>
    <div class="header-area" id="headerArea">
        <div class="container h-100 d-flex align-items-center justify-content-between d-flex rtl-flex-d-row-r">
            <!-- Logo Wrapper -->
            <div class="logo-wrapper"><a href="{{ route('home') }}">
                    <img src="{{ asset('frontend/img/logo.png') }}" alt="" style="width: 68%;">
                </a></div>
            <div class="navbar-logo-container d-flex align-items-center">
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" id="darkSwitch" type="checkbox" role="switch">
                    {{-- <label class="form-check-label text-white h6 mb-0" for="darkSwitch">Dark Mode</label> --}}
                </div>
            </div>
        </div>
    </div>
    @yield('content')
    <div class="footer-nav-area" id="footerNav">
        <div class="suha-footer-nav">
            <ul class="h-100 d-flex align-items-center justify-content-between ps-0 d-flex rtl-flex-d-row-r">
                <li><a href="{{ route('home') }}"><i class="fa-solid fa-house"></i>Home</a></li>
                <li><a href="{{ route('web-profile') }}"><i class="fa-solid fa-user"></i>Profile</a></li>
                <li><a href="{{ route('web-kontak') }}"><i class="fa-solid fa-phone" aria-hidden="true"></i>Kontak</a>
                </li>
                <li><a href="{{ route('signout-user') }}"><i class="fa-solid fa-sign-out"
                            aria-hidden="true"></i>Logout</a>
                </li>
            </ul>
        </div>
    </div>
    {{-- <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.passwordstrength.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/theme-switching.js') }}"></script>
    <script src="{{ asset('frontend/js/active.js') }}"></script>
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
            alert("Selesai");
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
                theme: 'square', // basic, arrows, square, round, dots
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
                    extraHtml: `<button class="btn btn-success" id="btnFinish" disabled onclick="onConfirm()">Simpan</button>`
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

    @stack('js')
    @include('sweetalert::alert')
</body>

</html>
