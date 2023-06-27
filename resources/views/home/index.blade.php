@extends('Layout.home.main1')

@section('content')
    <section class="py mt-4" id="produk">
        <div class="container">
            <h1 class="text-black text-center text-uppercase" style="font-size: 40px; font-weight: 600" data-aos="fade-in"
                data-aos-delay="100">
                Produk Laris Jaya Pelaminan
            </h1>
            <p class="text-center mb-4" style="color: rgb(55, 55, 55); font-weight: 400; font-size: 12px" data-aos="fade-in"
                data-aos-delay="100">
                Berikut ini Produk/Jasa yang kami tawarkan
            </p>
            <div class="row">
                @foreach ($jasa as $item)
                    <div class="col-md-3 mb-4">
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
                @endforeach
            </div>

            <div class="mt-3 d-flex justify-content-lg-center">
                <a href="{{ route('home.jasa') }}" class="btn btn-outline-dark" style="font-size: 13px">Selengkapnya -></a>
            </div>
        </div>
    </section>
@endsection
