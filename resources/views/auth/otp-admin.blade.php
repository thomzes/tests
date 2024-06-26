<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CBB Admin - Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset("vendor/fontawesome-free/css/all.min.css") }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('login/css/bootstrap.min.css') }}">
	<!-- Fontawesome CSS -->
	{{-- <link rel="stylesheet" href="{{ asset('login/css/fontawesome-all.min.css') }}"> --}}
	<!-- Flaticon CSS -->
    <!-- App favicon -->
    <!--<link rel="shortcut icon" href="{{ asset('assets/logo.png') }}">-->

    <link href="{{ asset("css/sb-admin-2.min.css") }}" rel="stylesheet">
    <!-- Global stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/toastr.min.css') }}">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="{{ asset('assets/js/custom.js') }}"></script>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Verify OTP</h1>
                                    </div>
                                    <form method="post" action="{{ route("verifyOtpProcess") }}" id="otpForm" class="user myForm">
                                        @csrf()
                                        <div class="form-group">
                                            <label for="">Enter Your OTP</label>
                                            <input type="text" name="otp" class="form-control form-control-user" maxlength="6"
                                                id="otp" aria-describedby="emailHelp"
                                                placeholder="OTP">
                                        </div>
                                        <button type="submit" id="submitForm" class="btn btn-primary btn-user btn-block">
                                            Continue
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset("vendor/jquery/jquery.min.js") }}"></script>
    <script src="{{ asset("vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>

    <!-- jquery-->
	<script src="{{ asset('login/js/jquery-3.5.0.min.js') }}"></script>
	<!-- Bootstrap js -->
	<script src="{{ asset('login/js/bootstrap.min.js') }}"></script>
	<!-- Imagesloaded js -->
	<script src="{{ asset('login/js/imagesloaded.pkgd.min.js') }}"></script>
	<!-- Validator js -->
	<script src="{{ asset('login/js/validator.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset("vendor/jquery-easing/jquery.easing.min.js") }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset("js/sb-admin-2.min.js") }}"></script>

</body>

</html>