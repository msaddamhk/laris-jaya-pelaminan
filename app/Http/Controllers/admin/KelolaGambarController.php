<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use App\Models\JasaFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KelolaGambarController extends Controller
{
    public function index(Request $request, Jasa $jasa)
    {
        $gambar = $jasa->jasaFoto()->paginate(15);
        return view('admin.gambar.index', compact('gambar', 'jasa'));
    }

    public function create(Request $request, Jasa $jasa)
    {
        return view('admin.gambar.create', compact('jasa'));
    }

    public function store(Request $request, Jasa $jasa)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $request->foto?->store('public/jasa_foto');

        JasaFoto::create([
            "jasa_id" => $jasa->id,
            'foto' => $request->foto ? $request->foto->hashName() : null,
        ]);

        return redirect()->route('gambar.index', $jasa)->with('success', 'Data Berhasi di Tambah');
    }

    public function edit(Request $request, Jasa $jasa, JasaFoto $jasafoto)
    {
        $JasaFoto = $jasafoto;
        return view('admin.gambar.edit', compact('jasa', 'JasaFoto'));
    }

    public function update(Request $request, Jasa $jasa, JasaFoto $jasafoto)
    {
        $JasaFoto = $jasafoto;

        $request->validate([
            'foto' => 'nullable',
        ]);

        if ($request->hasFile('foto')) {
            Storage::delete('public/jasa_foto/' . $JasaFoto->foto);
            $request->foto->store('public/jasa_foto');
            $JasaFoto->foto = $request->foto->hashName();
        }

        $JasaFoto->save();

        return redirect()->route('gambar.index', [$jasa, $JasaFoto])->with('success', 'Data Berhasi di Update');
    }

    public function destroy(Jasa $jasa, JasaFoto $jasafoto)
    {
        $JasaFoto = $jasafoto;
        Storage::delete('public/jasa_foto/' . $JasaFoto->foto);
        $JasaFoto->delete();
        return redirect()->route('gambar.index', [$jasa, $JasaFoto])->with('success', 'Data Berhasi di Hapus');
    }
}
