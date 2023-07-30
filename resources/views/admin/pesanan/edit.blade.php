@extends('Layout.admin.main')

@section('content')
    <div class="container">

        <h5 class="card-header">Edit Pemesanan</h5>

        <hr>

        <form action="{{ route('pemesanan.update', $pemesanan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')


            <div class="form-group mb-3">
                <label for="status_pembayaran">Status Pembayaran</label>
                <select class="form-select @error('status_pembayaran') is-invalid @enderror" id="status_pembayaran"
                    name="status_pembayaran">
                    <option value="0" @if (!$pemesanan->status_pembayaran) selected @endif>Belum Bayar</option>
                    <option value="1" @if ($pemesanan->status_pembayaran) selected @endif>Sudah Bayar</option>
                </select>
                @error('status_pembayaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="nama" class="mb-2">Catatan Pembayaran</label>
                <input type="text" class="form-control" id="nama" name="catatan_pembayaran"
                    value="{{ $pemesanan->catatan_pembayaran }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
