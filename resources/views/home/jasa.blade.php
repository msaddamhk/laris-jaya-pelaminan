@extends('Layout.home.main2')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row">
                {{-- <form action="{{ route('home.jasa') }}" method="GET">
                    <div class="d-flex me-2 mb-4">
                        <input type="text" name="cari" value="{{ request('cari') }}"
                            placeholder="Masukkan nama Jasa"class="form-control me-2" />
                        <button class="btn btn-search d-flex justify-content-center align-items-center p-0" type="submit">
                            <img src="{{ asset('asset/admin/images/ic_search.svg') }}" width="20px" height="20px" />
                        </button>
                    </div>
                </form> --}}

                <form action="{{ route('home.jasa') }}" method="get">
                    <div class="card p-3 mb-5">
                        <div class="row justify-content-between">
                            <div class="col-md-6 mb-3 mb-lg-0">
                                <label for="exampleFormControlInput1" class="form-label">Pilih Kategori</label>
                                <div class="form-group">
                                    <select name="kategori" id="kategori" class="form-select">
                                        <option value="all" @if ($selectedKategori === 'all') selected @endif>All
                                        </option>
                                        @foreach ($kategoris as $id => $nama)
                                            <option value="{{ $id }}"
                                                @if ($selectedKategori == $id) selected @endif>
                                                {{ $nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 mb-lg-3">

                                <label for="exampleFormControlInput1" class="form-label">Cari</label>
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input type="text" class="form-control border-0" name="keyword"
                                                value="{{ $selectedKeyword }}" placeholder="Masukkan nama jasa">
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <button type="submit" class="btn btn-primary btn-sm" style="font-size: 10px">
                                                Cari Data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>


                @forelse ($jasa as $item)
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('detail', [$item]) }}" class="text-decoration-none text-black">
                            <div>
                                <img src="{{ asset('storage/jasa_foto/' . $item->jasaFoto->first()->foto) }}"
                                    class="card-img-top" height="260px" style="object-fit: cover; width: 100%"
                                    alt="..." />
                                <div>
                                    <h5 class="card-title fw-bold mb-1 mt-2"> {{ $item->nama }}</h5>
                                    <p class="card-text" style="color: #a1947c">Rp {{ number_format($item->harga) }}</p>
                                </div>
                                <a class="btn btn-dark btn-sm me-2 mt-2"
                                    href="https://web.whatsapp.com/send?phone=62895600765363&text=Halo%20Admin%2C%20saya%20ingin%20melakukan%20konsultasi%20mengenai%20{{ $item->nama }}"
                                    target="_blank">
                                    <i class="bi bi-whatsapp"></i> Konsultasi
                                </a>
                            </div>
                        </a>
                    </div>
                @empty
                    <h6 class="text-center">Tidak Ada Data</h6>
                @endforelse

                {{ $jasa->links() }}
            </div>
        </div>
    </section>

    <script>
        document.getElementById('kategori').addEventListener('change', function() {
            this.form.submit();
        });
    </script>
@endsection
