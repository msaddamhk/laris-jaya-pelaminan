<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\Models\JasaOpsiItem;
use App\Models\Pemesanan;
use App\Models\PemesananItem;
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

    public function store(Request $request)
    {
        $tanggal = $request->input('tanggal');

        $isTanggalExist = PemesananItem::whereHas('pemesanan', function ($query) use ($tanggal) {
            $query->where('tanggal_acara', $tanggal);
            $query->where('status_pembayaran', true);
        })->where('jasa_id', $request->jasa)->exists();

        if ($isTanggalExist) {
            return back()->with('error', 'Tanggal sudah dipesan untuk jasa ini');
        }

        $jasa = Jasa::where('id', $request->jasa)->first();

        if ($jasa) {

            $code = 'PESANAN-' . mt_rand(0000, 9999);
            $noPemesanan = $code;
            $pemesanan = new Pemesanan();
            $pemesanan->user_id = auth()->user()->id;
            $pemesanan->no_pemesanan = $noPemesanan;
            $pemesanan->tanggal_acara = $tanggal;

            $request->bukti_pembayaran?->store('public/bukti_pembayaran');

            if ($request->bukti_pembayaran) {
                $pemesanan->status_pembayaran = true;
                $pemesanan->bukti_pembayaran = $request->bukti_pembayaran->hashName();
            } else {
                $pemesanan->status_pembayaran = false;
                $pemesanan->bukti_pembayaran = "null";
            }

            $pemesanan->save();

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
        $terpesan = Pemesanan::latest()->where('user_id', auth()->user()->id)->get();
        return view('home.terpesan', compact('terpesan'));
    }

    public function edit(Request $request, Pemesanan $pemesanan)
    {
        return view('home.edit-pesanan', compact('pemesanan'));
    }

    public function update(Request $request, Pemesanan $pemesanan)
    {
        $tanggal = $pemesanan->tanggal_acara;

        $isTanggalExist = false;

        foreach ($pemesanan->pemesananItem as $pemesananItem) {
            $jasaId = $pemesananItem->jasa->id;
            $isExist = PemesananItem::whereHas('pemesanan', function ($query) use ($tanggal) {
                $query->where('tanggal_acara', $tanggal)
                    ->where('status_pembayaran', true);
            })
                ->where('jasa_id', $jasaId)
                ->exists();

            if ($isExist) {
                $isTanggalExist = true;
                break;
            }
        }

        if ($isTanggalExist) {

            return back()->with('error', 'Tanggal sudah dipesan untuk jasa ini');
        } else {

            $request->file('bukti_pembayaran')->store('public/bukti_pembayaran');
            $pemesanan->bukti_pembayaran = $request->file('bukti_pembayaran')->hashName();
            $pemesanan->status_pembayaran = true;
            $pemesanan->save();
            return redirect()->route('terpesan');
        }
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
