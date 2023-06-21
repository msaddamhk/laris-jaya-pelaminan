<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use App\Models\JasaOpsi;
use App\Models\JasaOpsiItem;
use Illuminate\Http\Request;

class JasaOpsiItemController extends Controller
{
    public function index(Request $request, Jasa $jasa, JasaOpsi $jasaopsi)
    {
        $jasa_opsi_item = $jasaopsi->jasaItems()->where('label', 'like', '%' . request('cari') . '%')->paginate(15);
        return view('admin.jasa_opsi_item.index', compact('jasa_opsi_item', 'jasa', 'jasaopsi'));
    }

    public function create(Request $request, Jasa $jasa, JasaOpsi $jasaopsi)
    {
        return view('admin.jasa_opsi_item.create', compact('jasa', 'jasaopsi'));
    }

    public function store(Request $request, Jasa $jasa, JasaOpsi $jasaopsi)
    {
        $request->validate([
            'value' => 'required',
            'label' => 'required',
            'harga' => 'required',
        ]);

        JasaOpsiItem::create([
            "opsi_jasa_id" => $jasaopsi->id,
            "label" => $request->label,
            "value" => $request->value,
            "harga" => $request->harga,
            "foto" => "1",
        ]);

        return redirect()->route('opsi.item.index', [$jasa, $jasaopsi])->with('success', 'Data Berhasi di Tambah');
    }


    public function edit(Request $request, Jasa $jasa, JasaOpsi $jasaopsi, JasaOpsiItem $jasaopsiitem)
    {
        return view('admin.jasa_opsi_item.edit', compact('jasa', 'jasaopsi', 'jasaopsiitem'));
    }

    public function update(Request $request, Jasa $jasa, JasaOpsi $jasaopsi, JasaOpsiItem $jasaopsiitem)
    {
        $request->validate([
            'value' => 'required',
            'label' => 'required',
            'harga' => 'required',
        ]);

        $jasaopsiitem->label = $request->label;
        $jasaopsiitem->value = $request->value;
        $jasaopsiitem->harga = $request->harga;
        $jasaopsiitem->save();

        return redirect()->route('opsi.item.index', [$jasa, $jasaopsi])->with('success', 'Data Berhasi di Update');
    }

    public function destroy(Request $request, Jasa $jasa, JasaOpsi $jasaopsi, JasaOpsiItem $jasaopsiitem)
    {
        $jasaopsiitem->delete();
        return redirect()->route('opsi.item.index', [$jasa, $jasaopsi])->with('success', 'Data Berhasi di Hapus');
    }
}
