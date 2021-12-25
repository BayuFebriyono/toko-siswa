@extends('cart.main')
@section('content')
    <div class="container">
        <h4 class="my-4">Keranjang</h4>
        @if (session('success'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Sukses</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        @endif
        <hr class="hr my-4">

        @if ($carts->count())
            @foreach ($carts as $cart)
                <div class="row align-items-center">
                    <div class="col-3 col-md-2">
                        @if ($cart->product->photo->count())
                            <img src="{{ asset('uploads/' . $cart->product->photo[0]->url) }}" alt="Error"
                                class=" rounded img-fluid">
                        @else
                            <img src="{{ asset('uploads/product-image/no-pictures.png') }}" alt="Error"
                                class=" rounded img-fluid">
                        @endif
                    </div>
                    <div class="col-5 col-md-8">
                        <div class="row">
                        </div>
                        <p class="fs-1 mt-3">{{ $cart->product->name }}</p>
                        <p class="fs-1 mt-0">Rp. {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                    </div>
                    <div class=" col-3 col-md-2 text-center">


                        <form action="/cart/{{ $cart->id }}" class="d-inline" method="POST">
                            @csrf
                            @method('put')
                            <input type="number" class="form-control mb-2" name="qty" value="{{ $cart->qty }}" required>
                            <button type="submit" class=" p-0 py-2 px-3 btn btn-success mt-2">Beli</button>
                        </form>
                        <form action="/cart/{{ $cart->id }}" class="d-inline" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class=" p-0 py-2 px-2 btn btn-danger mt-2"
                                onclick="return confirm('Yakin Hapus?')">Hapus</button>
                        </form>

                    </div>
                    <p class="mt-4 fs-1">Total Rp . {{ number_format($cart->total, 0, ',', '.') }}</p>
                </div>
                <hr class="hr my-4">
            @endforeach

        @else
            <h3 class="text-center">Keranjang Anda Masih Kosong</h3>
        @endif


    </div>

@endsection
