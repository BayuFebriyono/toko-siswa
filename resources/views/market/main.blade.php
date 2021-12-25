<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Market Detail</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="shortcut icon" href="{{ asset('assets/img/icons/icon.ico') }}">

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="/assets/css/theme.css" rel="stylesheet" />
    <link href="{{ asset('assets/img/favicons/manifest.json') }}" rel="stylesheet" />
    <style>
        .gambar {
            width: auto;
            /* You can set the dimensions to whatever you want */
            height: 790px;
            object-fit: cover;
        }

    </style>
    {{-- <script src="assets/css/splide.min.css"></script> --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    @livewireStyles


</head>


<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">

        @include('home_partials.navbar')
        @yield('content')

        <!-- ============================================-->
        <!-- <section> begin ============================-->

        <script src="{{ asset('vendors/@popperjs/popper.min.js') }}"></script>
        <script src="{{ asset('vendors/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('vendors/is/is.min.js') }}"></script>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
        <script src="{{ asset('vendors/feather-icons/feather.min.js') }}"></script>
        <script>
            feather.replace();
        </script>
        <script src="{{ asset('assets/js/theme.js') }}"></script>

        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@200;300;400;500;600;700;800;900&amp;display=swap"
            rel="stylesheet">


        <script>
            feather.replace()
            var swiper = new Swiper('.mySwiper', {
                // Default parameters
                slidesPerView: 1,
                spaceBetween: 10,
                // Responsive breakpoints
                breakpoints: {
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    },


                    // when window width is >= 640px
                    1000: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    }
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                loop: true
            })
        </script>
        @livewireScripts
        <script type="text/javascript">
            document.getElementById('btn-load').onclick = function() {
                window.livewire.emit('market-data');
            };
        </script>
</body>

</html>
