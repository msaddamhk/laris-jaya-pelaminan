@extends('Layout.home.main2')

@section('content')
    <section id="about" class="py-5">
        <div class="container py-3">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
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
                                        <td>{{ request()->get('jumlah') }}</td>
                                        <td> Rp {{ number_format($jasa->harga) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        @csrf
                        @php
                            $totalHarga = 0;
                            $jumlah = request()->input('jumlah');
                        @endphp

                        @foreach ($jasa->jasaOpsi as $opsi)
                            @foreach ($opsi->jasaItems as $item)
                                @php
                                    if (request()->input(Str::slug($opsi->nama)) == $item->id) {
                                        $totalHarga += $jasa->harga + $item->harga * $jumlah;
                                    }
                                @endphp
                            @endforeach
                        @endforeach

                        @foreach ($jasa->jasaOpsi as $opsi)
                            <small class="text-muted">{{ $opsi->nama }}</small>
                            <hr />
                            <div class="d-flex gap-3">
                                @foreach ($opsi->jasaItems as $item)
                                    <div>
                                        <input type="{{ $opsi->tipe }}"
                                            id="{{ str()->slug($opsi->nama) . $loop->iteration }}"
                                            name="{{ str()->slug($opsi->nama) }}" value="{{ $item->id }}"
                                            @checked(request(str()->slug($opsi->nama)) == $item->id)>
                                        <label
                                            for="{{ str()->slug($opsi->nama) . $loop->iteration }}">{{ $item->label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <input type="number" class="form-control" name="jasa" value="{{ $jasa->id }}"
                            id="exampleFormControlInput1" placeholder="" hidden />

                        <input type="number" class="form-control" name="jumlah" value="{{ request()->get('jumlah') }}"
                            id="exampleFormControlInput1" placeholder="" hidden />

                        <input type="date" class="form-control" name="tanggal"
                            value="{{ request()->get('tanggal_reservasi') }}" id="exampleFormControlInput1" placeholder=""
                            hidden />

                        <hr>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-3">
                            @foreach ($bank as $item)
                                <small class="text-muted">Nama Bank : {{ $item->nama_bank }}</small>
                                <small class="text-muted">No Rekening : {{ $item->no_rekening }}</small>
                                <hr>
                            @endforeach
                            <small class="mb-2">Upload Bukti Pembayaran</small>
                            <input type="file" class="form-control mb-2" name="bukti_pembayaran">
                            <small class="mb-2" style="font-size: 10px">* Silahkan Lewati jika ingin membayar
                                nanti</small>
                            <h6 class="fw-bold">Total : Rp {{ number_format($totalHarga) }}</h6>
                            <button type="submit" class="btn btn-success btn-sm" style="font-size: 12px">
                                <i class="bi bi-wallet"></i> Bayar Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
