<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\Jasa;
use App\Models\Pemesanan;
use App\Models\Slider;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $jasa = Jasa::paginate(4);
        $galeri = Galeri::paginate(8);
        $slider = Slider::paginate(8);
        return view('home.index', compact('jasa', 'galeri', 'slider'));
    }
}
