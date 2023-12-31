@extends('Layout.admin.main')

@push('heads')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
@endpush

@section('content')
    <div>
        <h5>TambahJasa</h5>

        <hr>

        <form action="{{ route('jasa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="nama">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                    value="{{ old('nama') }}">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="modal">Modal</label>
                <input type="number" class="form-control @error('modal') is-invalid @enderror" id="modal"
                    name="modal" value="{{ old('modal') }}">
                @error('modal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="harga">Harga</label>
                <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga"
                    name="harga" value="{{ old('harga') }}">
                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="vendor_id">Vendor</label>
                <select class="form-select @error('vendor_id') is-invalid @enderror" id="vendor_id" name="vendor_id">
                    <option selected disabled>Choose Vendor</option>
                    @foreach ($vendors as $vendor)
                        <option value="{{ $vendor->id }}" {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>
                            {{ $vendor->nama }}</option>
                    @endforeach
                </select>
                @error('vendor_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="kategori_id">Kategori</label>
                <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id">
                    <option selected disabled>Choose Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}</option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="is_cod">Izin COD</label>
                <select class="form-select @error('is_cod') is-invalid @enderror" id="is_cod" name="is_cod">
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
                @error('is_cod')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="banyak_hari">Apakah Bisa Berapa Hari ?</label>
                <select class="form-select @error('banyak_hari') is-invalid @enderror" id="banyak_hari" name="banyak_hari">
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
                @error('banyak_hari')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="status_pengembalian">Apakah Bisa di kembalikan ?</label>
                <select class="form-select @error('status_pengembalian') is-invalid @enderror" id="status_pengembalian"
                    name="status_pengembalian">
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
                @error('status_pengembalian')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="mb-1">Deskripsi</label>
                <div class="form-group">
                    <textarea class="form-control form-control-sm" id="summernote" name="deskripsi" rows="50">
                        {{ old('deskripsi') }}
                </textarea>
                    @error('deskripsi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="tipe_unit">Tipe Unit</label>
                <input type="text" class="form-control @error('tipe_unit') is-invalid @enderror" id="tipe_unit"
                    name="tipe_unit" value="{{ old('tipe_unit') }}">
                @error('tipe_unit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="jumlah_minimal">Jumlah Minimal</label>
                <input type="number" class="form-control @error('jumlah_minimal') is-invalid @enderror" id="jumlah_minimal"
                    name="jumlah_minimal" value="{{ old('jumlah_minimal') }}">
                @error('jumlah_minimal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="jumlah_maksimal">Jumlah Maksimal</label>
                <input type="number" class="form-control @error('jumlah_maksimal') is-invalid @enderror"
                    id="jumlah_maksimal" name="jumlah_maksimal" value="{{ old('jumlah_maksimal') }}">
                @error('jumlah_maksimal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="jumlah_pesanan">Jumlah Pesanan</label>
                <input type="number" class="form-control @error('jumlah_pesanan') is-invalid @enderror"
                    id="jumlah_pesanan" name="jumlah_pesanan" value="{{ old('jumlah_pesanan') }}">
                @error('jumlah_pesanan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="foto">Foto</label>
                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                    name="foto[]" multiple>
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 435,
                toolbar: [
                    ['style', ['italic', 'underline', 'clear', 'bold']],
                    ['insert', ['link']],
                ],
            });
        });
    </script>
@endpush
