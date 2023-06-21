@extends('layout.admin.main')

@section('content')
    <h5>Tambah item Opsi</h5>

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

    <form action="{{ route('opsi.item.store', [$jasa, $jasaopsi]) }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="label" class="mb-2">Label</label>
            <input type="text" class="form-control" id="label" name="label" value="{{ old('label') }}" required>
            @error('label')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="value" class="mb-2">Value</label>
            <input type="text" class="form-control" id="value" name="value" value="{{ old('value') }}" required>
            @error('value')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="harga" class="mb-2">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga" harga="{{ old('harga') }}" required>
            @error('harga')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
