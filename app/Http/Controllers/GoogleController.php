<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleController extends Controller
{
    public function index()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
            $existingUser = User::where('google_id', $user->getId())->first();

            if ($existingUser) {
                Auth::login($existingUser);
                return redirect('/');
            } else {
                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                $newUser->password = bcrypt('123456789');
                $newUser->save();

                Auth::login($newUser);
                return redirect('/');
            }
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat melakukan autentikasi Google. Silakan coba lagi.');
        }
    }
}
