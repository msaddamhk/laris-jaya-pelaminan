@extends('layout.admin.main')

@section('content')
    <h5>Tambah item Opsi</h5>

    <hr>

    <form action="{{ route('opsi.item.update', [$jasa, $jasaopsi, $jasaopsiitem]) }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="label" class="mb-2">Label</label>
            <input type="text" class="form-control" id="label" name="label" value="{{ $jasaopsiitem->label }}" required>
            @error('label')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="value" class="mb-2">Value</label>
            <input type="text" class="form-control" id="value" name="value" value="{{ $jasaopsiitem->value }}"
                required>
            @error('value')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="harga" class="mb-2">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga" value="{{ $jasaopsiitem->harga }}"
                required>
            @error('harga')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
