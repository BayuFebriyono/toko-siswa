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
            <a class="nav-link" href="/mytransaction/finish">Berhasil</a>
        </li>
        <li class="nav-item">
            <a href="/mytransaction/gagal" class="nav-link">Gagal</a>
        </li>
    </ul>

    {{-- Bagian Kontent --}}
    @if ($summary)
        <div class="row align-items-center mt-4">
            <h3>Paket No {{ $summary->awb }}</h3>
            <p>Status : {{ $summary->status }}</p>
        </div>
        <a href="/mytransaction/terima/{{ $order->id }}" class="btn btn-success">Pesanan Diterima</a>
        <hr class="hr my-4">
        <div>
            <p class="fs-2">History Paket</p>
            <div class="container">
                @if ($history)
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
                @else
                    <div class="row my-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Error</h5>
                                <p class="card-text">History Paket TIdak Ditemukan
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </div>
    @else
        <h3 class="mt-4">Kode Resi Tidak Ditemukan</h3>
        <a href="/mytransaction/terima/{{ $order->id }}" class="btn btn-success">Pesanan Diterima</a>
    @endif
@endsection
