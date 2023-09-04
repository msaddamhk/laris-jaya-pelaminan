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

            <select class="form-select mb-3" name="catatan_pembayaran" aria-label="Default select example"
                onchange="updateTotal()">
                <option selected disabled>Pilih</option>
                <option value="lunas" {{ $pemesanan->catatan_pembayaran === 'lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="25%" {{ $pemesanan->catatan_pembayaran === '25%' ? 'selected' : '' }}>25%</option>
                <option value="25%" {{ $pemesanan->catatan_pembayaran === '35%' ? 'selected' : '' }}>35%</option>
                <option value="25%" {{ $pemesanan->catatan_pembayaran === '55%' ? 'selected' : '' }}>55%</option>
                <option value="25%" {{ $pemesanan->catatan_pembayaran === '75%' ? 'selected' : '' }}>75%</option>
            </select>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
