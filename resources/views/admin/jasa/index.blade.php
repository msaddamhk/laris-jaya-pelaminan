@extends('Layout.admin.main')

@section('content')
    <h5>Jasa</h5>
    <div class="d-flex justify-content-between">

        <div class="my-auto">
            <a href="{{ route('jasa.create') }}" class="btn btn-primary">Tambah Jasa</a>
        </div>

        <form action="{{ route('jasa.index') }}" method="GET">
            <div class="d-flex me-2">
                <input type="text" name="cari" value="{{ request('cari') }}"
                    placeholder="Masukkan nama Jasa"class="form-control me-2" />
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

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Vendor</th>
                <th>Harga</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jasa as $items)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $items->nama }}</td>
                    <td>{{ $items->vendor->nama }}</td>
                    <td>Rp {{ number_format($items->harga) }}</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('gambar.index', $items) }}"
                                        class="text-decoration-none text-black ms-2">
                                        Kelola Gambar</a>
                                </li>
                                <hr>
                                <li>
                                    <a href="{{ route('opsi.index', $items) }}"
                                        class="text-decoration-none text-black ms-2">
                                        Opsi</a>
                                </li>
                                <hr>
                                <li>
                                    <a href="{{ route('jasa.edit', $items->id) }}"
                                        class="text-decoration-none text-black ms-2">Edit</a>
                                </li>
                                <hr>
                                <li>
                                    <form action="{{ route('jasa.destroy', $items->id) }}" method="POST" class="m-0">
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
                    <td colspan="5" class="text-center">Tidak Ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $jasa->links() }}
@endsection
