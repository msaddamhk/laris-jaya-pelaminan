@extends('Layout.admin.main')

@section('content')
    <div class="container">


        <h5>List Item di Opsi {{ $jasaopsi->nama }}</h5>

        <div class="d-flex justify-content-between">
            <div class="my-auto">
                <a href="{{ route('opsi.item.create', [$jasa, $jasaopsi]) }}" class="btn btn-primary btn-sm">
                    Tambah Opsi</a>
            </div>
            <form action="{{ route('opsi.item.index', [$jasa, $jasaopsi]) }}" method="GET">
                <div class="d-flex me-2">
                    <input type="text" name="cari" value="{{ request('cari') }}"
                        placeholder="Masukkan label Item"class="form-control me-2" />
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
                    <th>Label</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jasa_opsi_item as $items)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $items->label }}</td>
                        <td>{{ $items->deskripsi }}</td>
                        <td>Rp {{ number_format($items->harga) }}</td>
                        <td>
                            <a href="{{ route('opsi.item.edit', [$jasa, $jasaopsi, $items]) }}"
                                class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('opsi.item.destroy', [$jasa, $jasaopsi, $items]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this jasa?')">Delete</button>
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
    </div>
@endsection
