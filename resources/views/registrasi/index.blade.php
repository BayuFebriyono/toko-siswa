<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign In</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="assets/login/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/login/css/main.css">
    <!--===============================================================================================-->
</head>

<body style="background-color: #666666;">

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" action="/registrasi" method="POST">
                    @csrf
                    <span class="login100-form-title p-b-43">
                        Buat Akun Baru Anda
                    </span>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="wrap-input100 validate-input" data-validate="Username Wajib Diisi">
                        <input class="input100" type="text" name="username" value="{{ old('username') }}">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Username</span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Email Wajib Diisi">
                        <input class="input100" type="text" name="email" value="{{ old('email') }}">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Email</span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Name Wajib Diisi">
                        <input class="input100" type="text" name="name" value="{{ old('name') }}">
                        <span class="focus-input100"></span> 
                        <span class="label-input100">Nama</span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="NIK Wajib Diisi">
                        <input class="input100" type="number" name="nik" {{ old('nik') }}>
                        <span class="focus-input100"></span>
                        <span class="label-input100">Nik</span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Password Wajib Diisi">
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                    </div>

                    <p class="text-center my-3">Sudah memiliki akun? <a href="/login" class="text-info">Masuk
                            disini</a></p>


                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Buat Akun
                        </button>
                    </div>

                </form>

                <div class="login100-more" style="background-image: url('assets/login/images/bg-01.jpg');">
                </div>
            </div>
        </div>
    </div>





    <!--===============================================================================================-->
    <script src="assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/login/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/login/vendor/bootstrap/js/popper.js"></script>
    <script src="assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/login/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/login/vendor/daterangepicker/moment.min.js"></script>
    <script src="assets/login/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="assets/login/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="assets/login/js/main.js"></script>

</body>

</html>
