@extends('market.main')
@section('content')
    <section class="pt-8 pb-1 bg-light-gradient border-bottom border-white border-5">
        <div class="bg-holder overlay overlay-light">
        </div>
        <!--/.bg-holder-->

        <div class="container">
            <div class="row flex-center">
                <div class="col-12 mb-7">
                    <div class="">
                        <div class="row">
                            <div class="col-md-2 text-center text-md-start">
                                @if ($market->url_photo)
                                    <img src="{{ asset('uploads/' . $market->url_photo) }}" alt=""
                                        class="img-fluid rounded-circle col-md-12">
                                @else
                                    <img src="{{ asset('uploads/profile-image/toko.png') }}" alt=""
                                        class="img-fluid rounded-circle col-md-12">
                                @endif
                            </div>
                            <div class="col-md-10 text-center text-md-start mt-4">
                                <h4>{{ $market->name }}</h4>
                                <h6>{{ $market->created_at->locale('id_ID')->toFormattedDateString() }}</h6>
                                <h6 class="mt-4">{{ $market->product->count() }} Produk Terdaftar</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <section>
        <div class="container">
            <div class="row h-100 d-flex justify-content-center">
                <div class="col-lg-7 mx-auto text-center mb-6">
                    <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">More Products</h5>
                </div>

                <div class="row  d-flex justify-content-center">

                    @foreach ($products as $product)
                        <div class=" col-6 col-sm-6 col-md-4 my-3">
                            <a href="/product/{{ $product->slug }}">
                                <div class="card">
                                    <div class="tex-center">
                                        @if ($product->photo->count())
                                            <img src="{{ asset('uploads/' . $product->photo[0]->url) }}"
                                                class="card-img-top img-fluid" alt="...">
                                        @else
                                            <img src="{{ asset('uploads/product-image/no-pictures.png') }}"
                                                class="card-img-top img-fluid" alt="...">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <p> Toko : {{ $product->market->name }}</p>
                                        <p class="card-text fs-md-2">{{ $product->name }}</p>
                                        <p class="card-text fs-md-1">Rp.
                                            {{ number_format($product->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


    </section>



@endsection
