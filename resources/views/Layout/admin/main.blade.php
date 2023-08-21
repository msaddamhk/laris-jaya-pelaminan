<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Laris Jaya Pelaminan</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" />

    <link href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/admin/css/styles.css') }}" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('heads')
</head>

<body class="bg-black">
    <nav class="sidebar offcanvas-md offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false">
        <div class="d-flex justify-content-end m-3 d-block d-md-none">
            <button aria-label="Close" data-bs-dismiss="offcanvas" data-bs-target=".sidebar"
                class="btn p-0 border-0 fs-4">
                <i class="bi bi-x-lg text-white"></i>
            </button>
        </div>
        <div class="pt-2 d-flex flex-column gap-5">
            <div class="menu p-0">
                <p class="text-white fw-bold mt-4">Laris Jaya</p>

                <a href="{{ route('dashboard.index') }}"
                    class="item-menu {{ Request::is('dashboard*') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge me-2"></i>
                    Dashboard
                </a>
                <a href="{{ route('kategori.index') }}"
                    class="item-menu my-auto {{ Request::is('kategori*') ? 'active' : '' }}">
                    <i class="fa-solid fa-tags me-2"></i>
                    Kelola Kategori Jasa
                </a>
                <a href="{{ route('vendor.index') }}" class="item-menu {{ Request::is('vendor*') ? 'active' : '' }}">
                    <i class="fa-solid fa-shop me-2"></i>
                    Kelola Vendor
                </a>
                <a href="{{ route('jasa.index') }}" class="item-menu {{ Request::is('jasa*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-gear me-2"></i>
                    Kelola Jasa
                </a>

                <a href="{{ route('galeri-kategori.index') }}"
                    class="item-menu my-auto {{ Request::is('galeri-kategori*') ? 'active' : '' }}">
                    <i class="fa-solid fa-tags me-2"></i>
                    Kelola Kategori Galeri
                </a>

                <a href="{{ route('kelola-galeri.index') }}"
                    class="item-menu my-auto {{ Request::is('kelola-galeri*') ? 'active' : '' }}">
                    <i class="bi bi-file-image me-2"></i>
                    Kelola Galeri
                </a>

                <a href="{{ route('slider.index') }}"
                    class="item-menu my-auto {{ Request::is('slider*') ? 'active' : '' }}">
                    <i class="fa-solid fa-sliders me-2"></i>
                    Kelola Slider
                </a>

                <a href="{{ route('rekening.index') }}"
                    class="item-menu {{ Request::is('rekening*') ? 'active' : '' }}">
                    <i class="fab fa-cc-visa me-2"></i>
                    Kelola Rekening Bank
                </a>
                <a href="{{ route('pemesanan.index') }}"
                    class="item-menu {{ Request::is('kelola-pemesanan*') ? 'active' : '' }}">
                    <i class="fa-solid fa-bag-shopping me-2"></i>
                    Kelola Pesanan
                </a>
                <a href="{{ route('data-admin.index') }}"
                    class="item-menu {{ Request::is('data-admin*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users me-2"></i>
                    Kelola Admin
                </a>
            </div>

            <div class="menu">
                <div class="dropend">
                    <button type="button" class="border-0 bg-transparent text-white dropdown-toggle item-menu"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user me-2"></i>
                        Hi, {{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu item-menu">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button class="bg-transparent border-0 ms-2 p-0 text-dark"
                                onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                                Logout
                            </button>
                        </form>
                        <a href="{{ route('data-admin.edit', auth()->user()->id) }}"
                            class="text-decoration-none ms-2 text-dark">Update Data</a>
                    </ul>
                </div>
            </div>

        </div>
    </nav>

    <main class="content">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <button class="sidebarCollapseDefault bg-transparent p-0 border-0 d-none d-md-block"
                        aria-label="Hamburger Button">
                        <i class="bi bi-list"></i>
                    </button>

                    <button data-bs-toggle="offcanvas" data-bs-target=".sidebar" aria-controls="sidebar"
                        aria-label="Hamburger Button" class="sidebarCollapseMobile btn p-0 border-0 d-block d-md-none">
                        <i class="bi bi-list fw-1"></i>
                    </button>

                </div>
            </div>
        </nav>

        <section class="p-3">
            @yield('content')
        </section>

    </main>

    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script> --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

    <script src="{{ asset('asset/admin/js/custom.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <script>
        document.querySelector('form.needs-validation').addEventListener('submit', function(event) {
            if (!event.target.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            event.target.classList.add('was-validated');
            if (!event.target.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
        }, false);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>

    <script>
        const choices = new Choices('#user', {
            searchEnabled: true,
            searchChoices: true,
            placeholder: true,
            placeholderValue: 'Pilih',
        });
    </script>

    @stack('scripts')

</body>

</html>
