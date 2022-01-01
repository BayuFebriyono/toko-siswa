@extends('myprofile.transaction.main')
@section('content')
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link " href="/mytransaction/not-yet-paid">Belum Bayar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/mytransaction/proses">Proses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/mytransaction/finish">Berhasil</a>
        </li>
        <li class="nav-item  bg-dark">
            <a href="" class="nav-link text-white">Gagal</a>
        </li>
    </ul>

    {{-- Bagian Kontent --}}
    @if ($orders->count())
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
                <div class="col-9 col-md-8">
                    <div class="row">
                    </div>
                    <p class="fs-1 mt-3">{{ $order->orderDetail[0]->product->name }}</p>
                    @if ($order->status == 'REJECTED')
                        <p class="fs-md-1 mt-0">Pembayaran ditolak karena tidak valid</p>
                    @elseif ($order->status == 'CANCELED')
                        <p class="fs-md-1 mt-0">Dibatalkan Oleh Penjual</p>
                    @endif
                </div>
            </div>
            <hr class="hr my-4">
        @endforeach
    @else
        <div class="text-center">
            <img src="{{ asset('assets/img/gallery/no-data.png') }}" alt="No Data" class="img-fluid">
        </div>
    @endif



@endsection
