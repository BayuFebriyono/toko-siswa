<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Profile</title>
    {{-- Stylesheet --}}
    <link href="/assets/css/theme.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/crop.min.css') }}">
    <style>
        .image-upload>input {
            display: none;
        }

    </style>
</head>

<body>
    
    @include('home_partials.navbar')
    <!-- Modal -->
    <div class="modal fade " id="marketModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeader">Ubah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/edit-toko/{{ auth()->user()->market->slug }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Nama Toko" name="name" required>
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

    <!-- Modal Tambah Produk -->
    <div class="modal fade " id="produkModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeader">Tambah Produk Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/product" method="POST">
                    @csrf
                    <input type="hidden" name="market_id" value="{{ $market->id }}">
                    <div class="modal-body">
                        <input type="text" class="form-control mt-2" placeholder="Nama Produk" name="name" required>
                        <input type="number" class="form-control mt-2" placeholder="Harga Produk" name="price"
                            id="tbPrice" required onchange="cekHarga()">
                        <input type="number" class="form-control mt-2" placeholder="Stock Barang" name="stock" required>
                        <input type="text" class="form-control mt-2" placeholder="Berat (Kg)" name="berat" required>
                        <label for="category" class="mt-2">Kategori</label>
                        <select name="category_id" class="form-select" id="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="desc" class="mt-2">Deskripsi</label>
                        <textarea name="description" id="desc" rows="3" class="form-control"></textarea>
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
    <section class="pt-8 pb-1 bg-light-gradient border-bottom border-white border-5">
        <div class="bg-holder overlay overlay-light">
        </div>
        <!--/.bg-holder-->

        <div class="container">

            <div class="row ">
                <div class="col-12 mb-7">
                    <div class="">
                        <div class="row">
                            <div class="col-md-2">
                                @if ($market->url_photo)
                                    <img src="{{ asset('uploads/' . $market->url_photo) }}" alt=""
                                        class="img-fluid rounded-circle col-md-12">
                                @else
                                    <img src="{{ asset('uploads/profile-image/toko.png') }}" alt=""
                                        class="img-fluid rounded-circle col-md-12">
                                @endif
                            </div>
                            <div class="col-md-10 mt-3 text-center text-md-start">
                                {{-- Flash Data --}}
                                @error('name')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> {{ $message }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>

                                @enderror
                                {{-- Flash Data Description --}}
                                @error('description')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> {{ $message }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>

                                @enderror

                                {{-- Flash Data Berat --}}
                                @error('berat')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> {{ $message }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>

                                @enderror

                                {{-- Flash Data Sukses --}}
                                @if (session('success'))
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <strong>Sukses!</strong> {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <h4 class="text-center text-md-start">{{ $market->name }}</h4>
                                <h6 class="text-center text-md-start">
                                    {{ $market->created_at->locale('id_ID')->toFormattedDateString() }}</h6>
                                <h6 class="mt-4 text-center text-md-start">{{ $market->product->count() }} Produk
                                    Terdaftar</h6>
                                <a href="" class="btn btn-dark mt-3" data-bs-toggle="modal"
                                    data-bs-target="#produkModal">Tambah Produk</a>
                                <a href="" class="btn btn-dark  mt-3" data-bs-toggle="modal"
                                    data-bs-target="#marketModal">Ubah
                                    Nama Toko</a>
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
                @livewireStyles

              {{-- Posisi Live  --}}
              <livewire:market-products>
            </div>
        </div>


    </section>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/crop.min.js') }}"></script>
    <script>
        const tbPrice = document.getElementById('tbPrice')

        function cekHarga() {
            let harga = tbPrice.value
            if (harga < 1000) {
                tbPrice.value = 1000
            }
        }
    </script>
    @livewireScripts

</body>

</html>
