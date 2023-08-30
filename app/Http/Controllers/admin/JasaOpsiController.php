<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use App\Models\JasaOpsi;
use Illuminate\Http\Request;

class JasaOpsiController extends Controller
{
    public function index(Request $request, Jasa $jasa)
    {
        $jasa_opsi = $jasa->jasaOpsi()
            ->where('nama', 'like', '%' . request('cari') . '%')->paginate(15);
        return view('admin.jasa_opsi.index', compact('jasa_opsi', 'jasa'));
    }

    public function create(Request $request, Jasa $jasa)
    {
        return view('admin.jasa_opsi.create', compact('jasa'));
    }

    public function store(Request $request, Jasa $jasa)
    {
        $request->validate([
            // 'nama' => 'required|string|unique:jasa_opsi,nama',
            'nama' => 'required|string',
        ]);

        JasaOpsi::create([
            "jasa_id" => $jasa->id,
            "nama" => $request->nama,
            "tipe" => "radio",
        ]);

        return redirect()->route('opsi.index', $jasa)->with('success', 'Data Berhasi di Tambah');
    }

    public function edit(Request $request, Jasa $jasa, JasaOpsi $jasaopsi)
    {
        return view('admin.jasa_opsi.edit', compact('jasa', 'jasaopsi'));
    }

    public function update(Request $request, Jasa $jasa, JasaOpsi $jasaopsi)
    {
        $request->validate([
            // 'nama' => 'required|string|max:255|unique:jasa_opsi,nama,' . $jasaopsi->id,
            'nama' => 'required|string|max:255',
        ]);

        $jasaopsi->nama = $request->input('nama');
        $jasaopsi->save();

        return redirect()->route('opsi.index', [$jasa, $jasaopsi])->with('success', 'Data Berhasi di Update');
    }

    public function destroy(Request $request, Jasa $jasa, JasaOpsi $jasaopsi)
    {
        $jasaopsi->delete();
        return redirect()->route('opsi.index', [$jasa, $jasaopsi])->with('success', 'Data Berhasi di Hapus');
    }
}
