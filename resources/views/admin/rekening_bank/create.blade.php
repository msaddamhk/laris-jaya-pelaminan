@extends('layout.admin.main')

@section('content')
    <h5>Tambah Rekening</h5>

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

    <form action="{{ route('rekening.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="nama" class="mb-2">Nama Bank</label>
            <input type="text" class="form-control" id="nama" name="nama_bank" value="{{ old('nama_bank') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="nama" class="mb-2">No Rekening</label>
            <input type="text" class="form-control" id="no_rekening" name="no_rekening" value="{{ old('no_rekening') }}"
                required>
        </div>

        <div class="form-group mb-3">
            <label for="nama" class="mb-2">Atas Nama</label>
            <input type="text" class="form-control" id="nama" name="atas_nama" value="{{ old('atas_nama') }}"
                required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
