<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '';

    public function authenticated()
    {
        if (auth()->user()->level == "ADMIN") {
            return redirect()->route('kategori.index');
        }
        return redirect()->intended('/');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        if (auth()->check() && auth()->user()->level == "ADMIN") {
            return redirect()->route('kategori.index');
        } else {
            return redirect()->intended('/');
        }
    }

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
}
