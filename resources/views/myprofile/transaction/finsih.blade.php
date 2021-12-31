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
            <a class="nav-link bg-dark text-white" href="#">Berhasil</a>
        </li>
    </ul>

    @if (session('success'))
        <script>
            Swal.fire(
                'Berhasil',
                "{{ session('success') }}",
                'success'
            )
        </script>
    @endif


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
                        <p class="fs-md-1 mt-0">Pesanan Telah Selesai</p>
                        <p class="fs-md-1 mt-0">No Resi : {{ $order->no_resi }}</p>
                        {{-- <a href="/mytransaction/cekResi/{{ $order->no_resi }}/{{ $order->id }}" class="btn btn-success">Lacak Paket</a> --}}
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
