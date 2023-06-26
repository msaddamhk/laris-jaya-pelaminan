@extends('Layout.home.main2')

@section('content')
    <section>
        <div class="container py-5">

            @foreach ($terpesan as $item)
                <div class="card py-4 px-3 mb-4">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No Pemesanan</th>
                                    <th scope="col">Nama Jasa</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Tanggal Acara</th>
                                    <th scope="col">Status Pembayaran</th>
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
                                        <td>Rp {{ number_format($item->jumlah()) }}</td>
                                        <td>{{ $pemesananItem->jumlah }}</td>
                                        <td>{{ $item->tanggal_acara }}</td>
                                        <td>
                                            @if ($item->status_pembayaran == 1)
                                                SUDAH BAYAR
                                            @else
                                                BELUM BAYAR
                                            @endif
                                        </td>
                                        <td>@mdo</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endsection
