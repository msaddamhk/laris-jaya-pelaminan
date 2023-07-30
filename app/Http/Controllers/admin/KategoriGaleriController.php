<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\kategoriGaleri;
use Illuminate\Http\Request;

class KategoriGaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori_galeri = kategoriGaleri::where('nama', 'like', '%' . request('cari') . '%')->paginate(15);
        return view('admin.kategori_galeri.index', compact('kategori_galeri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori_galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_galeri',
        ]);

        kategoriGaleri::create($request->all());

        return redirect()->route('kategori-galeri.index')->with('success', 'Data Berhasi di Tambah');
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
    public function edit(KategoriGaleri $kategori_galeri)
    {
        return view('admin.kategori_galeri.edit', compact('kategori_galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriGaleri $kategori_galeri)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_galeri,nama,' . $kategori_galeri->id,
        ]);

        $kategori_galeri->update($request->all());

        return redirect()->route('kategori-galeri.index')
            ->with('success', 'Data Berhasi di Update');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(KategoriGaleri $kategori_galeri)
    {
        $kategori_galeri->delete();

        return redirect()->route('kategori-galeri.index')
            ->with('success', 'Data Berhasi di Hapus');
    }
}
