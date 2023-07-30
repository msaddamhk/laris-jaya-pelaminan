<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\kategoriGaleri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = kategoriGaleri::pluck('nama', 'id');

        $selectedKategori = $request->input('kategori', 'all');

        $query = Galeri::query();

        if ($selectedKategori !== 'all') {
            $query->where('kategori_galeri_id', $selectedKategori);
        }

        $galeri = $query->paginate(12);

        return view('home.galeri', compact('galeri', 'kategoris', 'selectedKategori'));
    }
}
