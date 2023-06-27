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

    <div class="table-responsive">
        <table class="table">

            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">No Pemesanan</th>
                    <th scope="col">Nama Jasa</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Tanggal Acara</th>
                    <th scope="col">Status Pembayaran</th>
                    <th scope="col">Bukti Pembayaran</th>
                </tr>
            </thead>
            @foreach ($pemesanan as $item)
                <tbody>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
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
                            <td>
                                @if ($item->status_pembayaran == 1)
                                    <a href="{{ asset('/storage/bukti_pembayaran/' . $item->bukti_pembayaran) }}" download>
                                        Unduh Bukti Pembayaran
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            @endforeach
        </table>
        {{ $pemesanan->links() }}
    </div>
@endsection
