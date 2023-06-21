@extends('layout.admin.main')

@section('content')
    <h5>Edit Admin</h5>

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


    <form action="{{ route('data-admin.update', $data_admin->id) }}" method="POST">
        @csrf

        @method('PUT')
        <div class="form-group mb-3">
            <label for="nama" class="mb-2">Nama</label>
            <input type="text" class="form-control" id="nama" name="name" value="{{ $data_admin->name }}">
        </div>

        <div class="form-group mb-3">
            <label for="nama" class="mb-2">Email</label>
            <input type="text" class="form-control" id="nama" name="email" value="{{ $data_admin->email }}"
                required>
        </div>

        <div class="form-group mb-3">
            <label for="nama" class="mb-2">No Hp</label>
            <input type="number" class="form-control" id="nama" name="no_hp" value="{{ $data_admin->no_hp }}">
        </div>

        <div class="form-group mb-3">
            <label for="nama" class="mb-2">Password</label>
            <input type="password" class="form-control" id="nama" name="password">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
