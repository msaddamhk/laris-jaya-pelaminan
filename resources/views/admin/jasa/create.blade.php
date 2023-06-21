@extends('Layout.admin.main')


@section('content')
    <div class="container">

        <h5>Create Jasa</h5>

        <hr>

        <form action="{{ route('jasa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="nama">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                    value="{{ old('nama') }}">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="harga">Harga</label>
                <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga"
                    name="harga" value="{{ old('harga') }}">
                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="vendor_id">Vendor</label>
                <select class="form-select @error('vendor_id') is-invalid @enderror" id="vendor_id" name="vendor_id">
                    <option selected disabled>Choose Vendor</option>
                    @foreach ($vendors as $vendor)
                        <option value="{{ $vendor->id }}" {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>
                            {{ $vendor->nama }}</option>
                    @endforeach
                </select>
                @error('vendor_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="kategori_id">Kategori</label>
                <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id">
                    <option selected disabled>Choose Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}</option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="tipe_unit">Tipe Unit</label>
                <input type="text" class="form-control @error('tipe_unit') is-invalid @enderror" id="tipe_unit"
                    name="tipe_unit" value="{{ old('tipe_unit') }}">
                @error('tipe_unit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="jumlah_minimal">Jumlah Minimal</label>
                <input type="number" class="form-control @error('jumlah_minimal') is-invalid @enderror" id="jumlah_minimal"
                    name="jumlah_minimal" value="{{ old('jumlah_minimal') }}">
                @error('jumlah_minimal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="jumlah_maksimal">Jumlah Maksimal</label>
                <input type="number" class="form-control @error('jumlah_maksimal') is-invalid @enderror"
                    id="jumlah_maksimal" name="jumlah_maksimal" value="{{ old('jumlah_maksimal') }}">
                @error('jumlah_maksimal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="foto">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto[]" multiple>
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
