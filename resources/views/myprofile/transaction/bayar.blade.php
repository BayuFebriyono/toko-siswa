@extends('myprofile.transaction.main')
@section('content')
    <div class="container">

        {{-- Start Modal Box --}}
        <div class="modal fade" id="payModal" tabindex="-1">
            <div class="modal-dialog modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cara Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ol>
                            <li>Siapkan Uang Sebesar Rp. {{ number_format($order->total, 0, ',', '.') }}</li>
                            <li>Transfer Ke Bank BRI</li>
                            <li>Dengan Nomer Rekening 00876554321</li>
                            <li>Simpan Bukti Pembayaran</li>
                            <li>Jika Sudah Pergi Ke Menu Sudah Bayar</li>
                        </ol>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Box --}}

        @error('url_photo')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror

        <div class="text-center">
            <img src="{{ asset('assets/img/gallery/gambar_bayar.png') }}" alt="" class="img-fluid">
            <div>
                <a href="" class="p-0 px-4 py-2 btn btn-info mt-5" data-bs-toggle="modal" data-bs-target="#payModal">Cara
                    Pembayaran</a>
            </div>
            <div>
                <a href="/transaction/pay/{{ $order->id }}" class="p-0 px-5 py-2 btn btn-success mt-3">Sudah Bayar</a>
            </div>
        </div>
    </div>

@endsection
