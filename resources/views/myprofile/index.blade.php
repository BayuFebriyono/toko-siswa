<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Profile</title>
    {{-- Stylesheet --}}
    <link href="assets/css/theme.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/crop.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        .image-upload>input {
            display: none;
        }

    </style>
</head>

<body>
    @include('home_partials.navbar')

    <section class="py-8 ">
        {{-- <div class="bg-holder overlay overlay-light"
            style="background-image:url(assets/img/gallery/header-bg.png);background-size:cover;">
        </div> --}}
        <!--/.bg-holder-->
        <div class="text-center">
            <div id="spinner2" class="spinner-border text-primary" role="status"
                style="position: absolute; display: none;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>


        <div class="container">
            <div class="row ">
                <div class="col-12 col-md-3 mb-4">
                    <div class="row justify-content-center">
                        @if (auth()->user()->url_photo)
                            <img src="{{ asset('uploads/' . auth()->user()->url_photo) }}" alt=""
                                class="img-thumbnail rounded-circle" height="12px">
                        @else
                            <img src="{{ asset('uploads\profile-image\blank.png') }}" alt=""
                                class="img-thumbnail rounded-circle" height="12px">
                        @endif
                    </div>
                    <div class="text-center ">
                        <h4>{{ auth()->user()->name }}</h4>
                        <p class="text-dark fs-2"> {{ auth()->user()->username }}</p>
                        <a href="/myaccount/user/{{ auth()->user()->username }}/edit" class="btn btn-dark">Edit
                            Profile</a>
                    </div>
                </div>


                {{-- Isi Content Profile --}}
                <div class="col-12 col-md-7  ">
                    <h5 class="text-dark">My Info</h5>

                    {{-- flash Data --}}
                    @if (session('success'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Sukses</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="mt-3">
                        <div class="row text-center">
                            <div class="col-12 col-md-6">
                                <div class="card border-dark mb-3">
                                    <div class="card-header">Total Transaksi</div>
                                    <div class="card-body text-dark">
                                        <h5 class="card-title">{{ $order->count() }}</h5>
                                        <p class="card-text">Semua Transaksi sebanyak {{ $order->count() }} kali
                                        </p>
                                        <a href="/mytransaction/not-yet-paid" class="text-info">Klik Untuk
                                            Detail</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="card border-dark mb-3">
                                    <div class="card-header">Dalam Keranjang</div>
                                    <div class="card-body text-dark">
                                        <h5 class="card-title">{{ $carts->count() }}</h5>
                                        <p class="card-text">{{ $carts->count() }} Pesanan di Keranjang
                                        </p>
                                        <a href="cart/my/{{ auth()->user()->username }}" class="text-info">Klik
                                            Untuk Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Bagian My Market --}}
                    {{-- Start Modal Box --}}
                    <!-- Modal -->
                    <div class="modal fade " id="marketModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalHeader">Tambah Toko Baru</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="/save" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="text" class="form-control" placeholder="Nama Toko" name="name"
                                            required>
                                        <label for="provinsi" class="mt-2">Provinsi</label>
                                        <select name="province_id" id="provinsi" class="form-select ">
                                            <option disabled selected value="">--- Pilih Provinsi ---</option>
                                            @foreach ($provinsi as $pro)
                                                <option value="{{ $pro->province_id }}">{{ $pro->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="kota" class="mt-2">Kota</label>
                                        <select name="city_id" id="kota" class="form-select " required>
                                            <option value="">--- Pilih Kota/Kabupaten ---</option>
                                        </select>
                                        <input type="text" class="form-control mt-2" placeholder="Bank" name="bank"
                                            required>
                                        <input type="number" class="form-control mt-2" placeholder="No Rekening"
                                            name="no_rekening" required>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-start">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal Box --}}

                    <div class="mt-5">
                        <h5 class="text-dark">My Market</h5>
                        {{-- Flash Data --}}
                        @error('name')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>

                        @enderror
                        <div class="mb-2">
                            <div class="row my-3 justify-content-center">
                                @if (auth()->user()->market)
                                    {{-- Toko Tersedia --}}
                                    <div class="col-6 col-md-4 d-flex justify-content-center ">
                                        @if (auth()->user()->market->url_photo)

                                            <img src="{{ asset('uploads/' . auth()->user()->market->url_photo) }}"
                                                alt="Gagal" class="rounded-circle img-fluid">
                                        @else
                                            <img src="{{ asset('uploads\profile-image\toko.png') }}" alt=""
                                                class="rounded-circle img-fluid">
                                        @endif
                                        {{-- Icon Ubah Foto --}}
                                        <form action="" class="d-inline p-2 position-absolute">
                                            <div class="image-upload">
                                                <label for="file-input">
                                                    <i data-feather="camera"
                                                        class="text-white bg-dark rounded-circle p-1 "
                                                        style="height: 40px;width: 40px"></i>
                                                </label>

                                                <input id="file-input" type="file" name="url_photo" />
                                            </div>
                                        </form>
                                        {{-- End Icon --}}
                                    </div>
                                    <div class="col-12 text-center text-md-start mt-4 mt-md-0 col-md-8">
                                        <h4>{{ auth()->user()->market->name }}</h4>
                                        <p class="text-muted">Dibuat pada
                                            {{ auth()->user()->market->created_at->locale('id_ID')->toFormattedDateString() }}
                                        </p>
                                        <a href="/myaccount/market" class="btn btn-dark">Edit Toko</a>
                                        <a href="/mydashboard-konfirmasi" class="btn btn-dark">Dashboard</a>
                                    </div>
                                @else
                                    {{-- Toko Belum Tersedia --}}
                                    <div class="col-12 text-center text-muted">
                                        <i data-feather="minus-circle" style="width: 120px;height: 120px;"
                                            class="my-4"></i>
                                        <h4>Anda Belum Memiliki Toko</h4>
                                        <a href="" class="btn btn-dark mt-4" data-bs-toggle="modal"
                                            data-bs-target="#marketModal">Buat
                                            Toko</a>

                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>

    <script src="vendors/@popperjs/popper.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.min.js"></script>
    <script src="vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="vendors/feather-icons/feather.min.js"></script>
    <script>
        feather.replace();
    </script>
    <script src="assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <script src="{{ asset('assets/js/crop.min.js') }}"></script>
    <script>
        $('#file-input').ijaboCropTool({
            preview: '.image-previewer',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['CROP', 'QUIT'],
            buttonsColor: ['#30bf7d', '#ee5155', -15],
            processUrl: '{{ route('crop') }}',
            withCSRF: ['_token', '{{ csrf_token() }}'],
            onSuccess: function(message, element, status) {
                alert(message);
                window.location.reload();
            },
            onError: function(message, element, status) {
                alert('Ukuran Maksimal 1 mb format png');
            }
        });
    </script>
    <script src="{{ asset('assets/js/view-js/province-profil.js') }}"></script>



</body>

</html>
