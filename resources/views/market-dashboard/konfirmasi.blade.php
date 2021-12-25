@extends('market-dashboard.main')
@section('content')
    <div class="page-heading">
        <h3>Konfirmasi Pesanan</h3>
    </div>


    <div class="card">
        <div class="card-header">
            ...
        </div>
        {{-- Alert --}}
        @if (session('success'))
            <script>
                Swal.fire(
                    'Sukses',
                    '{{ session('success') }}',
                    'success'
                )
            </script>
        @endif
        {{-- End Alert --}}
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Product</th>
                        <th>Pembeli</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Kurir</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->kode }}</td>
                            <td>{{ $order->orderDetail[0]->product->name }}</td>
                            <td>{{ $order->user->username }}</td>
                            <td>{{ $order->alamat }}</td>
                            <td>{{ $order->nomor_hp }}</td>
                            <td>{{ $order->kurir_name }}</td>
                            <td>{{ $order->qty }}</td>
                            <td>Rp. {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td>
                                <form action="/mydashboard-konfirmasi/{{ $order->id }}/CONFIRMED" class="d-inline"
                                    method="POST">
                                    @csrf
                                    <button class="p-0 p-2 btn btn-success mt-2" type="submit">Konfirmasi</button>
                                </form>
                                <form action="/mydashboard-konfirmasi/{{ $order->id }}/CANCELED" class="d-inline"
                                    method="POST">
                                    @csrf
                                    <button class="p-0 px-3 py-2 mt-2 btn btn-danger" type="submit">Batalkan</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
