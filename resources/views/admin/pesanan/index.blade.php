@extends('layout.admin.main')

@section('content')
    <div class="d-flex justify-content-between">
        <h5 class="my-auto">Kelola Pesanan</h5>

        <form action="{{ route('pemesanan.index') }}" method="GET">
            <div class="d-flex me-2">
                <input type="text" name="cari" value="{{ request('cari') }}"
                    placeholder="Masukkan No Pesanan"class="form-control me-2" />
                <button class="btn btn-search d-flex justify-content-center align-items-center p-0" type="submit">
                    <img src="{{ asset('asset/admin/images/ic_search.svg') }}" width="20px" height="20px" />
                </button>
            </div>
        </form>
    </div>

    <hr>

    <div class="mt-4">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @foreach ($pemesanan as $item)
            @php
                $bookingDates = $item->booking->pluck('tanggal_booking')->sort();
                $startDate = $bookingDates->first();
                $endDate = $bookingDates->last();
                // $today = \Carbon\Carbon::createFromFormat('m-d-Y', '11-13-2023');
                $today = now();
                $daysLate = 0;
                
                if ($today->greaterThan($endDate)) {
                    $daysLate = $today->diffInDays($endDate);
                    $lateNotification = "Belum melakukan pengembalian . sudah telat $daysLate hari.";
                } else {
                    $lateNotification = "Masi berlangsung sampai $endDate ";
                }
                
            @endphp

            <div class="card py-4 px-3 mb-4">

                <div class="row">

                    <div class="col-md-6">
                        <h6>No Pemesanan : {{ $item->no_pemesanan }}</h6>
                        <h6>Tanggal Acara : {{ $startDate }} Sampai {{ $endDate }} ({{ $item->jumlahhari() }}
                            Hari)
                        </h6>
                        <h6>Metode Pembayaran : {{ $item->metode_pembayaran }}</h6>
                        <h6>Status Pembayaran :
                            @if ($item->status_pembayaran == '0')
                                BELUM BAYAR
                            @else
                                SUDAH BAYAR
                            @endif
                        </h6>
                        <h6>Catatan Pembayaran : {{ $item->catatan_pembayaran }}</h6>
                        <h6>Total : Rp {{ number_format($item->jumlah()) }}</h6>


                        @if ($item->status_pembayaran == 0)
                            @if ($item->catatan_pembayaran == '25%')
                                <?php
                                $total = $item->jumlah();
                                $Bayarawal = ceil($total * 0.25);
                                ?>
                                <h6>Yang harus di bayar di awal : Rp {{ number_format($Bayarawal) }}</h6>
                            @endif
                        @endif

                        @if ($item->catatan_pembayaran == '25%')
                            @if ($item->status_pembayaran == 1)
                                <?php
                                $total = $item->jumlah();
                                $sudahBayar = ceil($total * 0.25);
                                $sisa = $total - $sudahBayar;
                                ?>
                                <h6>Yang Sudah Bayar : Rp {{ number_format($sudahBayar) }}</h6>
                                <h6>Sisa : Rp {{ number_format($sisa) }}</h6>
                            @endif
                        @endif

                    </div>

                    <div class="col-md-6 mt-3 mt-lg-0">
                        <h6>Nama Pemesan : {{ $item->user->name }}</h6>
                        <h6>No HP : {{ $item->user->no_hp }}</h6>
                        <h6>Alamat : {{ $item->user->alamat }}</h6>
                        <h6>Tanggal Pemesanan : {{ $item->created_at }}</h6>
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
                                <th scope="col">Status Pengembalian</th>
                                <th scope="col">Aksi</th>
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
                                                {{ $lateNotification }}
                                            @else
                                                SUDAH DI KEMBALIKAN
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td>
                                        @if ($pemesananItem->jasa->status_pengembalian == true)
                                            <a href="{{ route('pemesanan_item.edit', $pemesananItem->id) }}"
                                                class="btn btn-success btn-sm">Update Pengembalian</a>
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
                    @if ($item->status_pembayaran == '1')
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#exampleModal{{ $item->id }}">
                            Lihat Bukti Pembayaran
                        </button>

                        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        @foreach ($item->buktiPembayaran as $itemFoto)
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ asset('/storage/bukti_pembayaran/' . $itemFoto->foto) }}">
                                                <img src="{{ asset('/storage/bukti_pembayaran/' . $itemFoto->foto) }}"
                                                    alt="" width="100%" height="200px">
                                            </a>
                                        @endforeach

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('pemesanan.hapus_user', $item) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus user yang mempunyai pesanan ini?')">Ini
                                adalah
                                penipuan</button>
                        </form>
                    @endif

                    @if ($item->metode_pembayaran == 'cod')
                        <a href="{{ route('pemesanan.edit', $item->id) }}" class="btn btn-warning btn-sm"
                            @if ($item->status_pembayaran == '0') disabled @endif>Update Pembayaran</a>
                    @endif

                </div>
            </div>
        @endforeach
    </div>
@endsection
