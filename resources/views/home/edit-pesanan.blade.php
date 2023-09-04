@extends('Layout.home.main2')

@section('content')
    <section class="py-5">
        <div class="container">
            <h5 class="mb-3" style="color: rgb(55, 55, 55);" data-aos="fade-in" data-aos-delay="100">
                Update
            </h5>
            <hr>

            <div class="row">
                <form action="{{ route('update.pesanan', $pemesanan) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <small>Upload Bukti Pembayaran</small>
                    <input type="file" class="form-control mb-4 mt-2 @error('bukti_pembayaran') is-invalid @enderror"
                        name="bukti_pembayaran">
                    @error('bukti_pembayaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-success btn-sm" style="font-size: 12px">
                        <i class="bi bi-wallet"></i> Submit
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
