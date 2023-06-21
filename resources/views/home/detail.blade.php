@extends('Layout.home.main2')

@section('content')
    <section id="about" class="py-5">
        <div class="container py-3">
            <div class="row">

                <div class="col-md-6">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($jasa->jasaFoto as $key => $item)
                                <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="d-block w-100" alt="...">
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

                <div class="col-md-6 my-auto" data-aos="fade-in" data-aos-delay="350">
                    <div class="col-md-9 mx-0 my-3 mx-lg-5">
                        <h4 class="text-uppercase fw-bold mt-2 mt-lg-0" style="color: #a1947c" data-aos="fade-in"
                            data-aos-delay="100">
                            {{ $jasa->nama }}
                        </h4>

                        <h5 class="text-uppercase fw-bold mt-2 mt-lg-0" data-aos="fade-in" data-aos-delay="100">
                            Rp {{ number_format($jasa->harga) }}
                        </h5>

                        <hr />

                        <p style="color: rgb(55, 55, 55); font-weight: 400; font-size: 12px;">
                            {{ $jasa->deskripsi }}
                        </p>

                        <button type="button" class="btn btn-outline-dark btn-sm me-2" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Beli Sekarang ->
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('order.index') }}" method="GET">

                        <label for="datepicker" class="mb-2">Pilih Tanggal Acara</label>
                        <div class="input-group mb-3">
                            <input type="text" name="tanggal_reservasi" class="form-control" id="datepicker"
                                placeholder="Select a date" required>
                        </div>

                        @if ($jasa->jumlah_maksimal > 1)
                            <label for="jumlah" class="mb-2">Jumlah</label>
                            <div class="input-group">
                                <input type="number" name="jumlah" class="form-control" id="jumlah"
                                    placeholder="jumlah" max="{{ $jasa->jumlah_maksimal }}"
                                    min="{{ $jasa->jumlah_minimal }}" oninput="validity.valid||(value='');" required>
                            </div>
                            <small for="jumlah" class="mb-5 text-secondary" style="font-size: 13px">Maksimum
                                Pesanan <b class="text-danger fs-6">{{ $jasa->jumlah_maksimal }}</b> dan minimun
                                pesanan <b class="text-danger fs-6">{{ $jasa->jumlah_minimal }}</b></small>
                        @endif


                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            var bookedDates = ['2023-06-18', '2023-06-19', '2023-06-22', '2023-06-23'];
            document.addEventListener('DOMContentLoaded', function() {
                flatpickr("#datepicker", {
                    disable: bookedDates,
                    dateFormat: "Y-m-d",
                    minDate: "today",
                });
            });
        </script>
    @endpush
@endsection
