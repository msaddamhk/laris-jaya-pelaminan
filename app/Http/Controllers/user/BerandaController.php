<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $jasa = Jasa::paginate(4);
        return view('home.index', compact('jasa'));
    }
}
