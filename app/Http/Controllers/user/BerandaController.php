<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\Jasa;
use App\Models\Slider;

class BerandaController extends Controller
{
    public function index()
    {
        $jasa = Jasa::latest()->paginate(4);
        $galeri = Galeri::latest()->paginate(8);
        $slider = Slider::latest()->paginate(8);
        return view('home.index', compact('jasa', 'galeri', 'slider'));
    }
}
