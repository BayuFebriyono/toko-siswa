<div>
    <div class="row  d-flex justify-content-center">
        <div class="conteiner">
            <input class="form-control mb-3" type="text" wire:model="search" placeholder="Cari Nama Barang" aria-label="search">
        </div>
        @if ($products->count())
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
                                <p class="card-text fs-md-2">
                                    {{ \Illuminate\Support\Str::limit($product->name, 10, $end = '...') }}</p>
                                <p class="card-text fs-md-1">Rp.{{ $product->price }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            {{ $products->links() }}
        @else
        <div class="col-md-6 text-center">
            <img src="{{ asset('assets/img/gallery/no-data.png') }}" alt="no-data" class="img-fluid">
        </div>
            <h3 class="text-center mt-5">Data Tidak Ditemukan</h3>
        @endif
    </div>
</div>
