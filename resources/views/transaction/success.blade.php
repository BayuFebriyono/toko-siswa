@extends('transaction.main')
@section('content')
    <div class="container">
        <div class="text-center mt-6 mt-md-4">
            <img src="{{ asset('assets/img/gallery/transaction-success.png') }}" alt="Sukses" class="img-fluid">
        </div>
        <div class="text-center mt-1">
            <h2>Pembelian Berhasil</h2>
            <a href="/mytransaction/not-yet-paid" class="btn btn-success">Bayar Sekarang</a>
        </div>

    </div>
@endsection
