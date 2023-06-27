@extends('Layout.home.main2')

@section('content')
    <section class="py-5">
        <div class="container">
            <h5 class="mb-3" style="color: rgb(55, 55, 55);" data-aos="fade-in" data-aos-delay="100">
                Seluruh Jasa
            </h5>

            <div class="row">
                <form action="{{ route('home.jasa') }}" method="GET">
                    <div class="d-flex me-2 mb-4">
                        <input type="text" name="cari" value="{{ request('cari') }}"
                            placeholder="Masukkan nama Jasa"class="form-control me-2" />
                        <button class="btn btn-search d-flex justify-content-center align-items-center p-0" type="submit">
                            <img src="{{ asset('asset/admin/images/ic_search.svg') }}" width="20px" height="20px" />
                        </button>
                    </div>
                </form>

                @forelse ($jasa as $item)
                    <div class="col-md-3">
                        <a href="{{ route('detail', [$item]) }}" class="text-decoration-none text-black">
                            <div>
                                <img src="{{ asset('storage/' . $item->jasaFoto->first()->foto) }}" class="card-img-top"
                                    height="260px" style="object-fit: cover; width: 100%" alt="..." />
                                <div class="card-bod">
                                    <h5 class="card-title fw-bold mb-1 mt-2"> {{ $item->nama }}</h5>
                                    <p class="card-text" style="color: #a1947c">Rp {{ number_format($item->harga) }}</p>
                                </div>
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
@endsection
