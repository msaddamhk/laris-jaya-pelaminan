<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
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
}
