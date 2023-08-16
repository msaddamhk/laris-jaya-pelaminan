<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\kategoriGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeri = Galeri::where('judul', 'like', '%' . request('cari') . '%')->paginate(15);
        return view('admin.galeri.index', compact('galeri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori_galeri = kategoriGaleri::all();
        return view('admin.galeri.create', compact('kategori_galeri'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'kategori_galeri_id' => 'required|exists:kategori_galeri,id',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $request->foto?->store('public/galeri');

        Galeri::create([
            'judul' => $request->judul,
            'tanggal_booking' => $request->tanggal,
            'kategori_galeri_id' => $request->kategori_galeri_id,
            'foto' => $request->foto ? $request->foto->hashName() : null,
        ]);

        return redirect()->route('kelola-galeri.index')->with('success', 'galeri berhasil di tambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $kelola_galeri)
    {
        $galeri = $kelola_galeri;
        $kategori_galeri = kategoriGaleri::all();
        return view('admin.galeri.edit', compact('galeri', 'kategori_galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $kelola_galeri)
    {
        $galeri = $kelola_galeri;

        $request->validate([
            'judul' => 'required|max:255',
            'kategori_galeri_id' => 'required|exists:kategori_galeri,id',
            'foto' => 'nullable',
        ]);

        if ($request->hasFile('foto')) {
            Storage::delete('public/galeri/' . $galeri->foto);
            $request->foto->store('public/galeri');
            $galeri->foto = $request->foto->hashName();
        }

        $galeri->judul = $request->judul;
        $galeri->tanggal_booking = $request->tanggal;
        $galeri->kategori_galeri_id = $request->kategori_galeri_id;

        $galeri->save();

        return redirect()->route('kelola-galeri.index')->with('success', 'galeri berhasil di update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $kelola_galeri)
    {
        Storage::delete('public/galeri/' . $kelola_galeri->foto);
        $kelola_galeri->delete();
        return redirect()->route('kelola-galeri.index')->with('success', 'galeri berhasil di hapus.');
    }
}
