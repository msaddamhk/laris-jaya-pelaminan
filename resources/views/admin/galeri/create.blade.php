@extends('layout.admin.main')

@section('content')
    <h5>Kelola Galeri</h5>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <hr>

    <form action="{{ route('kelola-galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="judul" class="mb-2">Judul</label>
            <input type="text" class="form-control" id="nama" name="judul" value="{{ old('judul') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="kategori_galeri_id">Kategori</label>
            <select class="form-select @error('kategori_galeri_id') is-invalid @enderror" id="kategori_galeri_id"
                name="kategori_galeri_id">
                <option selected disabled>Choose Kategori</option>
                @foreach ($kategori_galeri as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_galeri_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}</option>
                @endforeach
            </select>
            @error('kategori_galeri_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="tanggal" class="mb-2">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="foto">Foto</label>
            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
