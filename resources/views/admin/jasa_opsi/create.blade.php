@extends('layout.admin.main')

@section('content')
    <h5>Tambah Opsi</h5>

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

    <form action="{{ route('opsi.store', $jasa) }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="nama" class="mb-2">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <select class="form-select" aria-label="Default select example" name="tipe" required>
                <option selected>Pilih</option>
                <option value="text">text</option>
                <option value="radio">radio</option>
            </select>

            @error('tipe')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
