<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="index, follow" />

    <meta name="description" content="laris jaya pelaminan adalah wedding organizer yang telah berpengalaman" />
    <meta name="keywords" content="laris jaya pelaminan" />
    <meta name="article:author" content="" />

    <link rel="shortcut icon" href="{{ asset('asset/gambar/logo2.png') }}}" />

    <title>Laris Jaya Pelaminan</title>

    <link rel="stylesheet" href="{{ asset('asset/css/css.css') }}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />


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

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">

    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

</head>

<body style="font-family: 'Playfair Display', serif">
    <nav class="navbar navbar-expand-lg bg-black py-3">
        <div class="container text-center">
            <a class="navbar-brand text-white" href="{{ route('home') }}">
                <img src="{{ asset('asset/gambar/logo2.png') }}" alt="" width="85" height="32" />
            </a>

            <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="bi bi-list fs-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mx-auto mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link navlinkcolor" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navlinkcolor" href="{{ route('home') }}#about">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navlinkcolor" href="{{ route('home') }}#keunggulan">Keunggulan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navlinkcolor" href="{{ route('home.jasa') }}">Jasa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navlinkcolor" href="{{ route('home.galeri') }}">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navlinkcolor" href="{{ route('home') }}#faq">FAQ</a>
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
                position: sticky;
                top: 0;
                --bs-navbar-padding-y: 0px;
                transition: all ease-in-out 0.5s;
                font-weight: 500;
                font-size: 13px;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI",
                    Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue",
                    sans-serif;
                z-index: 1000;
            }
        </style>
    </nav>

    @yield('content')


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
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7942.3951520059!2d95.35271595!3d5.53769!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3040378007e697e1%3A0x486f5c8d5f10a148!2sPango%20Deah%2C%20Kec.%20Ulee%20Kareng%2C%20Kota%20Banda%20Aceh%2C%20Aceh!5e0!3m2!1sid!2sid!4v1693387747152!5m2!1sid!2sid"
                                style="border:0;" allowfullscreen="" loading="lazy"
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

    @stack('scripts')
</body>

</html>
