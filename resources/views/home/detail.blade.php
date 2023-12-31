@extends('Layout.home.main2')

@section('content')
    <section id="about" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($jasa->jasaFoto as $key => $item)
                                <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                                    <a href="{{ asset('storage/jasa_foto/' . $item->foto) }}">
                                        <img src="{{ asset('storage/jasa_foto/' . $item->foto) }}"
                                            class="d-block w-100  rounded-1" style="height: 450px;object-fit:cover"
                                            alt="...">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row mt-4">

                <div class="col-md-8" data-aos="fade-in" data-aos-delay="300" style="height: 100%;">
                    <h1 class="ps-2"
                        style="color: rgb(55, 55, 55); font-weight: 800; font-size: 20px;  border-left: 5px solid #a1947c">
                        Deskripsi
                    </h1>
                    <hr>

                    <p style="color: rgb(55, 55, 55); font-weight: 400; font-size: 12px;text-align:justify">
                        {!! $jasa->deskripsi !!}
                    </p>
                </div>

                <div class="col-md-4 card p-4" data-aos="fade-in" data-aos-delay="350" style="height: 100%;">

                    <h5 class="text-uppercase fw-bold mt-2 mt-lg-0" style="color: #a1947c" data-aos="fade-in"
                        data-aos-delay="100">
                        {{ $jasa->nama }}
                    </h5>

                    @if ($jasa->harga != '0')
                        <h6 class="text-uppercase fw-bold mt-2 mt-lg-0" data-aos="fade-in" data-aos-delay="100">
                            Rp {{ number_format($jasa->harga) }}
                        </h6>
                    @endif

                    <hr />

                    <form action="{{ route('order.index') }}" method="GET" id="myForm">

                        <label for="datepicker" class="mb-2">Pilih Tanggal Acara</label>

                        @if ($jasa->banyak_hari == true)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input type="text" name="tanggal_reservasi" class="form-control" id="datepicker"
                                            placeholder="Tanggal Mulai" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input type="text" name="tanggal_akhir" class="form-control" id="datepicker2"
                                            placeholder="Tanggal Akhir" required>
                                    </div>
                                </div>
                            </div>
                        @else()
                            <div class="input-group mb-3">
                                <input type="text" name="tanggal_reservasi" class="form-control" id="datepicker"
                                    placeholder="Silahkan pilih tanggal yang tersedia" required>
                            </div>
                        @endif

                        <input type="hidden" name="jasa" class="form-control" value="{{ $jasa->id }}">

                        <p class="mt-2">Custom Pesanan</p>

                        <hr>

                        @foreach ($jasa->jasaOpsi as $opsi)
                            <h6 class="mb-2">{{ $opsi->nama }}</h6>
                            <div class="">
                                @foreach ($opsi->jasaItems->sortBy('harga') as $item)
                                    <div class="row" style="font-size: 13px">
                                        <div class="col-8 col-md-9">
                                            <input class="mb-3" type="{{ $opsi->tipe }}"
                                                id="{{ str()->slug($opsi->nama) . $loop->iteration }}"
                                                name="{{ str()->slug($opsi->nama) }}" value="{{ $item->id }}"
                                                @checked(request(str()->slug($opsi->nama)) == $item->id) required>

                                            <label
                                                for="{{ str()->slug($opsi->nama) . $loop->iteration }}">{{ $item->label }}
                                                @if ($item->harga != '0')
                                                    (Rp {{ number_format($item->harga) }})
                                                @endif
                                            </label>
                                        </div>
                                        <div class="col-4 col-md-3 mx-auto">
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $item->id }}" style="font-size: 8px">
                                                Lihat Detail Item
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        @if ($jasa->jumlah_maksimal > 1)
                            <p for="jumlah" class="mb-2 mt-2">Jumlah</p>
                            <div class="input-group">
                                <input type="number" name="jumlah" class="form-control" id="jumlah"
                                    placeholder="jumlah" max="{{ $jasa->jumlah_maksimal }}"
                                    min="{{ $jasa->jumlah_minimal }}" oninput="validity.valid||(value='');" required>
                            </div>
                            <p for="jumlah" class="text-secondary" style="font-size: 13px">Maksimum
                                Pesanan <b class="text-danger fs-6">{{ $jasa->jumlah_maksimal }}</b> dan minimun
                                pesanan <b class="text-danger fs-6">{{ $jasa->jumlah_minimal }}</b></p>
                        @else
                            <div class="input-group">
                                <input type="hidden" name="jumlah" class="form-control" id="jumlah" value="1"
                                    placeholder="jumlah" max="{{ $jasa->jumlah_maksimal }}"
                                    min="{{ $jasa->jumlah_minimal }}" oninput="validity.valid||(value='');" required>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-outline-dark btn-sm me-2">
                            Pesan Sekarang ->
                        </button>

                        <a class="btn btn-dark btn-sm me-2"
                            href="https://web.whatsapp.com/send?phone=62895600765363&text=Halo%20Admin%2C%20saya%20ingin%20melakukan%20konsultasi%20mengenai%20{{ $jasa->nama }}"
                            target="_blank">
                            <i class="bi bi-whatsapp"></i> Konsultasi
                        </a>
                    </form>
                </div>
            </div>

            @foreach ($jasa->jasaOpsi as $opsi)
                @foreach ($opsi->jasaItems->sortBy('harga') as $item)
                    <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Item</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Nama item: {{ $item->label }}</p>
                                    <p>Harga: Rp {{ number_format($item->harga) }}</p>
                                    <p>Deskripsi:</p>
                                    <hr>
                                    <p>{!! $item->deskripsi !!}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach

        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        var bookedDates = {!! json_encode($tanggalpesanan) !!};
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#datepicker", {
                disable: bookedDates,
                dateFormat: "Y-m-d",
                minDate: "today",
                required: true
            });
        });

        var bookedDates = {!! json_encode($tanggalpesanan) !!};
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#datepicker2", {
                disable: bookedDates,
                dateFormat: "Y-m-d",
                minDate: "today",
                required: true
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var datepicker = document.getElementById("datepicker");
            var form = document.getElementById("myForm");
            form.addEventListener("submit", function(event) {
                if (!datepicker.value) {
                    event.preventDefault();
                    alert("Mohon pilih tanggal.");
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var datepicker = document.getElementById("datepicker2");
            var form = document.getElementById("myForm");
            form.addEventListener("submit", function(event) {
                if (!datepicker.value) {
                    event.preventDefault();
                    alert("Mohon pilih tanggal Akhir.");
                }
            });
        });
    </script>
@endpush
