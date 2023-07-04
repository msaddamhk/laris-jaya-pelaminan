@extends('Layout.home.main2')

@section('content')
    <section>
        <div class="container py-5">
            <h5 class="mb-3">Daftar Pesanan</h5>
            @foreach ($terpesan as $item)
                <div class="card py-4 px-3 mb-4">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No Pemesanan</th>
                                    <th scope="col">Nama Jasa</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Tanggal Acara</th>
                                    <th scope="col">Status Pembayaran</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($item->pemesananItem as $pemesananItem)
                                        <td>{{ $item->no_pemesanan }}</td>
                                        <td>
                                            {{ $pemesananItem->jasa->nama }}

                                            @foreach ($pemesananItem->pemesananItemOpsi as $pemesananItemOpsi)
                                                <br>
                                                - {{ $pemesananItemOpsi->jasaOpsiItem->label }}
                                            @endforeach
                                        </td>
                                        <td>{{ $pemesananItem->jumlah }}</td>
                                    @endforeach

                                    <td>{{ $item->tanggal_acara }}</td>
                                    <td>
                                        @if ($item->status_pembayaran == 1)
                                            SUDAH BAYAR
                                        @else
                                            BELUM BAYAR
                                        @endif
                                    </td>
                                    <td>Rp {{ number_format($item->jumlah()) }}</td>
                                    <td>
                                        @php
                                            $tanggalAcara = \Carbon\Carbon::parse($item->tanggal_acara);
                                            $sekarang = \Carbon\Carbon::now();
                                        @endphp
                                        @if ($item->bukti_pembayaran == 'null' && $tanggalAcara->diffInDays($sekarang) > 1)
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('edit.pesanan', $item->id) }}">Upload
                                                Bukti Pembayaran
                                            </a>
                                        @else
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('invoice', $item->id) }}">Download
                                                Invoice</a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endsection
