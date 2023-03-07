<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Diskoperindag | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="icon" href="{{ asset("images/diskoperindag.png") }}" sizes="32x32" />
    <link rel="stylesheet" href={{ asset("vendors/mdi/css/materialdesignicons.min.css") }}>
    <link rel="stylesheet" href={{ asset("vendors/base/vendor.bundle.base.css") }}>
    <link rel="stylesheet" href={{ asset("vendors/datatables.net-bs4/dataTables.bootstrap4.css") }}>
    <link rel="stylesheet" href={{ asset("css/style.css") }}>
</head>
<body>

    @include('partials.navbar')

    <script src={{ asset("vendors/base/vendor.bundle.base.js") }}></script>
    <script src={{ asset("vendors/chart.js/Chart.min.js") }}></script>
    <script src={{ asset("vendors/datatables.net/jquery.dataTables.js") }}></script>
    <script src={{ asset("vendors/datatables.net-bs4/dataTables.bootstrap4.js") }}></script>
    <script src={{ asset("js/off-canvas.js") }}></script>
    <script src={{ asset("js/hoverable-collapse.js") }}></script>
    <script src={{ asset("js/template.js") }}></script>
    <script src={{ asset("js/dashboard.js") }}></script>
    <script src={{ asset("js/data-table.js") }}></script>
    <script src={{ asset("js/jquery.dataTables.js") }}></script>
    <script src={{ asset("js/dataTables.bootstrap4.js") }}></script>
    <script src={{ asset("js/jquery.cookie.js") }} type="text/javascript"></script>
    <script src="httaps://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>