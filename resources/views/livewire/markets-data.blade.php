<div class="container">
    <div class="row h-100 d-flex justify-content-center">

        <div class="row  d-flex justify-content-center">
            @foreach ($allMarkets as $market)
                <div class=" col-6 col-sm-6 col-md-3 my-3">
                    <a href="/market/show/{{ $market->slug }}">
                        <div class="card rounded">
                            <div class="tex-center ">
                                @if ($market->url_photo)
                                    <img src="{{ asset('uploads/' . $market->url_photo) }}"
                                        class="card-img-top img-fluid p-3 rounded-circle" alt="...">
                                @else
                                    <img src="{{ asset('uploads/profile-image/toko.png') }}"
                                        class="card-img-top img-fluid p-3 rounded-circle" alt="...">
                                @endif
                            </div>
                            <div class="card-body text-center">
                                <p class="card-text fs-2">{{ $market->name }}</p>
                                <p class="card-text ">
                                    {{ $market->created_at->locale('id_ID')->toFormattedDateString() }}</p>
                                <p>{{ $market->product->count() }} Produk Di etalase</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            <div wire:loading>
                <div class="text-center">
                    <div class="spinner-border text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <button id="btn-load" class="btn btn-dark">Load More</button>
            </div>
        </div>
    </div>
</div>
