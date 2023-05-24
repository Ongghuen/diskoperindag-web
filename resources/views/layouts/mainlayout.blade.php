<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Situansilat - @yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/tuansilat_logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatablesbutton.css') }}">
    <link href="{{ asset('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.signature.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
        integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

    @yield('css')

</head>

<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <div id="main-wrapper">
        @include('partials.header')
        @include('partials.navbar')
        @include('partials.sidebar')
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        $(document).ready(function() {
            $('select').selectize({
                sortField: 'text'
            });
        });
    </script>
    <script>
        document.getElementById('toggle-password1').addEventListener('click', function() {
            var passwordInput = document.getElementsByName('old_password')[0];
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.querySelector('i').classList.remove('fa-eye');
                this.querySelector('i').classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                this.querySelector('i').classList.remove('fa-eye-slash');
                this.querySelector('i').classList.add('fa-eye');
            }
        });

        document.getElementById('toggle-password2').addEventListener('click', function() {
            var passwordInput = document.getElementsByName('new_password')[0];
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.querySelector('i').classList.remove('fa-eye');
                this.querySelector('i').classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                this.querySelector('i').classList.remove('fa-eye-slash');
                this.querySelector('i').classList.add('fa-eye');
            }
        });

        document.getElementById('toggle-password3').addEventListener('click', function() {
            var passwordInput = document.getElementsByName('new_password_confirmation')[0];
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.querySelector('i').classList.remove('fa-eye');
                this.querySelector('i').classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                this.querySelector('i').classList.remove('fa-eye-slash');
                this.querySelector('i').classList.add('fa-eye');
            }
        });
    </script>

    <script src="{{ asset('plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/gleek.js') }}"></script>
    <script src="{{ asset('js/styleSwitcher.js') }}"></script>

    <script src="{{ asset('plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

    <script src="{{ asset('plugins/moment/moment.js') }}"></script>
    <!-- Chartjs -->
    <script src="{{ asset('plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Circle progress -->
    <script src="{{ asset('plugins/circle-progress/circle-progress.min.js') }}"></script>
    <!-- Datamap -->
    <script src="{{ asset('plugins/d3v3/index.js') }}"></script>
    <script src="{{ asset('plugins/topojson/topojson.min.js') }}"></script>
    <script src="{{ asset('plugins/datamaps/datamaps.world.min.js') }}"></script>
    <!-- Morrisjs -->
    <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
    <!-- Pignose Calender -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <!-- ChartistJS -->
    <script src="{{ asset('plugins/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ asset('plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/signature_pad.min.js') }}"></script>

    @yield('script')

</body>

</html>

@if (Session::get('update'))
    <script>
        Toastify({
            text: "    Data berhasil diupdate ! ",
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

@if (Session::get('delete'))
    <script>
        Toastify({
            text: "    Data berhasil dihapus ! ",
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

@if (Session::get('gagal'))
    <script>
        Toastify({
            text: "    Gagal dihapus, data dibutuhkan untuk laporan ! ",
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

@if (Session::get('nameexists'))
    <script>
        Toastify({
            text: "    Nama bantuan sudah ada, silahkan gunakan nama lain ! ",
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

@if (Session::get('gagaladditem'))
    <script>
        Toastify({
            text: "    Alat gagal ditambahkan, silahkan coba lagi ! ",
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

@if (Session::get('gagaledititem'))
    <script>
        Toastify({
            text: "    Qty gagal diubah, silahkan coba lagi ! ",
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

@if (Session::get('create'))
    <script>
        Toastify({
            text: "    Data berhasil ditambahkan ! ",
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

@if (Session::get('createNotif'))
    <script>
        Toastify({
            text: "    Notifikasi berhasil dikirim ! ",
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

@if (Session::get('notifGagal'))
    <script>
        Toastify({
            text: "    User belum mempunyai token! ",
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

@if (Session::get('restore'))
    <script>
        Toastify({
            text: "    Berita berhasil dipulihkan ! ",
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

@if (Session::get('resetPw'))
    <script>
        Toastify({
            text: "    Password berhasil direset ! ",
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

@if (Session::get('autocreate'))
    <script>
        Toastify({
            text: "    Data berhasil ditambahkan ! ",
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

@if (Session::get('loginberhasil'))
    <script>
        Toastify({
            text: "    Selamat anda berhasil login ! ",
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

@if (Session::get('andasiapa'))
    <script>
        Toastify({
            text: "    Anda bukan superadmin ! ",
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

@if (Session::get('cp_succes'))
    <script>
        Toastify({
            text: "    Password berhasil diganti ! ",
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

@if (Session::get('sudahlogin'))
    <script>
        Toastify({
            text: "    Silahkan logout terlebih dahulu ! ",
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

@if (Session::get('current_password'))
    <script>
        Toastify({
            text: "    Password lama salah ! ",
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

@if (Session::get('deleteFail'))
    <script>
        Toastify({
            text: "    Belum ada data yang dipilih ! ",
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
