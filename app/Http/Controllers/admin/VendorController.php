<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::where('nama', 'like', '%' . request('cari') . '%')->paginate(15);
        return view('admin.vendor.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:vendor',
            'no_hp' => 'required|string|max:255',
            'email' => 'required|email',
            'alamat' => 'required|string',
        ]);

        Vendor::create($request->all());
        return redirect()->route('vendor.index')->with('success', 'Vendor Berhasil ditambahkan.');
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
    public function edit(Vendor $vendor)
    {
        return view('admin.vendor.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:vendor,nama,' . $vendor->id,
            'no_hp' => 'required|string|max:255',
            'email' => 'required|email',
            'alamat' => 'required|string',
        ]);

        $vendor->update($request->all());
        return redirect()->route('vendor.index')->with('success', 'Vendor berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendor.index')->with('success', 'Vendor berhasil dihapus.');
    }
}
