@extends('Layout.admin.main')

@section('content')
    <h5>Gambar di Jasa {{ $jasa->nama }}</h5>

    <div class="d-flex justify-content-between">
        <div class="my-auto">
            <a href="{{ route('gambar.create', $jasa) }}" class="btn btn-primary btn-sm">
                Tambah Gambar</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <hr>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($gambar as $items)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ asset('storage/jasa_foto/' . $items->foto) }}">
                            <img src="{{ asset('storage/jasa_foto/' . $items->foto) }}" class="" width="120px"
                                height="120px" style="object-fit: cover;" alt="..." />
                        </a>
                    </td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('gambar.edit', [$jasa, $items]) }}"
                                        class="text-decoration-none text-black ms-2">Edit</a>
                                </li>
                                <hr>
                                <li>
                                    <form action="{{ route('gambar.destroy', [$jasa, $items]) }}" method="POST"
                                        class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-transparent border-0 ms-2 p-0 text-dark"
                                            onclick="return confirm('Are you sure you want to delete this jasa?')">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak Ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
