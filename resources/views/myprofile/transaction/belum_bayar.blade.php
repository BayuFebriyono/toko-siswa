@extends('myprofile.transaction.main')
@section('content')
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link bg-dark text-white">Belum Bayar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/mytransaction/proses">Proses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Berhasil</a>
        </li>
    </ul>
    @if (session('success'))
        <script>
            Swal.fire(
                'Berhasil Dicatat',
                "{{ session('success') }}",
                'success'
            )
        </script>
    @endif

    {{-- Bagian Kontent --}}
    @foreach ($orders as $order)
        <div class="row align-items-center mt-4">
            <div class="col-3 col-md-2">
                @if ($order->orderDetail[0]->product->photo->count())
                    <img src="{{ asset('uploads/' . $order->orderDetail[0]->product->photo[0]->url) }}" alt="Error"
                        class=" rounded img-fluid">
                @else
                    <img src="{{ asset('uploads/product-image/no-pictures.png') }}" alt="Error"
                        class=" rounded img-fluid">
                @endif
            </div>
            <div class="col-5 col-md-8">
                <div class="row">
                </div>
                <p class="fs-1 mt-3">{{ $order->orderDetail[0]->product->name }}</p>
                <p class="fs-1 mt-0">Perlu di Bayar</p>
            </div>
            <div class=" col-1 col-md-2 text-center">
                <a href="/mytransaction/pay/{{ $order->id }}" class=" p-0 px-2 py-2 btn btn-success">Bayar</a>
            </div>
        </div>
        <hr class="hr my-4">
    @endforeach


@endsection
