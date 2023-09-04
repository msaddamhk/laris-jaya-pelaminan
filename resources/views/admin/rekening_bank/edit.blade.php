@extends('Layout.admin.main')

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

    <form action="{{ route('rekening.update', $rekening->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="nama" class="mb-2">Nama Bank</label>
            <input type="text" class="form-control" id="nama" name="nama_bank" value="{{ $rekening->nama_bank }}"
                required>
        </div>

        <div class="form-group mb-3">
            <label for="nama" class="mb-2">No Rekening</label>
            <input type="text" class="form-control" id="no_rekening" name="no_rekening"
                value="{{ $rekening->no_rekening }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="nama" class="mb-2">Atas Nama</label>
            <input type="text" class="form-control" id="nama" name="atas_nama" value="{{ $rekening->atas_nama }}"
                required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
