<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use Illuminate\Http\Request;

class DetailJasaController extends Controller
{
    public function index(Jasa $jasa)
    {
        return view('home.detail', compact('jasa'));
    }
}
