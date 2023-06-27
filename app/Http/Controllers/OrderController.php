<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\Models\JasaOpsiItem;
use App\Models\Pemesanan;
use App\Models\PemesananItem;
use App\Models\RekeningBank;
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
            $noPemesanan = uniqid();
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
                $item = JasaOpsiItem::findOrFail(request(str()->slug($opsi->nama)));
                $pemesananItem->pemesananItemOpsi()->create([
                    'jasa_opsi_item_id' => $item->id
                ]);
            }

            return redirect()->route('terpesan');
        }

        return back()->with('error', 'Jasa ini tidak tersedia');
    }

    public function terpesan(Request $request)
    {
        $terpesan = Pemesanan::where('user_id', auth()->user()->id)->get();
        return view('home.terpesan', compact('terpesan'));
    }
}
