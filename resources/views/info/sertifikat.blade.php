<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>E-Sertifikat</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('template_sertifikat') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('template_sertifikat') }}/assets/css/animate.min.css" rel="stylesheet" />
    <link href="{{ asset('template_sertifikat') }}/assets/css/style.min.css" rel="stylesheet" />
    <link href="{{ asset('template_sertifikat') }}/assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="{{ asset('template_sertifikat') }}/assets/plugins/font-awesome/css/font-awesome.min.css"
        rel="stylesheet" />

    <style>
        @import url(https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic);

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .border-pin {
            display: flex;
        }

        .num {
            color: #000;
            background-color: transparent;
            width: 17%;
            height: 60px;
            text-align: center;
            outline: none;
            padding: 1rem 1rem;
            margin: 0 1px;
            font-size: 24px;
            border: 1px solid rgba(0, 0, 0, 0.3);
            border-radius: .5rem;
            color: rgba(0, 0, 0, 0.5);
        }

        .num:focus,
        .num:valid {
            box-shadow: 0 0 .5rem rgba(20, 3, 255, 0.5);
            inset 0 0 .5rem rgba(20, 3, 255, 0.5);
            border-color: rgba(20, 3, 255, 0.5);
        }
    </style>
</head>

<body>
    <div id="page-container" class="page-container">
        <div id="content" class="content offset-md-2">
            <div class="row">
                <div class="col-md-offset-2 col-md-6 ">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                        <div class="panel-body">
                            @if ($laporan->status_laporan == 'Approved')
                                <center>
                                    <h4><b>Hi Welcome 👋</b> </h4>
                                    <p>The certificate can be downloaded by clicking the button below</p>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal"><i class="fa fa-download" aria-hidden="true"></i>
                                        Download Certificate
                                    </button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Enter PIN</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('download_e_sertifikat') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <div class="border-pin">
                                                                <input type="hidden" name="laporan_id"
                                                                    value="{{ $laporan->id }}">
                                                                <input type="hidden" name="faskes_id"
                                                                    value="{{ $laporan->faskes_id }}">

                                                                <input type="text" name="satu" class="num"
                                                                    autocomplete="off" maxlength="1" required>
                                                                <input type="text" name="dua" class="num"
                                                                    autocomplete="off" maxlength="1" required
                                                                    onkeypress="return onlyNumberKey(event)">
                                                                <input type="text" name="tiga" class="num"
                                                                    autocomplete="off" maxlength="1" required
                                                                    onkeypress="return onlyNumberKey(event)">
                                                                <input type="text" name="empat" class="num"
                                                                    autocomplete="off" maxlength="1" required
                                                                    onkeypress="return onlyNumberKey(event)">
                                                                <input type="text" name="lima" class="num"
                                                                    autocomplete="off" maxlength="1" required
                                                                    onkeypress="return onlyNumberKey(event)">
                                                                <input type="text" name="enam" class="num"
                                                                    autocomplete="off" maxlength="1" required
                                                                    onkeypress="return onlyNumberKey(event)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <p style="margin-top: 10px"><b>No Laporan : {{ $laporan->no_laporan }} </b></p>
                                </center>
                                <br>
                                <br>
                                <hr>
                                Powered by : <img src="{{ asset('frontend/img/logo.png') }}" alt=""
                                    style="width: 40%;">
                            @else
                                <center>
                                    <h4><b>Hi Welcome 👋</b> </h4>
                                    <h4 style="color: red"> <b>Sorry, Certificate not available</b> </h4>
                                </center>
                                <br>
                                <br>
                                <div class="alert alert-danger" role="alert">
                                    This is a danger alert—check it out!
                                </div>
                                <hr>
                                Powered by : <img src="{{ asset('frontend/img/logo.png') }}" alt=""
                                    style="width: 40%;">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade"
            data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    </div>
    <script src="{{ asset('template_sertifikat') }}/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
    <script src="{{ asset('template_sertifikat') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('template_sertifikat') }}/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('template_sertifikat') }}/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
    <script src="{{ asset('template_sertifikat') }}/assets/js/apps.min.js"></script>
    @include('sweetalert::alert')
</body>
</html>
<script>
    $(".num").keyup(function() {
        if (this.value.length == this.maxLength) {
            $(this).next('.num').focus();
        }
    });
</script>

<script>
    function onlyNumberKey(evt) {
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>
