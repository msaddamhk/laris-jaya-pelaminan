<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RekeningBank;
use Illuminate\Http\Request;

class RekeningBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rekening = RekeningBank::where('nama_bank', 'like', '%' . request('cari') . '%')->paginate(15);
        return view('admin.rekening_bank.index', compact('rekening'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rekening_bank.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required|string|max:255',
            'no_rekening' => 'required|string|max:255',
            'atas_nama' => 'required|string|max:255',
        ]);

        RekeningBank::create($request->all());
        return redirect()->route('rekening.index')->with('success', 'Data Berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RekeningBank $rekening)
    {
        return view('admin.rekening_bank.edit', compact('rekening'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RekeningBank $rekening)
    {
        $request->validate([
            'nama_bank' => 'required|string|max:255',
            'no_rekening' => 'required|string|max:255',
            'atas_nama' => 'required|string|max:255',
        ]);

        $rekening->update($request->all());
        return redirect()->route('rekening.index')->with('success', 'Data Berhasi di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RekeningBank $rekening)
    {
        $rekening->delete();
        return redirect()->route('rekening.index')->with('success', 'Data Berhasil di Hapus');
    }
}
