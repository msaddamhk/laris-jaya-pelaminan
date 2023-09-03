@extends('layout.admin.main')


@push('heads')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
@endpush


@section('content')
    <h5>Tambah item Opsi</h5>

    <hr>

    <form action="{{ route('opsi.item.update', [$jasa, $jasaopsi, $jasaopsiitem]) }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="label" class="mb-2">Label</label>
            <input type="text" class="form-control" id="label" name="label" value="{{ $jasaopsiitem->label }}"
                required>
            @error('label')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="mb-1">Deskripsi</label>
            <div class="form-group">
                <textarea class="form-control form-control-sm" id="summernote" name="deskripsi" rows="50" required>
                    {!! old('deskripsi', $jasaopsiitem->deskripsi) !!} 
            </textarea>
                @error('deskripsi')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="modal" class="mb-2">Modal</label>
            <input type="number" class="form-control" id="modal" name="modal" value="{{ $jasaopsiitem->modal }}"
                required>
            @error('modal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="harga" class="mb-2">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" value="{{ $jasaopsiitem->harga }}"
                required>
            @error('harga')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
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
