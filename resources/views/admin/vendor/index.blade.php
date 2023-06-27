@extends('layout.admin.main')

@section('content')
    <h5>Vendor</h5>

    <div class="d-flex justify-content-between">

        <a href="{{ route('vendor.create') }}" class="btn btn-primary my-auto">Tambah Vendor</a>
        <form action="{{ route('vendor.index') }}" method="GET">
            <div class="d-flex me-2">
                <input type="text" name="cari" value="{{ request('cari') }}"
                    placeholder="Masukkan nama Vendor"class="form-control me-2" />
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
                    <th>No.</th>
                    <th>Nama</th>
                    <th>No. HP</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vendors as $vendor)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $vendor->nama }}</td>
                        <td>{{ $vendor->no_hp }}</td>
                        <td>{{ $vendor->email }}</td>
                        <td>{{ $vendor->alamat }}</td>
                        <td>
                            <a href="{{ route('vendor.edit', $vendor->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('vendor.destroy', $vendor->id) }}" method="POST"
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
