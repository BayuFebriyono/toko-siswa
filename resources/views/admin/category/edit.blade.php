@extends('admin.main')
@section('content')

    <h1 class="mb-5">Edit Data</h1>

    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title ">Isi Form Dibawah Dengan Lengkap</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" method="POST" action="/admin-dashboard/edit-category/{{ $category->id }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Nama Kategori</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Nama Kategori" id="first-name-icon" name="name"
                                                value="{{ old('name', $category->name) }}" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-tags"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="email-id-icon">Foto</label>
                                        <div class="position-relative">
                                            <input type="file" class="form-control @error('url_photo') is-invalid @enderror"
                                                placeholder="Foto dengan rasio 1:1" id="email-id-icon" name="url_photo">
                                            <div class="form-control-icon">
                                                <i class="bi bi-images"></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
