@extends('Layout.home.main1')

@section('content')
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            @foreach ($slider as $index => $item)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="hiro" style="background-image: url('{{ asset('storage/slider/' . $item->foto) }}')">
                        <div class="container d-flex align-items-center justify-content-center h-100"
                            style="z-index: 100; position: relative">
                            <div class="text-white">
                                <h2 class="text-center mb-0" data-aos="fade-in" style="font-size: 25px">
                                    Selamat Datang
                                </h2>
                                <h1 class="text-center" data-aos="fade-lef">
                                    Laris Jaya Pelaminan
                                </h1>
                                <p class="text-center" data-aos="fade-in" style="font-size: 18px">
                                    Solusi untuk Pernikahan Anda
                                </p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center w-100"
                            style="position: absolute; bottom: 0; z-index: 100">
                            <a class="btn btn-outline-light rounded-0" onclick="scrollDown()"><i
                                    class="bi bi-arrow-down fs-5"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <section id="about" class="py">
        <div class="container p-lg-0">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('asset/gambar/hiro/hiro1.jpg') }}" width="100%" height="350px" alt=""
                        data-aos="fade-in" data-aos-delay="250" style="object-fit: cover" loading="lazy" />
                </div>
                <div class="col-md-6 my-auto" data-aos="fade-in" data-aos-delay="350">
                    <div class="col-md-9 mx-0 my-3 mx-lg-5">
                        <h6 class="text-uppercase fw-bold mt-4 mt-lg-0" style="color: #a1947c" data-aos="fade-in"
                            data-aos-delay="100">
                            Tentang Kami
                        </h6>
                        <h2 class="mb-3" style="font-size: 30px; color: #000000; line-height: 40px; font-weight: 600;"
                            data-aos="fade-in" data-aos-delay="100">
                            Sejarah Berdirinya <br />
                            Laris Jaya Pelaminan
                        </h2>
                        <p style="color: rgb(55, 55, 55); font-weight: 400; font-size: 12px;">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi
                            totam magnam neque qui, doloribus non suscipit ab mollitia
                            dolorem, nam eveniet, ducimus eius tenetur aperiam sit
                            cupiditate explicabo commodi velit.
                        </p>
                        {{-- <a href="" class="text-decoration-none" style="color: #a1947c">Baca Lebih Lanjut-></a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="keunggulan" class="py mt-4 bg-spesialis">
        <div class="container">
            <h1 class="text-black text-center mb-3 text-uppercase" style="font-size: 40px; font-weight: 600"
                data-aos="fade-in" data-aos-delay="100">
                Keungulan Laris Jaya Pelaminan
            </h1>
            <p class="text-center" style="color: rgb(55, 55, 55); font-weight: 400; font-size: 12px" data-aos="fade-in"
                data-aos-delay="100">
                kami adalah solusi untuk pernikahan Anda
            </p>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card border-0 p-3 mt-3" data-aos="fade-in" data-aos-delay="100">
                        <div class="card-body mx-auto">
                            <h5>Pengalaman</h5>
                            <hr width="20%" />
                            <span class="small text-muted">Kami memiliki pengalaman yang luas dalam mengatur dan
                                menyelenggarakan pernikahan</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card border-0 p-3 mt-3" data-aos="fade-in" data-aos-delay="200">
                        <div class="card-body mx-auto">
                            <h5>Tim Ahli</h5>
                            <hr width="20%" />
                            <span class="small text-muted">Kami memiliki tim yang terdiri dari para ahli di bidang
                                pernikahan.
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card border-0 p-3 mt-3" data-aos="fade-in" data-aos-delay="300">
                        <div class="card-body mx-auto">
                            <h5>Detail-Oriented</h5>
                            <hr width="20%" />
                            <span class="small text-muted">Kami sangat memperhatikan detail dalam setiap aspek
                                pernikahan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


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
                <a href="{{ route('home.jasa') }}" class="btn btn-outline-dark" style="font-size: 13px">
                    Selengkapnya ->
                </a>
            </div>
        </div>
    </section>


    <section class="py mt-4" id="galeri">
        <div class="container">
            <h1 class="text-black text-center text-uppercase" style="font-size: 40px; font-weight: 600"
                data-aos="fade-in" data-aos-delay="100">
                Galeri
            </h1>
            <p class="text-center mb-4" style="color: rgb(55, 55, 55); font-weight: 400; font-size: 12px"
                data-aos="fade-in" data-aos-delay="100">
                Berikut ini Projek yang sudah pernah kami kerjakan
            </p>
            <div class="row">
                @foreach ($galeri as $item)
                    <div class="col-md-3 mb-4">
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
                @endforeach
            </div>

            <div class="mt-3 d-flex justify-content-lg-center">
                <a href="{{ route('home.galeri') }}" class="btn btn-outline-dark" style="font-size: 13px">
                    Selengkapnya ->
                </a>
            </div>
        </div>
    </section>



    <section id="faq" class="pb-5">
        <div class="container pb-5">
            <h1 class="text-black text-center text-uppercase mb-4" style="font-size: 40px; font-weight: 600"
                data-aos="fade-in" data-aos-delay="100">
                Pertanyaan <br />
                seputar Laris Jaya Pelaminan
            </h1>
            <div class="row">
                <div class="col-md-6 border-4" data-aos="fade-in" data-aos-delay="100">
                    <details class="faq p-3">
                        <summary>
                            Sejak Berapa lama Laris Jaya <br />
                            Pelaminan telah mulai beroperasi?
                        </summary>
                        <hr />
                        Laris Jaya Pelaminan telah beroperasi selama lebih dari 10 tahun.
                        Kami memiliki pengalaman yang kaya dalam mengorganisir pernikahan
                        dan telah melayani banyak pasangan pengantin dengan sukses.
                    </details>
                </div>

                <div class="col-md-6" data-aos="fade-in" data-aos-delay="200">
                    <details class="faq p-3">
                        <summary>
                            Apakah Laris Jaya Pelaminan dapat mengakomodasi pernikahan
                            dengan budget terbatas?
                        </summary>
                        <hr />
                        Ya, Laris Jaya Pelaminan dapat mengakomodasi pernikahan dengan
                        berbagai anggaran. Tim Kami dapat bekerja dengan Anda untuk
                        merencanakan pernikahan yang sesuai dengan anggaran yang Anda
                        miliki. Kami memiliki jaringan vendor yang luas, sehingga dapat
                        membantu Anda menemukan solusi kreatif dan hemat biaya tanpa
                        mengorbankan kualitas.
                    </details>
                </div>

                <div class="col-md-6" data-aos="fade-in" data-aos-delay="300">
                    <details class="faq p-3">
                        <summary>
                            Apakah Laris Jaya Pelaminan menyediakan layanan konsultasi dan
                            perencanaan penuh?
                        </summary>
                        <hr />
                        Ya, Laris Jaya Pelaminan menyediakan layanan konsultasi dan
                        perencanaan penuh untuk pernikahan. Tim kami akan bekerja dengan
                        Anda mulai dari tahap awal perencanaan hingga pelaksanaan
                        pernikahan. Kami akan membantu Anda dalam merancang konsep,
                        memilih vendor, mengatur jadwal, dan mengurus semua detail
                        pernikahan sehingga Anda dapat menikmati pernikahan tanpa stres.
                    </details>
                </div>

                <div class="col-md-6" data-aos="fade-in" data-aos-delay="400">
                    <details class="faq p-3">
                        <summary>
                            Apakah Laris Jaya Pelaminan menyediakan layanan <br> dekorasi
                            pernikahan?
                        </summary>
                        <hr />
                        Ya, Laris Jaya Pelaminan menyediakan layanan dekorasi pernikahan
                        yang mencakup pemilihan tema, bunga, meja makan, dan elemen
                        dekoratif lainnya.
                    </details>
                </div>
            </div>
        </div>
    </section>
@endsection
