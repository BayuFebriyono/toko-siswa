<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Marketplace | Home</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="shortcut icon" href="{{ asset('assets/img/icons/icon.ico') }}">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="assets/css/theme.css" rel="stylesheet" />
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


        <section class="mt-1">
            <div class="container">
                {{-- <div class="row h-100 g-0">
                    <div class="col-md-6">
                        <div class="bg-300 p-4 h-100 d-flex flex-column justify-content-center">
                            <h4 class="text-800">Exclusive collection 2021</h4>
                            <h1 class="fw-semi-bold lh-sm fs-4 fs-lg-5 fs-xl-6">Be exclusive</h1>
                            <p class="mb-5 fs-1">The best everyday option in a Super Saver range within a
                                reasonable price. It is our responsibility to keep you 100 percent stylish. Be smart
                                &amp; , trendy with us.</p>
                            <div class="d-grid gap-2 d-md-block"><a class="btn btn-lg btn-dark" href="#"
                                    role="button">Explore</a></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-span h-100 text-white"><img class="card-img h-100"
                                src="assets/img/gallery/siswa.jpg" alt="..." />
                            <div class="card-img-overlay bg-dark-gradient">
                            </div>
                        </div>
                    </div>
                </div> --}}
                <img src="{{ asset('assets/img/gallery/main-banner.png') }}" alt=""
                    class="img-fluid d-none d-md-inline">
                <img src="{{ asset('assets/img/gallery/banner-hp-02.png') }}" alt=""
                    class="img-fluid d-inline d-md-none">

                {{-- Kategori --}}
                <h1 class=" mb-3 fs-3 mt-5 mb-4">Kategori</h1>
                <div class="container d-flex justify-content-center">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper text-center">
                            @include('home_partials.category')
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <livewire:products-data>
        </section>


        {{-- @include('home_partials.best_seler') --}}
        <div class="container">

        </div>


    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
    @include('footer.index')



    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="vendors/@popperjs/popper.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.min.js"></script>
    <script src="vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="vendors/feather-icons/feather.min.js"></script>
    <script>
        feather.replace();
    </script>
    <script src="assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">


    <script>
        feather.replace()
        // var swiper = new Swiper(".mySwiper", {
        //   slidesPerView: 2,
        //   spaceBetween: 60,
        //   slidesPerGroup: 2,
        //   loop: true,
        //   loopFillGroupWithBlank: true,
        //   pagination: {
        //     el: ".swiper-pagination",
        //     clickable: true,
        //   },
        //   navigation: {
        //     nextEl: ".swiper-button-next",
        //     prevEl: ".swiper-button-prev",
        //   },
        // });
        var swiper = new Swiper('.mySwiper', {
            // Default parameters
            slidesPerView: 1,
            spaceBetween: 10,
            // Responsive breakpoints
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 3,
                    spaceBetween: 10
                },


                // when window width is >= 640px
                1000: {
                    slidesPerView: 5,
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
            window.livewire.emit('product-data');
        };
    </script>
</body>

</html>
