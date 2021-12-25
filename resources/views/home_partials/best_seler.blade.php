<section>

    <div class="row h-100 d-flex justify-content-center">
        <div class="col-lg-7 mx-auto text-center mb-6">
            <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">More Products</h5>
        </div>

        <div class="row text-center d-flex justify-content-center">
            @foreach ($allProducts as $product)
                <div class=" col-6 col-sm-6 col-md-4 my-3">
                    <div class="card">
                        <img src="{{ asset('storage/product-image/sunglasses.png') }}" class="card-img-top img-fluid"
                            alt="...">
                        <div class="card-body">
                            <p class="card-text fs-2">{{ $product->name }}</p>
                            <p class="card-text fs-1">Rp.{{ $product->price }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</section>
