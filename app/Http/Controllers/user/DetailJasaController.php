<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use App\Models\Pemesanan;

class DetailJasaController extends Controller
{
    public function index(Jasa $jasa)
    {
        $tanggalpesanan = Pemesanan::join('pemesanan_item', 'pemesanan.id', '=', 'pemesanan_item.pemesanan_id')
            ->where('pemesanan_item.jasa_id', $jasa->id)
            ->get()
            ->map(function ($item) {
                return [
                    'tanggal' => $item->tanggal_acara,
                    'status_pembayaran' => $item->status_pembayaran == 1,
                    'expired' =>  $item->created_at->addMinutes(1)->diffInMinutes(now(), false) > 0,
                    'created_at' => $item->created_at->format('Y-m-d H:i:s'),
                ];
            });

        $tanggalpesanan = $tanggalpesanan->filter(fn ($item) => ($item['status_pembayaran'] || !$item['expired']))->pluck('tanggal');

        return view('home.detail', compact('jasa', 'tanggalpesanan'));
    }
}
