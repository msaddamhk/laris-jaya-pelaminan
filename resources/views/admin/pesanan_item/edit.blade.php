@extends('Layout.admin.main')

@section('content')
    <div class="container">

        <h5 class="card-header">Edit pemesanan_item</h5>

        <hr>

        <form action="{{ route('pemesanan_item.update', $pemesanan_item->id) }}" method="POST">
            @csrf
            @method('PUT')


            <div class="form-group mb-3">
                <label for="status_pengembalian">Status pengembalian</label>
                <select class="form-select @error('status_pengembalian') is-invalid @enderror" id="status_pengembalian"
                    name="status_pengembalian_barang">
                    <option value="0" @if (!$pemesanan_item->status_pengembalian_barang) selected @endif>Belum Mengembalikan</option>
                    <option value="1" @if ($pemesanan_item->status_pengembalian_barang) selected @endif>Sudah Mengembalikan</option>
                </select>
                @error('status_pengembalian')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
