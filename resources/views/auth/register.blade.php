@extends('layouts.app')

@section('content')
    <style>
        .login {
            min-height: 100vh;
        }

        .bg-image {
            background-image: url('asset/gambar/loginwallpaper.jpg');
            background-size: cover;
            background-position: center;
        }

        .login-heading {
            font-weight: 300;
        }

        .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
        }
    </style>

    <div class="container-fluid ps-md-0">
        <div class="row g-0">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto">
                                <h3 class="login-heading mb-4">Selamat Datang</h3>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-floating
                                    mb-3">

                                        <input id="name" type="text" id="floatingInput"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        <label for="floatingInput">Nama</label>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="form-floating mb-3">
                                        <input id="email" type="email" id="floatingemail"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">
                                        <label for="floatingemail">email</label>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" id="floatingalamat"
                                            class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                            value="{{ old('alamat') }}" required autocomplete="alamat">
                                        <label for="floatingalamat">Alamat</label>

                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="number" id="floatingnohp"
                                            class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                                            value="{{ old('no_hp') }}" required autocomplete="no_hp">
                                        <label for="floatingnohp">No HP</label>

                                        @error('no_hp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input id="password" type="password" id="floatingpassword"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">
                                        <label for="floatingpassword">Password</label>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                        <label for="password-confirm">Password Konfirmasi</label>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit"
                                            class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-3">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
