@extends('myprofile.transaction.main')
@section('content')
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link " href="/mytransaction/not-yet-paid">Belum Bayar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link bg-dark text-white">Proses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Berhasil</a>
        </li>
    </ul>

    {{-- Bagian Kontent --}}

    <div class="row align-items-center mt-4">
        <h3>Paket No 020120026354621</h3>
        <p>Status : DELIVERED</p>
    </div>
    <hr class="hr my-4">
    <div>
        <p class="fs-2">History Paket</p>
        <div class="container">
            <div class="row my-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">2021-03-25 16:30:00</h5>
                        <p class="card-text">DELIVERED TO [TONO AKB SPEEDBOAT LONG TUNGU | 25-03-2021 16:30 | TARAKAN ]
                        </p>
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">2021-03-25 16:07:00</h5>
                        <p class="card-text">WITH DELIVERY COURIER [TARAKAN]</p>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection
