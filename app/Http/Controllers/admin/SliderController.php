<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slider = Slider::all();
        return view('admin.slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',

        ]);

        $request->foto?->store('public/slider');

        Slider::create([
            'foto' => $request->foto ? $request->foto->hashName() : null,
        ]);

        return redirect()->route('slider.index')->with('success', 'slider berhasil di tambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'foto' => 'nullable',
        ]);

        if ($request->hasFile('foto')) {
            Storage::delete('public/slider/' . $slider->foto);
            $request->foto->store('public/slider');
            $slider->foto = $request->foto->hashName();
        }

        $slider->save();

        return redirect()->route('slider.index')->with('success', 'slider berhasil di update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        Storage::delete('public/slider/' . $slider->foto);
        $slider->delete();
        return redirect()->route('slider.index')->with('success', 'slider berhasil di hapus.');
    }
}
