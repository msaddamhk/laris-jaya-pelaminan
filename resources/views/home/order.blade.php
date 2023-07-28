@extends('Layout.home.main2')

@section('content')
    <section id="about" class="py-5">
        <div class="container py-3">

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (auth()->user()->no_hp === null || auth()->user()->alamat === null)
                <div class="alert alert-danger">
                    Silahkan lengkapi
                    @if (empty(auth()->user()->no_hp))
                        nomor telepon,
                    @endif
                    @if (empty(auth()->user()->alamat))
                        alamat
                    @endif
                    <a href="{{ route('home.update.profile', auth()->user()->id) }}">disini</a>
                </div>
            @endif

            <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Hari</th>
                                        <th scope="col">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="d-flex">
                                            <img src="{{ asset('storage/' . $jasa->jasaFoto->first()->foto) }}"
                                                width="60px" height="60px" alt="" data-aos="fade-in"
                                                data-aos-delay="150" style="object-fit: cover" loading="lazy" />
                                            <p class="my-auto ms-3">{{ $jasa->nama }}</p>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="jumlah" id="jumlahInput"
                                                value="{{ request()->get('jumlah') }}" max="{{ $jasa->jumlah_maksimal }}"
                                                min="{{ $jasa->jumlah_minimal }}" oninput="validity.valid||(value='');"
                                                id="exampleFormControlInput1" placeholder="" required />
                                        </td>

                                        <td>
                                            {{ request()->get('tanggal_reservasi') }} -
                                            {{ request()->get('tanggal_akhir') }}
                                        </td>

                                        <td> Rp {{ number_format($jasa->harga) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        @csrf

                        <p class="mt-3">Custom Pesanan</p>

                        <hr />

                        @php
                            $totalHarga = 0;
                            $jumlah = request()->input('jumlah');
                        @endphp

                        @foreach ($jasa->jasaOpsi as $opsi)
                            <small class="text-muted">{{ $opsi->nama }}</small>
                            <div class="d-flex gap-3 mt-1">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    @foreach ($opsi->jasaItems as $item)
                                        <a @class([
                                            'btn btn-sm btn-primary',
                                            'active' => request(str()->slug($opsi->nama)) == $item->id,
                                        ])
                                            href="{{ route('order.index', [...request()->all(), str()->slug($opsi->nama) => $item->id]) }}">
                                            {{ $item->label }} (Rp {{ number_format($item->harga) }})
                                        </a>
                                        @php
                                            if (request(str()->slug($opsi->nama)) == $item->id) {
                                                $totalHarga += $item->harga;
                                            }
                                        @endphp
                                    @endforeach
                                </div>
                                <input type="hidden" name="{{ str()->slug($opsi->nama) }}"
                                    value="{{ request(str()->slug($opsi->nama)) }}">
                            </div>
                        @endforeach

                        @php
                            $totalHarga += $jasa->harga;
                            $totalHarga = $totalHarga * $jumlah;
                        @endphp

                        <input type="number" class="form-control" name="jasa" value="{{ $jasa->id }}"
                            id="exampleFormControlInput1" placeholder="" hidden />

                        <input type="hidden" class="form-control" name="tanggal_reservasi"
                            value="{{ request()->get('tanggal_reservasi') }}" id="exampleFormControlInput1"
                            placeholder="" />

                        @if ($jasa->banyak_hari == true)
                            <input type="hidden" class="form-control" name="tanggal_akhir"
                                value="{{ request()->get('tanggal_akhir') }}" id="exampleFormControlInput1"
                                placeholder="" />
                        @endif


                    </div>


                    <div class="col-md-4">
                        <div class="card p-3">

                            <h6 class="fw-bold">Pilih Metode Pembayaran</h6>
                            <hr>
                            <div class="row px-3">
                                <div class="form-check col-md-6">
                                    <input class="form-check-input"
                                        onclick="document.getElementById('x').style.display = 'block'" type="radio"
                                        name="metode_pembayaran" id="exampleRadios1" value="online" required checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Bayar Secara Online
                                    </label>
                                </div>

                                <div class="form-check col-md-6">
                                    <input onclick="document.getElementById('x').style.display = 'none'"
                                        class="form-check-input" type="radio" name="metode_pembayaran" id="pembayaran"
                                        value="cod" required>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Bayar Secara langsung
                                    </label>
                                </div>
                            </div>

                            <hr>

                            <div id="x">

                                @foreach ($bank as $item)
                                    <small class="text-muted">Nama Bank : {{ $item->nama_bank }}</small>
                                    <small class="text-muted">No Rekening : {{ $item->no_rekening }}</small>
                                @endforeach

                                <p class="mb-2">Upload Bukti Pembayaran</p>
                                <input type="file" class="form-control mb-2" name="bukti_pembayaran">

                                <small class="mb-2" style="font-size: 10px">* Silahkan Lewati jika ingin membayar
                                    nanti</small>
                            </div>


                            <h6 class="fw-bold" id="total-harga">Total : Rp {{ number_format($totalHarga) }}</h6>

                            <button type="submit" class="btn btn-success btn-sm" style="font-size: 12px"
                                @if (auth()->user()->no_hp === null || auth()->user()->alamat === null) disabled @endif>
                                <i class="bi bi-wallet"></i> Bayar Sekarang
                            </button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                flatpickr("#selected_dates", {
                    mode: "range",
                    minDate: "today",
                    dateFormat: "Y-m-d",
                });
            });
        </script>

        <script>
            const jumlahInput = document.getElementById('jumlahInput');

            jumlahInput.addEventListener('change', () => {

                const jumlahBaru = jumlahInput.value;

                const currentParams = new URLSearchParams(window.location
                    .search);
                currentParams.set('jumlah', jumlahBaru);

                const currentUrlWithoutParams = window.location.origin + window.location.pathname;

                window.location.href = currentUrlWithoutParams + '?' + currentParams.toString();
            });
        </script>
    @endpush



@endsection
