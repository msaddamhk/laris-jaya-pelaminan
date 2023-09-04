<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use App\Models\JasaFoto;
use App\Models\Kategori;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jasa = Jasa::where('nama', 'like', '%' . request('cari') . '%')->paginate(15);
        return view('admin.jasa.index', compact('jasa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendors = Vendor::all();
        $kategoris = Kategori::all();
        return view('admin.jasa.create', compact('vendors', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required|exists:vendor,id',
            'kategori_id' => 'required|exists:kategori,id',
            'nama' => 'required|string|max:255|unique:jasa',
            'deskripsi' => 'required',
            'modal' => 'required|integer',
            'harga' => 'required|integer',
            'tipe_unit' => 'required|string|max:255',
            'jumlah_minimal' => 'required|integer',
            'jumlah_maksimal' => 'required|integer',
            'jumlah_pesanan' => 'required|integer',
            'is_cod' => 'required|boolean',
            'banyak_hari' => 'required|boolean',
            'status_pengembalian' => 'required|boolean',
        ]);

        $jasa = Jasa::create($request->except('foto'));

        foreach ($request->file('foto') as $fotoFile) {
            if ($fotoFile) {
                $path = $fotoFile->store('public/jasa_foto');
                $jasaFoto = new JasaFoto();
                $jasaFoto->foto = $fotoFile->hashName();
                $jasaFoto->jasa_id = $jasa->id;
                $jasaFoto->save();
            }
        }

        return redirect()->route('jasa.index')->with('success', 'Jasa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jasa $jasa)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jasa $jasa)
    {
        $vendors = Vendor::all();
        $kategoris = Kategori::all();
        return view('admin.jasa.edit', compact('jasa', 'vendors', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jasa $jasa)
    {
        $request->validate([
            'vendor_id' => 'required|exists:vendor,id',
            'kategori_id' => 'required|exists:kategori,id',
            'nama' => 'required|string|max:255|unique:jasa,nama,' . $jasa->id,
            'deskripsi' => 'required',
            'modal' => 'required|integer',
            'harga' => 'required|integer',
            'tipe_unit' => 'required|string|max:255',
            'jumlah_minimal' => 'required|integer',
            'jumlah_maksimal' => 'required|integer',
            'jumlah_pesanan' => 'required|integer',
            // 'foto' => 'nullable|array',
            // 'foto.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_cod' => 'required|boolean',
            'banyak_hari' => 'required|boolean',
            'status_pengembalian' => 'required|boolean',
        ]);

        $jasa->update($request->except('foto'));

        // foreach ($jasa->jasaFoto as $foto) {
        //     Storage::delete('public/' . $foto->foto);
        //     $foto->delete();
        // }

        // if ($request->hasFile('foto')) {
        //     foreach ($request->file('foto') as $fotoFile) {
        //         $fotoPath = $fotoFile->store('jasa_foto', 'public');
        //         $jasaFoto = new JasaFoto();
        //         $jasaFoto->foto = $fotoPath;
        //         $jasaFoto->jasa_id = $jasa->id;
        //         $jasaFoto->save();
        //     }
        // }

        return redirect()->route('jasa.index')->with('success', 'Jasa berhasil di update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jasa $jasa)
    {
        foreach ($jasa->jasaFoto as $foto) {
            Storage::delete('public/jasa_foto/' . $foto->foto);
            $foto->delete();
        }
        $jasa->delete();

        return redirect()->route('jasa.index')->with('success', 'Jasa deleted successfully.');
    }
}
