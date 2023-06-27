<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use Illuminate\Http\Request;

class JasaController extends Controller
{
    public function index()
    {
        $jasa = Jasa::where('nama', 'like', '%' . request('cari') . '%')->paginate(12);
        return view('home.jasa', compact('jasa'));
    }
}
