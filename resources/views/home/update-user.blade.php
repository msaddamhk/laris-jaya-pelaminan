@extends('Layout.home.main2')

@section('content')
    <section class="py-4">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('home.update.profile.update', $user->id) }}" method="POST">
                @csrf

                @method('PUT')

                <div class="form-group mb-3">
                    <label for="nama" class="mb-2">Nama</label>
                    <input type="text" class="form-control" id="nama" name="name" value="{{ $user->name }}"
                        required>
                </div>

                <div class="form-group mb-3">
                    <label for="nama" class="mb-2">Email</label>
                    <input type="text" class="form-control" id="nama" name="email" value="{{ $user->email }}"
                        required>
                </div>

                <div class="form-group mb-3">
                    <label for="nama" class="mb-2">No Hp</label>
                    <input type="number" class="form-control" id="nama" name="no_hp" value="{{ $user->no_hp }}"
                        required>
                </div>

                <div class="form-group mb-3">
                    <label for="nama" class="mb-2">Alamat</label>
                    <input type="text" class="form-control" id="nama" name="alamat" value="{{ $user->alamat }}"
                        required>
                </div>

                <div class="form-group mb-3">
                    <label for="nama" class="mb-2">Password</label>
                    <input type="password" class="form-control" id="nama" name="password">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </section>
@endsection
