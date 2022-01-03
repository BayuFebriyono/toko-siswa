@extends('product.layout_show')
@section('content')
    <!-- Demo styles -->

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4">
                @if ($photos->count())
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                        <div class="swiper-wrapper">
                            @foreach ($photos as $photo)
                                <div class="swiper-slide">
                                    <form action="/product/deletePhoto/{{ $photo->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <label for="gambar-hapus{{ $loop->iteration }}">
                                            <img src="{{ asset('uploads/' . $photo->url) }}" />
                                        </label>
                                        <button type="submit" class="border-0"
                                            id="gambar-hapus{{ $loop->iteration }}"
                                            onclick="return confirm('Yakin ingin hapus foto?')"> </button>
                                    </form>

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
            <!-- Modal Tambah Produk -->
            <div class="modal fade " id="produkModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalHeader">Edit Produk </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="/product/{{ $product->slug }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="modal-body">
                                <input type="text" class="form-control mt-2" placeholder="Nama Produk" name="name"
                                    value="{{ $product->name }}" required>
                                <input type="number" class="form-control mt-2" placeholder="Stok Barang" name="stock" value="{{ $product->stock }}" required>
                                <input type="number" class="form-control mt-2" placeholder="Harga Produk" name="price"
                                    id="tbPrice" value="{{ $product->price }}" required onchange="cekHarga()">
                                <label for="category" class="mt-2">Kategori</label>
                                <select name="category_id" class="form-select" id="category">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <label for="desc" class="mt-2">Deskripsi</label>
                                <textarea name="description" id="desc" rows="3"
                                    class="form-control">{{ $product->description }}</textarea>
                            </div>
                            <div class="modal-footer d-flex justify-content-start">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End Modal Box --}}

            <div class="col-12 col-md-5">
                {{-- Session Area --}}

                {{-- Flash Data --}}
                @error('name')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                @enderror
                {{-- Flash Data Description --}}
                @error('description')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                @enderror


                {{-- End Session Area --}}
                @if (session('success'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Sukses</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                @endif
                <h2 class="mt-4">{{ $product->name }}</h2>
                {{-- button hapus --}}
                <form action="/product/{{ $product->slug }}" class="d-inline" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger" type="submit"
                        onclick="return confirm('Yakin ingin hapus produk?')">Hapus</button>
                </form>
                {{-- End --}}

                {{-- Button Edit --}}
                <a href="" class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#produkModal">Edit</a>
                {{-- End --}}



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
                <h5 class="my-3">Rp. {{ $product->price }}</h5>
                <hr class="hr">
                <p class="fs-1">Kategori : {{ $product->category->name }}</p>
                <p class="fs-1">Stok : {{ $product->stock }}</p>
                <p class="fs-1">{{ $product->description }}</p>
                {{-- Icon Ubah Foto --}}
                <form action="" class="d-inline p-6">
                    <div class="image-upload">
                        <label for="file-input">
                            <a class="btn btn-success text-white rounded-3">Tambah Foto</a>
                        </label>

                        <input id="file-input" type="file" name="url" />
                    </div>
                </form>
                {{-- End Icon --}}



            </div>
        </div>
        @livewireStyles
        <div class="row  d-flex justify-content-center">

            <h2 class="text-center my-5">Produk Saya yang lain</h2>
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
                                <p> <b>Toko : {{ $product->market->name }}</b></p>
                                <p class="card-text fs-2">{{ $product->name }}</p>
                                <p class="card-text fs-1">Rp.{{ $product->price }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

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
    </script>
    <script>
        $('#file-input').ijaboCropTool({
            preview: '.image-previewer',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['CROP', 'QUIT'],
            buttonsColor: ['#30bf7d', '#ee5155', -15],
            processUrl: '{{ route('productPhoto') }}',
            withCSRF: ['_token', '{{ csrf_token() }}'],
            onSuccess: function(message, element, status) {
                alert(message);
                window.location.reload();
            },
            onError: function(message, element, status) {
                alert('Ukuran Maksimal 1 mb dan file harus jpg atau png');
            }
        });
    </script>



@endsection
