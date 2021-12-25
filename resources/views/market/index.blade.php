@extends('market.main')
@section('content')
    <section class="py-11 bg-light-gradient border-bottom border-white border-5">
        <div class="bg-holder overlay overlay-light"
            style="background-image:url(assets/img/gallery/header-bg.png);background-size:cover;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
            <div class="row flex-center">
                <div class="col-12 mb-7">
                    <div class="d-flex align-items-center flex-column">
                        <h1 class="fw-normal"> Daftar Toko Terdaftar</h1>
                    </div>
                </div>
            </div>
            <div class="row h-100 g-0">
                <div class="col-md-6">
                    <div class="bg-300 p-4 h-100 d-flex flex-column justify-content-center">
                        <h4 class="text-800">Daftar Toko Terbaru</h4>
                        <h1 class="fw-semi-bold lh-sm fs-4 fs-lg-5 fs-xl-6">Support Mereka</h1>
                        <p class="mb-5 fs-1">Dibawah ini merupakan toko yang dibuat oleh para siswa support mereka
                            dengan membeli
                            beberapa produk mereka.</p>
                        <div class="d-grid gap-2 d-md-block"><a class="btn btn-lg btn-dark" href="#market"
                                role="button">Explore</a></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-span h-100 text-white"><img class="card-img h-100"
                            src="assets/img/gallery/market-hero.jpg" alt="..." />
                        <div class="card-img-overlay bg-dark-gradient">
                            <div class="d-flex align-items-end justify-content-center h-100"></div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section id="market">
        <h2 class="text-center mb-4">List Toko</h2>
        <livewire:markets-data>
    </section>


@endsection
