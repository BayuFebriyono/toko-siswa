<div>
    <div class="row  d-flex justify-content-center">
        @foreach ($products as $product)
            <div class=" col-6 col-sm-6 col-md-4 my-3">
                <a href="/product/{{ $product->slug }}/edit ">
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
                            <p>Toko : {{ $product->market->name }}</p>
                            <p class="card-text fs-md-2">{{ \Illuminate\Support\Str::limit($product->name, 10, $end = '...') }}</p>
                            <p class="card-text fs-md-1">Rp.{{ $product->price }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
        {{ $products->links() }}
    </div>
</div>
