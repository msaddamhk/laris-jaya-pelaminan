<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="index, follow" />

    <meta name="description" content="laris jaya pelaminan adalah wedding organizer yang telah berpengalaman" />
    <meta name="keywords" content="laris jaya pelaminan" />
    <meta name="article:author" content="" />

    <link rel="shortcut icon" href="{{ asset('asset/gambar/logo2.png') }}" />
    <title>Laris Jaya Pelaminan</title>

    <link rel="stylesheet" href="{{ asset('asset/css/css.css') }}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <link rel="preload" as="image" href="{{ asset('aseet/gambar/hiro/hiro2.jpg') }}" />
    <link rel="preload" as="image" href="{{ asset('aseet/gambar/hiro/hiro3.jpg') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
        integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body style="font-family: 'Playfair Display', serif">
    <nav class="navbar navbar-expand-lg bg-transparent fixed-top py-3">
        <div class="container text-center">
            <a class="navbar-brand text-white" href="#">
                <img src="{{ asset('asset/gambar/logo2.png') }}" alt="" width="100%" height="40" />
            </a>

            <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="bi bi-list fs-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mx-auto mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link navlinkcolor" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navlinkcolor" href="#about">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navlinkcolor" href="#keunggulan">Keunggulan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navlinkcolor" href="#produk">Jasa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navlinkcolor" href="#faq">Faq</a>
                    </li>
                </ul>

                @auth
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Hi,{{ auth('')->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('terpesan') }}">Pesanan</a></li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('home.update.profile', auth()->user()->id) }}">Update Profil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Keluar
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm text-white"
                        style="font-size: 13px; background-color: #a1947c" type="submit">
                        Masuk <i class="bi bi-box-arrow-in-right"></i>
                    </a>
                @endauth
            </div>
        </div>
        <style>
            .navlinkcolor {
                color: #ffffff;
                text-align: center;
                margin: 5px;
            }

            .navlinkcolor:hover {
                color: #a1947c;
            }

            .navcolor {
                color: #ffffff;
                background-color: rgb(0, 0, 0);
                box-shadow: 0 4px 8px 0 rgba(31, 31, 31, 0.1),
                    0 6px 20px 0 rgba(53, 53, 53, 0);
            }

            .navbar {
                --bs-navbar-padding-y: 0px;
                transition: all ease-in-out 0.5s;
                font-weight: 500;
                font-size: 13px;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI",
                    Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue",
                    sans-serif;
            }
        </style>
        <script>
            const navbar = document.getElementsByTagName("nav")[0];
            const button = document.getElementsByTagName("button")[0];
            const nav_links = document.querySelectorAll(".navlinkcolor");
            window.addEventListener("scroll", function() {
                console.log(window.scrollY);
                if (window.scrollY > 10) {
                    navbar.classList.replace("bg-transparent", "navcolor");
                } else if (this.window.scrollY <= 0) {
                    navbar.classList.replace("navcolor", "bg-transparent");
                }
            });
        </script>
    </nav>

    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="hiro" style="background-image: url('{{ asset('asset/gambar/hiro/hiro2.jpg') }}')">
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

            <div class="carousel-item">
                <div class="hiro" style="background-image: url('{{ asset('asset/gambar/hiro/hiro3.jpg') }}')">
                    <div class="container d-flex align-items-center justify-content-center h-100"
                        style="z-index: 100; position: relative">
                        <div class="text-white">
                            <h3 class="text-center mb-0" data-aos="fade-in" style="font-size: 25px">
                                Selamat Datang
                            </h3>
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
        </div>
    </div>

    <section id="about" class="py">
        <div class="container p-lg-0">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('asset/gambar/hiro/hiro1.jpg') }}" width="100%" height="350px"
                        alt="" data-aos="fade-in" data-aos-delay="250" style="object-fit: cover"
                        loading="lazy" />
                </div>
                <div class="col-md-6 my-auto" data-aos="fade-in" data-aos-delay="350">
                    <div class="col-md-9 mx-0 my-3 mx-lg-5">
                        <h6 class="text-uppercase fw-bold mt-4 mt-lg-0" style="color: #a1947c" data-aos="fade-in"
                            data-aos-delay="100">
                            Tentang Kami
                        </h6>
                        <h2 class="mb-3"
                            style="font-size: 30px; color: #000000; line-height: 40px; font-weight: 600;"
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
                        <a href="" class="text-decoration-none" style="color: #a1947c">Baca Lebih Lanjut-></a>
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
            <p class="text-center" style="color: rgb(55, 55, 55); font-weight: 400; font-size: 12px"
                data-aos="fade-in" data-aos-delay="100">
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

    @yield('content')

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
                            Apakah Laris Jaya Pelaminan menyediakan layanan dekorasi
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

    <footer class="text-lg-start footer px-3 px-lg-0" style="background-color: #000000">
        <div class="container py-5">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h5 class="text-white">Alamat</h5>
                        <p class="text-white" style="font-size: 13px">
                            Desa Pango, Kec. Ulee Kareng, Kota Banda Aceh, Aceh
                        </p>

                        <div class="card border-0" style="border-radius: 0">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7942.002394703513!2d95.34532217090641!3d5.5668371621254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3040370856eb44a3%3A0xb067a6f9b67914b2!2sPineung%2C%20Kec.%20Syiah%20Kuala%2C%20Kota%20Banda%20Aceh%2C%20Aceh!5e0!3m2!1sid!2sid!4v1680078139799!5m2!1sid!2sid"
                                style="border: 0" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                        <p class="text-white mt-3" style="font-size: 13px">
                            Copyright Laris Jaya Pelaminan &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                        </p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6 social-widget">
                    <div class="single-footer-widget">
                        <h5 class="text-white">Ikuti Kami</h5>
                        <div class="footer-social d-flex align-items-center">
                            <a href="https://id-id.facebook.com//" target="_blank" class="fs-5 text-white me-3"><i
                                    class="bi bi-facebook"></i></a>
                            <a href="https://www.instagram.com//" target="_blank" class="fs-5 text-white"><i
                                    class="bi bi-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
        integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="{{ asset('asset/js/js.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
</body>

</html>
