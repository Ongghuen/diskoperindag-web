<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Situansilat - Login</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/tuansilat_logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
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
                                    <img src="{{ asset('images/tuansilat-full.png') }}" width="300" alt="">
                                </div>
                                <form action="/login" method="POST" class="mt-5 mb-5 login-input">
                                    @csrf
                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control"
                                        value="{{ old('email') }}" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control"
                                        value="{{ old('password') }}" placeholder="Password" required>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>

</html>

@if (Session::get('belumlogin'))
    <script>
        Toastify({
            text: "    Anda belum login ! ",
            duration: 3000,
            close: true,
            stopOnFocus: true,
            avatar: "{{ asset('images/error.png') }}",
            style: {
                background: "linear-gradient(to right, #BE2525, #BE4525)",
            },
            }).showToast()
    </script>
@endif

@if (Session::get('loginerror'))
    <script>
        Toastify({
            text: "    Login gagal ! ",
            duration: 3000,
            close: true,
            stopOnFocus: true,
            avatar: "{{ asset('images/error.png') }}",
            style: {
                background: "linear-gradient(to right, #BE2525, #BE4525)",
            },
            }).showToast()
    </script>
@endif

@if (Session::get('bukanadmin'))
<script>
    Toastify({
        text: "    Hanya admin yang boleh masuk ! ",
        duration: 3000,
        close: true,
        stopOnFocus: true,
        avatar: "{{ asset('images/error.png') }}",
        style: {
            background: "linear-gradient(to right, #BE2525, #BE4525)",
        },
        }).showToast();
</script>
@endif

@if (Session::get('failed'))
    <script>
        Toastify({
            text: "    Login gagal ! ",
            duration: 3000,
            close: true,
            stopOnFocus: true,
            avatar: "{{ asset('images/error.png') }}",
            style: {
                background: "linear-gradient(to right, #BE2525, #BE4525)",
            },
            }).showToast();
    </script>
@endif

@if (Session::get('logout'))
<script>
    Toastify({
        text: "    Berhasil logout ! ",
        duration: 3000,
        close: true,
        stopOnFocus: true,
        avatar: "{{ asset('images/success.png') }}",
        style: {
            background: "linear-gradient(to right, #25BE60, #25BE45)",
        },
        }).showToast();
</script>
@endif
