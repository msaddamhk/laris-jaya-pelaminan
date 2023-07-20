<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use App\Models\Kategori;
use Illuminate\Http\Request;


class JasaController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::pluck('nama', 'id');

        $selectedKategori = $request->input('kategori', 'all');

        $selectedKeyword = $request->input('keyword', '');

        $query = Jasa::query();

        if ($selectedKategori !== 'all') {
            $query->where('kategori_id', $selectedKategori);
        }

        if ($selectedKeyword) {
            $query->where('nama', 'like', '%' . $selectedKeyword . '%');
        }

        $jasa = $query->paginate(12);

        return view('home.jasa', compact('jasa', 'kategoris', 'selectedKategori', 'selectedKeyword'));
    }
}
