<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use App\Models\Pemesanan;

class DetailJasaController extends Controller
{
    // public function index(Jasa $jasa)
    // {
    //     // $tanggalpesanan = Pemesanan::join('pemesanan_item', 'pemesanan.id', '=', 'pemesanan_item.pemesanan_id')
    //     //     ->where('pemesanan_item.jasa_id', $jasa->id)
    //     //     ->get()
    //     //     ->map(function ($item) {
    //     //         return [
    //     //             'tanggal' => $item->tanggal_acara,
    //     //             'status_pembayaran' => $item->status_pembayaran == 1,
    //     //             'expired' =>  $item->created_at->addMinutes(1)->diffInMinutes(now(), false) > 0,
    //     //             'created_at' => $item->created_at->format('Y-m-d H:i:s'),
    //     //         ];
    //     //     });

    //     // $tanggalpesanan = $tanggalpesanan->filter(fn ($item) => ($item['status_pembayaran'] || !$item['expired']))->pluck('tanggal');

    //     $tanggalpesanan = $jasa->booking->filter(fn ($item) => $item->bookingStatus())->pluck('tanggal_booking');

    //     return view('home.detail', compact('jasa', 'tanggalpesanan'));
    // }

    public function index(Jasa $jasa)
    {
        $tanggalpesanan = Pemesanan::join('booking', 'pemesanan.id', '=', 'booking.pemesanan_id')
            ->where('booking.jasa_id', $jasa->id)
            ->get()
            ->map(function ($item) {
                return [
                    'tanggal' => $item->tanggal_booking,
                    'status_pembayaran' => $item->status_pembayaran == 1,
                    'metode_pembayaran' => $item->metode_pembayaran == "cod",
                    'expired' =>  $item->created_at->addHours(1)->diffInMinutes(now(), false) > 0,
                    'created_at' => $item->created_at->format('Y-m-d H:i:s'),
                ];
            });

        $tanggalpesanan = $tanggalpesanan->filter(fn ($item) => ($item['status_pembayaran'] || !$item['expired'] || $item['metode_pembayaran']))->pluck('tanggal');
        $jumlahPesananPerTanggal = $tanggalpesanan->countBy();
        $jumlahMaksimal = $jasa->jumlah_maksimal;

        $tanggalTerlaluBanyak = $jumlahPesananPerTanggal->filter(function ($jumlahPesanan) use ($jumlahMaksimal) {
            return $jumlahPesanan >= $jumlahMaksimal;
        })->keys();

        $tanggalpesanan = $tanggalTerlaluBanyak;
        return view('home.detail', compact('jasa', 'tanggalpesanan'));
    }
}
