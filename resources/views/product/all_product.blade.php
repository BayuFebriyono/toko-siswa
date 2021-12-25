<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Document</title>
</head>

<body>
    @include('home_partials.navbar')

    {{-- Content --}}
    <section class="mt-3 mt-md-5 p-0 pt-6">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-6">
                    <p>Hasil Pencarian Ditemukan {{ $products->count() }} Produk</p>
                </div>
                <div class="col-md-6">
                    <form action="/category-show/" method="GET">

                        @method('GET')
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                        <div class="row">
                            <div class="col-md-4 mt-2">
                                <p>Urutkan Berdasarkan</p>
                            </div>
                            <div class="col-md-4 mt-2">
                                <select name="sortir" class="form-select">
                                    <option value="created_at" {{ $selected == 'created_at' ? 'selected' : '' }}>
                                        Terbaru</option>
                                    <option value="price" {{ $selected == 'price' ? 'selected' : '' }}>Harga</option>

                                </select>
                            </div>
                            <div class="col-md-4 text-center mt-2">
                                <button class="btn btn-success p-0 p-2" type="submit">Terapkan</button>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Barang --}}
    <div class="container">
        @if ($products->count())
            <div class="row mt-6">
                @foreach ($products as $product)
                    <div class="col-6 col-md-3 mt-3">
                        <a href="/product/{{ $product->slug }}">
                            <div class="card">
                                @if ($product->photo->count())
                                    <img src="{{ asset('uploads/' . $product->photo[0]->url) }}"
                                        class="card-img-top" alt="...">
                                @else
                                    <img src="{{ asset('uploads/product-image/no-pictures.png') }}"
                                        class="card-img-top" alt="...">
                                @endif

                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">Rp. {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="container text-center mt-3">
                <img src="{{ asset('assets/img/gallery/no-data.png') }}" alt="" class="img-fluid">
            </div>
        @endif


    </div>
    @include('footer.index')



    <script src="/vendors/@popperjs/popper.min.js"></script>
    <script src="/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="/vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="/vendors/feather-icons/feather.min.js"></script>
    <script>
        feather.replace();
    </script>
    <script src="/assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
</body>

</html>
