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
                    // $today = \Carbon\Carbon::createFromFormat('m-d-Y', '11-13-2023');
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
                            <h6>Catatan Pembayaran : {{ $item->catatan_pembayaran }}</h6>
                            <h6>Status Pembayaran :
                                @if ($item->status_pembayaran == 1)
                                    SUDAH BAYAR
                                @else
                                    BELUM BAYAR
                                @endif
                            </h6>
                            <h6>Total : Rp {{ number_format($item->jumlah()) }}</h6>

                            @if ($item->status_pembayaran == 0)
                                @if ($item->catatan_pembayaran == '25%')
                                    <?php
                                    $total = $item->jumlah();
                                    $Bayarawal = ceil($total * 0.25);
                                    ?>
                                    <h6>Yang harus di bayar di awal : Rp {{ number_format($Bayarawal) }}</h6>
                                @elseif ($item->catatan_pembayaran == '35%')
                                    <?php
                                    $total = $item->jumlah();
                                    $Bayarawal = ceil($total * 0.35);
                                    ?>
                                    <h6>Yang harus di bayar di awal : Rp {{ number_format($Bayarawal) }}</h6>
                                @elseif ($item->catatan_pembayaran == '55%')
                                    <?php
                                    $total = $item->jumlah();
                                    $Bayarawal = ceil($total * 0.55);
                                    ?>
                                    <h6>Yang harus di bayar di awal : Rp {{ number_format($Bayarawal) }}</h6>
                                @elseif ($item->catatan_pembayaran == '75%')
                                    <?php
                                    $total = $item->jumlah();
                                    $Bayarawal = ceil($total * 0.75);
                                    ?>
                                    <h6>Yang harus di bayar di awal : Rp {{ number_format($Bayarawal) }}</h6>
                                @endif
                            @endif

                            @if ($item->status_pembayaran == 1)
                                @if ($item->catatan_pembayaran == '25%')
                                    <?php
                                    $total = $item->jumlah();
                                    $sudahBayar = ceil($total * 0.25);
                                    $sisa = $total - $sudahBayar;
                                    ?>
                                    <h6>Yang Sudah di Bayar : Rp {{ number_format($sudahBayar) }}</h6>
                                    <h6>Sisa : Rp {{ number_format($sisa) }}</h6>
                                @elseif ($item->catatan_pembayaran == '35%')
                                    <?php
                                    $total = $item->jumlah();
                                    $sudahBayar = ceil($total * 0.35);
                                    $sisa = $total - $sudahBayar;
                                    ?>
                                    <h6>Yang Sudah di Bayar : Rp {{ number_format($sudahBayar) }}</h6>
                                    <h6>Sisa : Rp {{ number_format($sisa) }}</h6>
                                @elseif ($item->catatan_pembayaran == '55%')
                                    <?php
                                    $total = $item->jumlah();
                                    $sudahBayar = ceil($total * 0.55);
                                    $sisa = $total - $sudahBayar;
                                    ?>
                                    <h6>Yang Sudah di Bayar : Rp {{ number_format($sudahBayar) }}</h6>
                                    <h6>Sisa : Rp {{ number_format($sisa) }}</h6>
                                @elseif ($item->catatan_pembayaran == '75%')
                                    <?php
                                    $total = $item->jumlah();
                                    $sudahBayar = ceil($total * 0.75);
                                    $sisa = $total - $sudahBayar;
                                    ?>
                                    <h6>Yang Sudah di Bayar : Rp {{ number_format($sudahBayar) }}</h6>
                                    <h6>Sisa : Rp {{ number_format($sisa) }}</h6>
                                @endif
                            @endif

                        </div>

                        <div class="col-md-6">

                            @if ($item->metode_pembayaran == 'online')
                                <h6 class="fw-bold">No Rekening</h6>
                                @foreach ($no_rekening as $rekening)
                                    <h6>{{ $rekening->nama_bank }}</h6>
                                    <h6>{{ $rekening->no_rekening }}</h6>
                                @endforeach
                            @endif

                            @if ($item->metode_pembayaran == 'online' && $item->status_pembayaran == '0')
                                @php
                                    $waktuMulai = $item->created_at;
                                    $waktuAkhir = $waktuMulai->copy()->addHours(1);
                                @endphp
                                <p>Waktu tersisa: <span id="countdown_{{ $item->id }}"></span></p>

                                <script>
                                    function updateCountdown{{ $item->id }}() {
                                        var endTime = new Date("{{ $waktuAkhir }}").getTime();
                                        var now = new Date().getTime();
                                        var timeRemaining = endTime - now;

                                        if (timeRemaining > 0) {
                                            var formattedTime = new Date(timeRemaining).toISOString().substr(11, 8);
                                            document.getElementById('countdown_{{ $item->id }}').textContent = formattedTime;
                                        } else {
                                            document.getElementById('countdown_{{ $item->id }}').textContent = "Waktu telah habis.";
                                        }
                                    }
                                    updateCountdown{{ $item->id }}();
                                    setInterval(updateCountdown{{ $item->id }}, 1000);
                                </script>
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
                                    <a class="btn btn-primary btn-sm"
                                        href="https://web.whatsapp.com/send?phone=62895600765363&text=Halo%20Admin%2C%20saya%20ingin%20melakukan%20pelunasan%20pesanan"
                                        target="_blank">
                                        Silahkan Hubungi Admin untuk pelunasan
                                    </a>
                                @else
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $item->id }}">
                                        Lihat Invoice
                                    </button>

                                    <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Nama: {{ $item->user->name }}</p>
                                                    <p>No Pemesanan: {{ $item->no_pemesanan }}</p>
                                                    <p>Tanggal: {{ $item->created_at }}</p>
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
                                                                                -
                                                                                {{ $pemesananItemOpsi->jasaOpsiItem->label }}
                                                                                <br>
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

                                                    <h6>Total : Rp {{ number_format($item->jumlah()) }}</h6>

                                                    <h6>
                                                        Status Pembayaran :
                                                        <b>{{ $item->status_pembayaran == 1 ? 'Sudah Bayar' : '' }}</b>
                                                    </h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-success btn-sm"
                                                        href="{{ route('invoice', $item->id) }}">Download
                                                        Invoice</a>
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @elseif ($item->status_pembayaran == '1')
                            @if ($item->catatan_pembayaran == 'lunas')
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $item->id }}">
                                    Lihat Invoice
                                </button>

                                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Nama: {{ $item->user->name }}</p>
                                                <p>No Pemesanan: {{ $item->no_pemesanan }}</p>
                                                <p>Tanggal: {{ $item->created_at }}</p>
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
                                                                            <br>
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

                                                <h6>Total : Rp {{ number_format($item->jumlah()) }}</h6>

                                                <h6>
                                                    Status Pembayaran :
                                                    <b>{{ $item->status_pembayaran == 1 ? 'Sudah Bayar' : '' }}</b>
                                                </h6>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('invoice', $item->id) }}">Download
                                                    Invoice</a>
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @if ($item->metode_pembayaran == 'online')
                                    <a class="btn btn-primary btn-sm" href="{{ route('edit.pesanan', $item->id) }}">Upload
                                        bukti
                                        Pelunasan</a>
                                @else
                                    <a class="btn btn-primary btn-sm"
                                        href="https://web.whatsapp.com/send?phone=62895600765363&text=Halo%20Admin%2C%20saya%20ingin%20melakukan%20pelunasan%20pesanan"
                                        target="_blank">
                                        Silahkan Hubungi Admin untuk pelunasan
                                    </a>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
