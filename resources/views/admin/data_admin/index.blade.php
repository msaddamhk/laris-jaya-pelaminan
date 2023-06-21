@extends('layout.admin.main')

@section('content')
    <div class="d-flex justify-content-between">
        <h5>Kelola Admin</h5>
        <div class="my-auto">
            <a href="{{ route('data-admin.create') }}" class="btn btn-primary">Tambah Admin</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <hr>

    <form action="{{ route('data-admin.index') }}" method="GET">
        <div class="d-flex me-2 mt-2 mb-3">
            <input type="text" name="cari" value="{{ request('cari') }}"
                placeholder="Cari Data..."class="form-control me-2" />
            <button class="btn btn-search d-flex justify-content-center align-items-center p-0" type="submit">
                <img src="{{ asset('asset/admin/images/ic_search.svg') }}" width="20px" height="20px" />
            </button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>
                        <a href="{{ route('data-admin.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('data-admin.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak Ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
