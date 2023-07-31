@extends('Layout.home.main2')

@section('content')
    <section>
        <div class="container py-5">
            <h5 class="mb-3">Daftar Pesanan</h5>
            @foreach ($terpesan as $item)
                @php
                    $bookingDates = $item->booking->pluck('tanggal_booking')->sort();
                    $startDate = $bookingDates->first();
                    $endDate = $bookingDates->last();
                    $today = now();
                    $daysLate = 0;
                    
                    if ($today->greaterThan($endDate)) {
                        $daysLate = $today->diffInDays($endDate);
                        $lateNotification = "Silahkan melakukan pengembalian . Anda sudah telat $daysLate hari.";
                    } else {
                        $lateNotification = "Tanggal pengembalian $endDate ";
                    }
                @endphp
                <div class="card py-4 px-3 mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>No Pemesanan : {{ $item->no_pemesanan }}</h6>
                            <h6>Tanggal Pemesanan : {{ $startDate }} Sampai {{ $endDate }}
                                ({{ $item->jumlahhari() }}
                                Hari)
                            </h6>
                            <h6>Metode Pembayaran : {{ $item->metode_pembayaran }}</h6>
                            <h6>Status Pembayaran :
                                @if ($item->status_pembayaran == 1)
                                    SUDAH BAYAR
                                @else
                                    BELUM BAYAR
                                @endif
                            </h6>
                            <h6>Total : Rp {{ number_format($item->jumlah()) }}</h6>
                        </div>

                        <div class="col-md-6">
                            <h6 class="fw-bold">No Rekening</h6>
                            @if ($item->metode_pembayaran == 'online')
                                @foreach ($no_rekening as $rekening)
                                    <h6>{{ $rekening->nama_bank }}</h6>
                                    <h6>{{ $rekening->no_rekening }}</h6>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Jasa</th>
                                    <th scope="col">Opsi</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->pemesananItem as $pemesananItem)
                                    <tr>
                                        <td>
                                            {{ $pemesananItem->jasa->nama }}
                                        </td>
                                        <td>

                                            @foreach ($pemesananItem->pemesananItemOpsi as $pemesananItemOpsi)
                                                - {{ $pemesananItemOpsi->jasaOpsiItem->label }}
                                            @endforeach
                                        </td>
                                        <td>{{ $pemesananItem->jumlah }}</td>

                                        <td>
                                            @if ($pemesananItem->jasa->status_pengembalian == true)
                                                @if ($pemesananItem->status_pengembalian_barang == '0')
                                                    <p>{{ $lateNotification }}</p>
                                                @else
                                                    -
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="">
                        @if ($item->status_pembayaran == '0')
                            @if ($item->metode_pembayaran == 'online')
                                @if ($item->created_at->addHour(1)->isPast())
                                    <p>Expired</p>
                                @else()
                                    <a class="btn btn-primary btn-sm" href="{{ route('edit.pesanan', $item->id) }}">Upload
                                        Bukti
                                        Pembayaran</a>
                                @endif
                            @endif
                            @if ($item->metode_pembayaran == 'cod')
                                @if ($item->status_pembayaran == '0')
                                    <a class="btn btn-primary btn-sm" href="">Silahkan Hubungi
                                        Admin
                                        untuk pelunasan</a>
                                @else
                                    <a class="btn btn-success btn-sm" href="{{ route('invoice', $item->id) }}">Download
                                        Invoice</a>
                                @endif
                            @endif
                        @elseif ($item->status_pembayaran == '1')
                            <a class="btn btn-success btn-sm" href="{{ route('invoice', $item->id) }}">Download Invoice</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
