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
                        <a href="{{ asset('storage/galeri/' . $item->foto) }}" class="text-decoration-none text-black">
                            <div class="galeri"
                                style="background-image: url('{{ asset('storage/galeri/' . $item->foto) }}')">
                                <div class="garis mx-4 mt-3">
                                    <h5>{{ $loop->iteration }}</h5>
                                </div>
                                <div class="text mx-4 mb-4">
                                    <h5 class="m-0">{{ $item->tanggal_booking }}</h5>
                                    <hr class="my-2" width="30%" />
                                    <p class="" style="font-size: 10px">
                                        {{ $item->judul }}
                                    </p>
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
