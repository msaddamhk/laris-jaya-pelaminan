<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $totalPemasukanPerMinggu = 0;
        // $totalKeuntunganPerMinggu = 0;

        $totalPemasukanPerBulan = 0;
        $totalKeuntunganPerBulan = 0;

        $totalPemasukanKeseluruhan = 0;
        $totalKeuntunganKeseluruhan = 0;

        // $pesananMingguIni = Pemesanan::where('status_pembayaran', '1')
        //     ->where('created_at', '>=', now()->startOfWeek())
        //     ->where('created_at', '<=', now()->endOfWeek())
        //     ->get();

        // foreach ($pesananMingguIni as $pesanan) {
        //     $totalPemasukanPerMinggu += $pesanan->hitungPemasukan();
        //     $totalKeuntunganPerMinggu += $pesanan->hitungKeuntungan();
        // }

        $pesananBulanIni = Pemesanan::where('status_pembayaran', '1')
            ->where('created_at', '>=', now()->startOfMonth())
            ->where('created_at', '<=', now()->endOfMonth())
            ->get();

        foreach ($pesananBulanIni as $pesanan) {
            $totalPemasukanPerBulan += $pesanan->hitungPemasukan();
            $totalKeuntunganPerBulan += $pesanan->hitungKeuntungan();
        }

        $pesananKeseluruhan = Pemesanan::where('status_pembayaran', '1')->get();

        foreach ($pesananKeseluruhan as $pesanan) {
            $totalPemasukanKeseluruhan += $pesanan->hitungPemasukan();
            $totalKeuntunganKeseluruhan += $pesanan->hitungKeuntungan();
        }


        // grafik

        $keuntunganPerBulan = [];
        $pemasukanPerBulan = [];
        $labels = [];

        for ($i = 1; $i <= 12; $i++) {
            $bulanIni = now()->month($i)->startOfMonth();
            $bulanLabel = $bulanIni->format('M');

            $pesananBulanIni = Pemesanan::where('status_pembayaran', '1')
                ->whereMonth('created_at', $bulanIni->month)
                ->whereYear('created_at', $bulanIni->year)
                ->get();

            $totalKeuntunganBulanIni = 0;
            $totalPemasukanBulanIni = 0;

            foreach ($pesananBulanIni as $pesanan) {
                $totalPemasukanBulanIni += $pesanan->hitungPemasukan();
                $totalKeuntunganBulanIni += $pesanan->hitungKeuntungan();
            }

            $keuntunganPerBulan[] = $totalKeuntunganBulanIni;
            $pemasukanPerBulan[] = $totalPemasukanBulanIni;
            $labels[] = $bulanLabel;
        }

        return view('admin.dashboard.index', compact('totalPemasukanPerBulan', 'totalKeuntunganPerBulan', 'totalPemasukanKeseluruhan', 'totalKeuntunganKeseluruhan', 'keuntunganPerBulan', 'labels', 'pemasukanPerBulan'));
    }
}
