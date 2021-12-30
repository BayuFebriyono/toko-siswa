@extends('admin.main')
@section('content')
    <h2>Data Kategori</h2>
    <div class="card">
        <div class="card-header">
            <a href="/admin-dashboard/add-category" class="btn btn-primary">Tambah Data</a>
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

        @if (session('error'))
            <script>
                Swal.fire(
                    'Gagal',
                    '{{ session('error') }}',
                    'error'
                )
            </script>
        @endif
        {{-- End Alert --}}
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ asset('uploads/' . $category->url_photo) }}"
                                    data-lightbox="image-{{ $loop->iteration }}" class="btn btn-info">Gambar</a>
                            </td>
                            <td>
                                <a class="p-0 py-2 px-4 btn btn-success mt-2" href="/admin-dashboard/edit-category/{{ $category->id }}">Edit</a>
                                <form action="/admin-dashboard/delete-category/{{ $category->id }}" class="d-inline"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="p-0 px-3 py-2 mt-2 btn btn-danger" type="submit" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
