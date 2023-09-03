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
                    Silakan lengkapi
                    @if (empty(auth()->user()->no_hp))
                        nomor telepon,
                    @endif
                    @if (empty(auth()->user()->alamat))
                        alamat
                    @endif
                    <a href="{{ route('home.update.profile', auth()->user()->id) }}">di sini</a>
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
                                        @if ($jasa->harga != '0')
                                            <th scope="col">Harga</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="d-flex">
                                            <a href="{{ asset('storage/jasa_foto/' . $jasa->jasaFoto->first()->foto) }}">
                                                <img src="{{ asset('storage/jasa_foto/' . $jasa->jasaFoto->first()->foto) }}"
                                                    width="60px" height="60px" alt="" data-aos-delay="150"
                                                    style="object-fit: cover" loading="lazy" />
                                            </a>
                                            <p class="my-auto ms-3">{{ $jasa->nama }}</p>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="jumlah" id="jumlahInput"
                                                value="{{ request()->get('jumlah') }}" max="{{ $jasa->jumlah_maksimal }}"
                                                min="{{ $jasa->jumlah_minimal }}" oninput="validity.valid||(value='');"
                                                id="exampleFormControlInput1" placeholder="" required />
                                        </td>
                                        <td>
                                            @php
                                                $tanggal_reservasi = request()->get('tanggal_reservasi');
                                                $tanggal_akhir = request()->get('tanggal_akhir');
                                                $tanggal_reservasi_obj = new DateTime($tanggal_reservasi);
                                                if ($tanggal_akhir) {
                                                    $tanggal_akhir_obj = new DateTime($tanggal_akhir);
                                                    $selisih = $tanggal_reservasi_obj->diff($tanggal_akhir_obj);
                                                    $jumlah_hari = $selisih->days + 1;
                                                } else {
                                                    $jumlah_hari = 1;
                                                }
                                            @endphp
                                            {{ $tanggal_reservasi }} - {{ $tanggal_akhir }} ({{ $jumlah_hari }}) Hari
                                        </td>
                                        @if ($jasa->harga != '0')
                                            <td> Rp {{ number_format($jasa->harga) }}</td>
                                        @endif
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
                                    @foreach ($opsi->jasaItems->sortBy('harga') as $item)
                                        <a @class([
                                            'btn btn-sm btn-outline-dark',
                                            'active' => request(str()->slug($opsi->nama)) == $item->id,
                                        ])
                                            href="{{ route('order.index', [...request()->all(), str()->slug($opsi->nama) => $item->id]) }}"
                                            style="font-size:11px">
                                            {{ $item->label }}
                                            @if ($item->harga != '0')
                                                (Rp {{ number_format($item->harga) }})
                                            @endif
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
                            $totalHarga = $totalHarga * $jumlah * $jumlah_hari;
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
                                @if ($jasa->is_cod == true)
                                    <div class="form-check col-md-6">
                                        <input onclick="document.getElementById('x').style.display = 'none'"
                                            class="form-check-input" type="radio" name="metode_pembayaran" id="pembayaran"
                                            value="cod" required>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Bayar Secara langsung
                                        </label>
                                    </div>
                                @endif
                            </div>
                            <hr>
                            <h6 class="fw-bold" id="total-harga">Total : Rp {{ number_format($totalHarga) }}</h6>
                            <h6 class="fw-bold">Catatan Pembayaran</h6>
                            <hr>
                            <select class="form-select mb-3" name="catatan_pembayaran" aria-label="Default select example"
                                onchange="updateTotal()" required>
                                <option selected disabled>Pilih</option>
                                <option value="lunas">Lunas</option>
                                @if ($totalHarga >= 20000000)
                                    <option value="75%" {{ old('metode_pembayaran') == '75%' ? 'selected' : '' }}>Bayar
                                        75%</option>
                                @elseif ($totalHarga >= 10000000)
                                    <option value="55%" {{ old('metode_pembayaran') == '55%' ? 'selected' : '' }}>Bayar
                                        55%</option>
                                @elseif ($totalHarga >= 5000000)
                                    <option value="35%" {{ old('metode_pembayaran') == '35%' ? 'selected' : '' }}>Bayar
                                        35%</option>
                                @else
                                    <option value="25%" {{ old('metode_pembayaran') == '25%' ? 'selected' : '' }}>Bayar
                                        25%</option>
                                @endif
                            </select>
                            <h6 class="fw-bold" id="harga-baru"></h6>
                            <hr>
                            <div id="x" class="mb-2">
                                @foreach ($bank as $item)
                                    <p class="text-muted m-0">Nama Bank : {{ $item->nama_bank }}</p>
                                    <p class="text-muted m-0">No Rekening : {{ $item->no_rekening }}</p>
                                    <p class="text-muted">Atas Nama : {{ $item->atas_nama }}</p>
                                @endforeach
                                <p class="mb-2">Upload Bukti Pembayaran</p>
                                <input type="file" class="form-control mb-2" name="bukti_pembayaran">
                                <small class="" style="font-size: 12px">Silahkan Lewati jika ingin membayar
                                    nanti, batas pembayaran 1 jam setelah pesanan di buat</small>
                            </div>
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
                const currentParams = new URLSearchParams(window.location.search);
                currentParams.set('jumlah', jumlahBaru);
                const currentUrlWithoutParams = window.location.origin + window.location.pathname;
                window.location.href = currentUrlWithoutParams + '?' + currentParams.toString();
            });
        </script>
        <script>
            const totalHarga = <?= $totalHarga ?>;
            const hargaBaruElement = document.getElementById('harga-baru');

            function updateTotal() {
                const selectElement = document.querySelector('select[name="catatan_pembayaran"]');
                const selectedValue = selectElement.value;
                if (selectedValue === "lunas") {
                    hargaBaruElement.textContent = "";
                } else if (selectedValue === "25%") {
                    const hargaBaru = Math.ceil(totalHarga * 0.25);
                    hargaBaruElement.textContent = `Yang harus dibayar di awal: Rp ${numberFormat(hargaBaru)}`;
                } else if (selectedValue === "35%") {
                    const hargaBaru = Math.ceil(totalHarga * 0.35);
                    hargaBaruElement.textContent = `Yang harus dibayar di awal: Rp ${numberFormat(hargaBaru)}`;
                } else if (selectedValue === "50%") {
                    const hargaBaru = Math.ceil(totalHarga * 0.50);
                    hargaBaruElement.textContent = `Yang harus dibayar di awal: Rp ${numberFormat(hargaBaru)}`;
                } else if (selectedValue === "75%") {
                    const hargaBaru = Math.ceil(totalHarga * 0.75);
                    hargaBaruElement.textContent = `Yang harus dibayar di awal: Rp ${numberFormat(hargaBaru)}`;
                }
            }

            function numberFormat(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }
        </script>
    @endpush
@endsection
