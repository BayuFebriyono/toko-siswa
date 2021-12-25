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

    <section class="py-8 ">
        {{-- <div class="bg-holder overlay overlay-light"
            style="background-image:url(assets/img/gallery/header-bg.png);background-size:cover;">
        </div> --}}
        <!--/.bg-holder-->

        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-2">
                    @if (auth()->user()->url_photo)
                        <img src="{{ asset('uploads/' . auth()->user()->url_photo) }}"
                            class="img-fluid rounded-circle col-md-12" alt="">
                    @else
                        <img src="{{ asset('uploads/profile-image/blank.png') }}"
                            class="img-fluid rounded-circle col-md-12" alt="">
                    @endif
                </div>
                <div class="col-md-10">
                    {{-- Icon Ubah Foto --}}
                    <div class="text-center mt-3 text-md-start">
                        <form action="" class="d-inline">
                            <div class="image-upload">
                                <label for="file-input2">
                                    <p class="btn btn-outline-dark rounded-4">Upload Photo</p>
                                </label>

                                <input id="file-input2" type="file" name="url_photo" />
                                <p>Ekstensi jpg atau png ukuran maks 1mb</p>
                            </div>
                        </form>
                    </div>
                    {{-- End Icon --}}
                </div>
            </div>
            <form action="/myaccount/user/{{ auth()->user()->username }}" class="mt-5" method="POST">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-5 mt-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="Email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-5 mt-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                            name="username" placeholder="Username" value="{{ old('username', $user->username) }}"
                            required>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-5 mt-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-5 mt-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" placeholder="New Password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-dark rounded-3 mt-4" type="submit">Update</button>
            </form>

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
        $('#file-input2').ijaboCropTool({
            preview: '.image-previewer',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['CROP', 'QUIT'],
            buttonsColor: ['#30bf7d', '#ee5155', -15],
            processUrl: '{{ route('profile') }}',
            withCSRF: ['_token', '{{ csrf_token() }}'],
            onSuccess: function(message, element, status) {
                alert(message);
                window.location.reload();
            },
            onError: function(message, element, status) {
                alert('Harus jpg atau png dan Ukuran Maksimal 1 mb');
            }
        });
    </script>

</body>

</html>
