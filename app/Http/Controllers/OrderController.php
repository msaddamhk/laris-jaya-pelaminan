<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BuktiPembayaran;
use App\Models\Jasa;
use App\Models\JasaOpsiItem;
use App\Models\Pemesanan;
use App\Models\RekeningBank;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $jasa = Jasa::where('id', $request->jasa)->first();
        $bank = RekeningBank::all();
        return view('home.order', compact('jasa', 'bank'));
    }

    // public function store(Request $request)
    // {
    //     $tanggal = $request->input('tanggal_reservasi');

    //     $isTanggalExist = PemesananItem::whereHas('pemesanan', function ($query) use ($tanggal) {
    //         $query->where('tanggal_acara', $tanggal);
    //         $query->where('status_pembayaran', true);
    //     })->where('jasa_id', $request->jasa)->exists();

    //     if ($isTanggalExist) {
    //         return back()->with('error', 'Tanggal sudah dipesan untuk jasa ini');
    //     }

    //     $jasa = Jasa::where('id', $request->jasa)->first();

    //     if ($jasa) {

    //         $code = 'PESANAN-' . mt_rand(0000, 9999);
    //         $noPemesanan = $code;
    //         $pemesanan = new Pemesanan();
    //         $pemesanan->user_id = auth()->user()->id;
    //         $pemesanan->no_pemesanan = $noPemesanan;
    //         $pemesanan->tanggal_acara = $tanggal;

    //         $request->bukti_pembayaran?->store('public/bukti_pembayaran');

    //         if ($request->bukti_pembayaran) {
    //             $pemesanan->status_pembayaran = true;
    //             $pemesanan->bukti_pembayaran = $request->bukti_pembayaran->hashName();
    //         } else {
    //             $pemesanan->status_pembayaran = false;
    //             $pemesanan->bukti_pembayaran = "null";
    //         }

    //         $pemesanan->save();

    //         $pemesananItem = $pemesanan->pemesananItem()->create([
    //             'jasa_id' => $jasa->id,
    //             'jumlah' => $request->jumlah
    //         ]);

    //         foreach ($jasa->jasaOpsi as $opsi) {
    //             $namaSlug = str()->slug($opsi->nama);
    //             $item = JasaOpsiItem::find(request($namaSlug));
    //             if ($item) {
    //                 $pemesananItem->pemesananItemOpsi()->create([
    //                     'jasa_opsi_item_id' => $item->id
    //                 ]);
    //             }
    //         }

    //         return redirect()->route('terpesan');
    //     }

    //     return back()->with('error', 'Jasa ini tidak tersedia');
    // }

    public function store(Request $request)
    {
        $tanggal = $request->input('tanggal_reservasi');
        $tanggal_akhir = $request->input('tanggal_akhir');

        $tanggalRange = [];
        $currentDate = strtotime($tanggal);
        $endDate = strtotime($tanggal_akhir);

        $totalHari = (($endDate - $currentDate + 86400) / 86400);

        for ($i = 0; $i < $totalHari; $i++) {
            $tanggalRange[] = date('Y-m-d', strtotime("+$i days", $currentDate));
        }

        $jasa = Jasa::where('id', $request->jasa)->first();


        if ($jasa) {
            $code = 'PESANAN-' . mt_rand(0000, 9999);
            $noPemesanan = $code;
            $pemesanan = new Pemesanan();
            $pemesanan->user_id = auth()->user()->id;
            $pemesanan->no_pemesanan = $noPemesanan;
            $pemesanan->bukti_pembayaran = "null";
            $pemesanan->metode_pembayaran = $request->metode_pembayaran;
            $pemesanan->catatan_pembayaran = $request->catatan_pembayaran;
            if ($request->hasFile('bukti_pembayaran')) {
                $pemesanan->status_pembayaran = true;
            } else {
                $pemesanan->status_pembayaran = false;
            }

            $pemesanan->save();

            if ($request->hasFile('bukti_pembayaran')) {

                $request->validate([
                    'bukti_pembayaran' => 'image|mimes:jpeg,png,jpg|max:2048',
                ]);

                $request->bukti_pembayaran?->store('public/bukti_pembayaran');
                $bukti_pembayaran = new BuktiPembayaran();
                $bukti_pembayaran->foto = $request->file('bukti_pembayaran')->hashName();
                $bukti_pembayaran->pemesanan_id = $pemesanan->id;
                $bukti_pembayaran->save();
            }

            if ($jasa->banyak_hari == true) {
                foreach ($tanggalRange as $tanggalBooking) {
                    $booking = new Booking();
                    $booking->jasa_id = $jasa->id;
                    $booking->pemesanan_id = $pemesanan->id;
                    $booking->tanggal_booking = $tanggalBooking;
                    $booking->save();
                }
            } else {
                $booking = new Booking();
                $booking->jasa_id = $jasa->id;
                $booking->pemesanan_id = $pemesanan->id;
                $booking->tanggal_booking = $tanggal;
                $booking->save();
            }

            $pemesananItem = $pemesanan->pemesananItem()->create([
                'jasa_id' => $jasa->id,
                'jumlah' => $request->jumlah
            ]);

            foreach ($jasa->jasaOpsi as $opsi) {
                $namaSlug = str()->slug($opsi->nama);
                $item = JasaOpsiItem::find(request($namaSlug));
                if ($item) {
                    $pemesananItem->pemesananItemOpsi()->create([
                        'jasa_opsi_item_id' => $item->id
                    ]);
                }
            }

            return redirect()->route('terpesan');
        }

        return back()->with('error', 'Jasa ini tidak tersedia');
    }


    public function terpesan(Request $request)
    {
        $no_rekening = RekeningBank::all();
        $terpesan = Pemesanan::latest()->where('user_id', auth()->user()->id)->get();
        return view('home.terpesan', compact('terpesan', 'no_rekening'));
    }

    public function edit(Request $request, Pemesanan $pemesanan)
    {
        return view('home.edit-pesanan', compact('pemesanan'));
    }

    public function update(Request $request, Pemesanan $pemesanan)
    {
        if ($pemesanan->status_pembayaran == "0") {
            $request->validate([
                'bukti_pembayaran' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $request->bukti_pembayaran?->store('public/bukti_pembayaran');
            $bukti_pembayaran = new BuktiPembayaran();
            $bukti_pembayaran->foto = $request->bukti_pembayaran->hashName();
            $bukti_pembayaran->pemesanan_id = $pemesanan->id;
            $bukti_pembayaran->save();
            $pemesanan->status_pembayaran = true;
            $pemesanan->save();
        } else {
            $request->validate([
                'bukti_pembayaran' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $request->bukti_pembayaran?->store('public/bukti_pembayaran');
            $bukti_pembayaran = new BuktiPembayaran();
            $bukti_pembayaran->foto = $request->bukti_pembayaran->hashName();
            $bukti_pembayaran->pemesanan_id = $pemesanan->id;
            $bukti_pembayaran->save();
            $pemesanan->catatan_pembayaran = "lunas";
            $pemesanan->save();
        }

        return redirect()->route('terpesan');
    }

    public function pdf(Pemesanan $pemesanan)
    {
        $pdf = new Dompdf();
        $pdf->loadHtml(view('home.pdf', ['data' => $pemesanan]));
        $pdf->setpaper('A4' . 'portrait');
        $pdf->render();
        $pdf->stream();
    }
}
