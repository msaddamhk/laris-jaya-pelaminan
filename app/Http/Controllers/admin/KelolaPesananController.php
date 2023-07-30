<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\PemesananItem;
use Illuminate\Http\Request;

class KelolaPesananController extends Controller
{
    public function index(Request $request)
    {
        $pemesanan = Pemesanan::where('no_pemesanan', 'like', '%' . request('cari') . '%')
            ->orderBy('status_pembayaran', 'desc')
            ->paginate(15);
        return view('admin.pesanan.index', compact('pemesanan'));
    }


    public function edit(Request $request, Pemesanan $pemesanan)
    {
        return view('admin.pesanan.edit', compact('pemesanan'));
    }

    public function update(Request $request, Pemesanan $pemesanan)
    {

        $request->validate([
            'status_pembayaran' => 'required',
            'catatan_pembayaran' => 'required',
        ]);

        $pemesanan->status_pembayaran = $request->status_pembayaran;
        $pemesanan->catatan_pembayaran = $request->catatan_pembayaran;
        $pemesanan->save();

        return redirect()->route('pemesanan.index')->with('success', 'Data Berhasi di Update');
    }

    public function pemesanan_item_edit(Request $request, PemesananItem $pemesanan_item)
    {
        return view('admin.pesanan_item.edit', compact('pemesanan_item'));
    }

    public function pemesanan_item_update(Request $request, PemesananItem $pemesanan_item)
    {

        $request->validate([
            'status_pengembalian_barang' => 'required',
        ]);

        $pemesanan_item->status_pengembalian_barang = $request->status_pengembalian_barang;
        $pemesanan_item->save();

        return redirect()->route('pemesanan.index')->with('success', 'Data Berhasi di Update');
    }
}
