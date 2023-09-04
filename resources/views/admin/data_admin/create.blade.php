@extends('Layout.admin.main')

@section('content')
    <h5>Tambah Admin</h5>

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

    <form action="{{ route('data-admin.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="nama" class="mb-2">Nama</label>
            <input type="text" class="form-control" id="nama" name="name" value="{{ old('nama') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="nama" class="mb-2">Email</label>
            <input type="text" class="form-control" id="nama" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="nama" class="mb-2">No Hp</label>
            <input type="number" class="form-control" id="nama" name="no_hp" value="{{ old('no_hp') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="nama" class="mb-2">Password</label>
            <input type="password" class="form-control" id="nama" name="password" value="{{ old('password') }}"
                required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
