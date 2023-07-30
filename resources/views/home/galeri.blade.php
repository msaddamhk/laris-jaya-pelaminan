@extends('Layout.home.main2')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row">

                <form action="{{ route('home.galeri') }}" method="get">
                    <div class="card p-3 mb-5">
                        <label for="exampleFormControlInput1" class="form-label">Pilih Kategori</label>
                        <div class="form-group">
                            <select name="kategori" id="kategori" class="form-select">
                                <option value="all" @if ($selectedKategori === 'all') selected @endif>All
                                </option>
                                @foreach ($kategoris as $id => $nama)
                                    <option value="{{ $id }}" @if ($selectedKategori == $id) selected @endif>
                                        {{ $nama }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </form>

                @forelse ($galeri as $item)
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('detail', [$item]) }}" class="text-decoration-none text-black">
                            <div>
                                <img src="{{ asset('storage/galeri/' . $item->foto) }}" class="card-img-top" height="260px"
                                    style="object-fit: cover; width: 100%" alt="..." />
                                <div>
                                    <h5 class="card-title fw-bold mb-1 mt-2"> {{ $item->judul }}</h5>
                                    <p class="card-text" style="color: #a1947c">{{ $item->tanggal_booking }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <h6 class="text-center">Tidak Ada Data</h6>
                @endforelse

                {{ $galeri->links() }}
            </div>
        </div>
    </section>

    <script>
        document.getElementById('kategori').addEventListener('change', function() {
            this.form.submit();
        });
    </script>
@endsection
