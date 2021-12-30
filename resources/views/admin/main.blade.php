<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/assets/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/assets/css/app.css') }}">
    <link href="{{ asset('assets/css/lightbox.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div id="app">
        @include('admin.navbar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i data-feather="align-justify"></i>
                </a>
            </header>


            <div class="page-content">
                @yield('content')
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                </div>
            </footer>
        </div>
    </div>
    <script>
        feather.replace()
    </script>
    <script src="{{ asset('assets/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/lightbox.min.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
</body>

</html>
