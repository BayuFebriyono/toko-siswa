@extends('myprofile.transaction.main')
@section('content')
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link " href="/mytransaction/not-yet-paid">Belum Bayar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link bg-dark text-white" href="/mytransaction/proses">Proses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Berhasil</a>
        </li>
    </ul>

    {{-- Bagian Kontent --}}

    <div class="row align-items-center mt-4">
        <h3>Paket No 020120026354621</h3>
        <p>Status : {{ $summary->status }}</p>
    </div>
    <a href="" class="btn btn-success">Pesanan Diterima</a>
    <hr class="hr my-4">
    <div>
        <p class="fs-2">History Paket</p>
        <div class="container">
            @foreach ($history as $hs)
                <div class="row my-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $hs->date }}</h5>
                            <p class="card-text">{{ $hs->desc }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>



@endsection
