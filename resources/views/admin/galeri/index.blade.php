@extends('layout.admin.main')

@section('content')
    <h5>Kelola Galeri</h5>
    <div class="d-flex justify-content-between">
        <div class="my-auto">
            <a href="{{ route('kelola-galeri.create') }}" class="btn btn-primary">Tambah galeri</a>
        </div>
        <form action="{{ route('kelola-galeri.index') }}" method="GET">
            <div class="d-flex me-2">
                <input type="text" name="cari" value="{{ request('cari') }}"
                    placeholder="Masukkan judul"class="form-control me-2" />
                <button class="btn btn-search d-flex justify-content-center align-items-center p-0" type="submit">
                    <img src="{{ asset('asset/admin/images/ic_search.svg') }}" width="20px" height="20px" />
                </button>
            </div>
        </form>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <hr>
    <div class="table-responsive">

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Gambar</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($galeri as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->tanggal_booking }}</td>
                        <td>{{ $item->kategori_galeri->nama }}</td>
                        <td>{{ $item->foto }}</td>
                        <td>
                            <a href="{{ route('kelola-galeri.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('kelola-galeri.destroy', $item->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak Ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
