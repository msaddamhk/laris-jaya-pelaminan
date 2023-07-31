<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use App\Models\Pemesanan;
use App\Models\Vendor;
use DateTime;
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

        $tahun = 2023;
        for ($i = 1; $i <= 12; $i++) {
            $bulanIni = DateTime::createFromFormat('Y-m-d', $tahun . '-' . $i . '-01');
            $bulanLabel = $bulanIni->format('M');

            $pesananBulanIni = Pemesanan::where('status_pembayaran', '1')
                ->whereMonth('created_at', $bulanIni->format('m'))
                ->whereYear('created_at', $bulanIni->format('Y'))
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

        $hitung_jasa = Jasa::count();
        $hitung_vendor = Vendor::count();


        return view('admin.dashboard.index', compact('totalPemasukanPerBulan', 'totalKeuntunganPerBulan', 'totalPemasukanKeseluruhan', 'totalKeuntunganKeseluruhan', 'keuntunganPerBulan', 'labels', 'pemasukanPerBulan', 'hitung_jasa', 'hitung_vendor'));
    }
}
