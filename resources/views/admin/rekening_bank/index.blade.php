@extends('Layout.admin.main')

@section('content')
    <h5>Rekening Bank</h5>
    <div class="d-flex justify-content-between">
        <div class="my-auto">
            <a href="{{ route('rekening.create') }}" class="btn btn-primary">Tambah Rekening</a>
        </div>
        <form action="{{ route('rekening.index') }}" method="GET">
            <div class="d-flex me-2">
                <input type="text" name="cari" value="{{ request('cari') }}"
                    placeholder="Masukkan nama Bank"class="form-control me-2" />
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
                <th>Nama Bank</th>
                <th>No Rekening</th>
                <th>Atas Nama</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rekening as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_bank }}</td>
                    <td>{{ $item->no_rekening }}</td>
                    <td>{{ $item->atas_nama }}</td>
                    <td>
                        <a href="{{ route('rekening.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('rekening.destroy', $item->id) }}" method="POST" style="display:inline;">
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
