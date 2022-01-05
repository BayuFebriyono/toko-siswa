@extends('product.layout_show')
@section('content')
    <!-- Demo styles -->
    @livewireStyles
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7 col-lg-5">
                @if ($photos->count())
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                        <div class="swiper-wrapper">
                            @foreach ($photos as $photo)
                                <div class="swiper-slide" >
                                        <img src="{{ asset('uploads/' . $photo->url) }}" class="img-fluid" />
                                    </div>
                                
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <div thumbsSlider="" class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($photos as $photo)
                                <div class="swiper-slide">
                                    <img src="{{ asset('uploads/' . $photo->url) }}" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ asset('uploads/product-image/no-pictures.png') }}" />
                        </div>
                    </div>
                @endif

            </div>
            {{-- Start Modal Box --}}
            <!-- Modal -->
            <div class="modal fade " id="marketModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalHeader">Masukkan jumlah</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="/cart" method="POST">
                            @csrf
                            <input type="hidden" name="id_product" value="{{ $product->id }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <div class="modal-body">
                                <input type="number" class="form-control" placeholder="Jumlah" id="jumlah" name="jumlah"
                                    onchange="cekJumlah()" required>
                            </div>
                            <div class="modal-footer d-flex justify-content-start">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" onclick="return cekJumlah()">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End Modal Box --}}
            <div class="col-12 col-md-5 col-lg-5">
                @if (session('success'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Sukses</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                @endif
                <h2>{{ $product->name }}</h2>
                <a href="/market/show/{{ $product->market->slug }}">
                    <div class="row my-4">
                        <div class="col-3 col-md-3">
                            @if ($product->market->url_photo)
                                <img src="{{ asset('uploads/' . $product->market->url_photo) }}" alt=""
                                    class="img-fluid rounded-circle">
                            @else
                                <img src="{{ asset('uploads/profile-image/toko.png') }}" alt=""
                                    class="img-fluid rounded-circle">
                            @endif
                        </div>
                        <div class="col-9 col-md-9">
                            <p class="d-inline fs-3">{{ $product->market->name }}</p>
                            <p class="fs-1">Dibuat
                                {{ $product->market->created_at->locale('id_ID')->toFormattedDateString() }}</p>
                        </div>
                    </div>
                </a>
                <h5 class="my-3">Rp. {{ number_format($product->price, 0, ',', '.') }}</h5>
                <hr class="hr">
                <p class="fs-1">Kategori : {{ $product->category->name }}</p>
                <p class="fs-1">Stock : {{ $product->stock }}</p>
                <p class="fs-1">{{ $product->description }}</p>
                <form action="">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#marketModal">Tambah Ke Keranjang</button>
                </form>
            </div>

            <hr class="mt-5">
            <h3 class="mt-3">Komentar</h3>

            <livewire:comment :product="$product">

        </div>

        <livewire:products-data>

    </div>

    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });

        function cekJumlah() {
            const stock = {{ $product->stock }}
            const jumlah = document.getElementById('jumlah');

            if (jumlah.value < 1) {
                jumlah.value = 1;
            }

            if (jumlah.value > stock) {
                jumlah.value = stock;
            }

            if (stock == 0) {
                return false;
            }

            return true;
        }
    </script>

    @livewireScripts
    <script type="text/javascript">
        document.getElementById('btn-load').onclick = function() {
            window.livewire.emit('product-data');
        };
    </script>

@endsection
