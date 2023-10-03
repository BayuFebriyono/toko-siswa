@extends('admin.main')
@section('content')

    <h1 class="mb-5">Identitas Sistem</h1>

    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title ">Ubah sesuai kebutuhan anda</h4>
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
                    <form class="form form-vertical" method="POST" action="/identitas"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Nama Judul</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                                placeholder="Nama Judul" id="first-judul-icon" name="judul"
                                                value="{{ $identitas->judul }}" required>
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
                                            <input type="file"
                                                class="form-control @error('foto') is-invalid @enderror"
                                                placeholder="Foto dengan rasio 1:1" id="email-id-icon" name="foto"
                                                value="{{ $identitas->foto }}">
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
