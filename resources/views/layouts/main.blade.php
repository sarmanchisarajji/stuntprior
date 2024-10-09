<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @guest
        <title>Halaman Guest | STUNTPRIOR</title>
    @endguest

    @auth
        <title>Halaman Admin | STUNTPRIOR</title>
    @endauth

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('') }}/assets/css/bootstrap.css">

    <link rel="stylesheet" href="{{ url('') }}/assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="{{ url('') }}/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="{{ url('') }}/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ url('') }}/assets/css/app.css">
    <link rel="stylesheet" href="{{ url('') }}/assets/vendors/simple-datatables/style.css">

    <link rel="shortcut icon" href="{{ url('') }}/assets/auth/assets/images/favicon-32x32.png"
        type="image/x-icon">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

</head>

<body>
    <div id="app">

        @include('components.sidebar')

        <div id="main" class='layout-navbar'>

            @include('components.navbar')

            <div id="main-content">

                @yield('main-contents')

                @include('sweetalert::alert')

                @include('components.footer')

            </div>

        </div>
    </div>
    <script src="{{ url('') }}/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ url('') }}/assets/js/bootstrap.bundle.min.js"></script>

    <script src="{{ url('') }}/assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="{{ url('') }}/assets/js/pages/dashboard.js"></script>

    <script src="{{ url('') }}/assets/js/main.js"></script>

    <script src="{{ url('') }}/assets/vendors/simple-datatables/simple-datatables.js"></script>

    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
