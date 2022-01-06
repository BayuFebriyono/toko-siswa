<section>
    <style>
        .checked {
            color: orange;
        }

    </style>
    <div class="row h-100 d-flex justify-content-center">
        <h4 class="fs-3">Produk Terbaru</h4>

        <div class="row  d-flex justify-content-center">
            @foreach ($allProducts as $product)
                <div class=" col-6 col-sm-6 col-md-6 col-lg-3 my-3">
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
                                <p class="card-text ">
                                    {{ \Illuminate\Support\Str::limit($product->name, 10, $end = '...') }}</p>
                                @if ($product->comment->count())
                                    <div class="">
                                        <span
                                            class="fa fa-star {{ round($product->comment->sum('star') / $product->comment->count()) == 1 || round($product->comment->sum('star') / $product->comment->count()) == 2 || round($product->comment->sum('star') / $product->comment->count()) == 3 || round($product->comment->sum('star') / $product->comment->count()) == 4 || round($product->comment->sum('star') / $product->comment->count()) == 5 ? 'checked' : '' }}"></span>
                                        <span
                                            class="fa fa-star {{ round($product->comment->sum('star') / $product->comment->count()) == 2 || round($product->comment->sum('star') / $product->comment->count()) == 3 || round($product->comment->sum('star') / $product->comment->count()) == 4 || round($product->comment->sum('star') / $product->comment->count()) == 5 ? 'checked' : '' }}"></span>
                                        <span
                                            class="fa fa-star {{ round($product->comment->sum('star') / $product->comment->count()) == 3 || round($product->comment->sum('star') / $product->comment->count()) == 4 || round($product->comment->sum('star') / $product->comment->count()) == 5 ? 'checked' : '' }}"></span>
                                        <span
                                            class="fa fa-star {{ round($product->comment->sum('star') / $product->comment->count()) == 4 || round($product->comment->sum('star') / $product->comment->count()) == 5 ? 'checked' : '' }}"></span>
                                        <span
                                            class="fa fa-star {{ round($product->comment->sum('star') / $product->comment->count()) == 5 ? 'checked' : '' }}"></span>
                                    </div>
                                @else
                                    <p class="text-muted">Belum Ada Rating</p>
                                @endif
                                <p class="card-text fs-md-2">Rp.{{ number_format($product->price, 0, ',', '.') }}</p>
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



</section>
