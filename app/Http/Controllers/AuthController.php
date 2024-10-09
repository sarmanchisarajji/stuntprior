<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public  function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        // periksa apakah username dan password required (diisi)
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);

        // mengecek tipe user yang sedang login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();


            if (auth()->user()->user_type === "dinkes") {
                toast('Berhasil Login', 'success');
                // Alert::success('Berhasil Login!', session('success'));
                return redirect('/admin/dashboard');
            }
        }
        return back()->with('loginError', 'Username atau Password salah!')->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        toast('Berhasil Logout', 'success');
        // Alert::success('Berhasil Logout!', session('success'));
        return redirect('/guest/dashboard');
    }
}
