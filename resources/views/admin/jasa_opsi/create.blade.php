@extends('Layout.admin.main')

@section('content')
    <h5>Tambah Opsi</h5>

    <hr>

    <form action="{{ route('opsi.store', $jasa) }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="nama" class="mb-2">Nama</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                value="{{ old('nama') }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
