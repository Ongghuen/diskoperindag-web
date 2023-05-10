<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Diskoperindag - Login</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/tuansilat_logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="h-100">
    
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-5">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <div class="text-center">
                                    <img src="{{ asset('images/tuansilat-full.png') }}" width="380" alt="">
                                </div>
                                <form action="/login" method="POST" class="mt-5 mb-5 login-input">
                                    @csrf
                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control"
                                        value="{{ Session::get('email') }}" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control"
                                        value="{{ Session::get('password') }}" placeholder="Password" required>
                                    </div>
                                    <button type="submit" class="btn login-form__btn submit w-100">Sign In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>

@if (Session::get('belumlogin'))
    <script>
        swal("Opps Error", "Silahkan Login Dulu", "error");
    </script>
@endif

@if (Session::get('loginerror'))
    <script>
        swal("Opps Error", "Login Gagal", "error");
    </script>
@endif

@if (Session::get('bukanadmin'))
    <script>
        swal("Opps Error", "Anda Bukan Admin", "error");
    </script>
@endif

@if (Session::get('failed'))
    <script>
        swal("Opps Error", "Login Gagal", "error");
    </script>
@endif

@if (Session::get('logout'))
    <script>
        swal("Well Done", "Anda Berhasil Logout", "success");
    </script>
@endif
