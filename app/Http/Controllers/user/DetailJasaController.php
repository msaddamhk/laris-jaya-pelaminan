<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class DetailJasaController extends Controller
{
    public function index(Jasa $jasa)
    {
        $tanggalpesanan = Pemesanan::join('pemesanan_item', 'pemesanan.id', '=', 'pemesanan_item.pemesanan_id')
            ->where('pemesanan_item.jasa_id', $jasa->id)
            ->where('pemesanan.status_pembayaran', true)
            ->pluck('pemesanan.tanggal_acara')
            ->all();

        return view('home.detail', compact('jasa', 'tanggalpesanan'));
    }
}
