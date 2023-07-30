@extends('layout.admin.main')

@section('content')
    <h5>Kelola Slider</h5>

    <div class="d-flex justify-content-between">
        <div class="my-auto">
            <a href="{{ route('slider.create') }}" class="btn btn-primary">Tambah Slider</a>
        </div>
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
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($slider as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ asset('storage/slider/' . $item->foto) }}">
                                <img src="{{ asset('storage/slider/' . $item->foto) }}" class="" width="250px"
                                    style="object-fit: cover;" alt="..." />
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('slider.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('slider.destroy', $item->id) }}" method="POST" style="display:inline;">
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
