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
                        <th>Credentials</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->kode }}</td>
                            <td>
                                <form action="/mydashboard-kirm/{{ $order->id }}" class="d-inline" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" name="no_resi" placeholder="No Resi" required>
                                    <div class="text-center">
                                        <button class="p-0 p-2 btn btn-success mt-2" type="submit">Konfirmasi</button>
                                    </div>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
