<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //CEK KE ANGGOTA
        $anggota = Anggota::where('email', $request->email)->first();

        if ($anggota && Hash::check($request->password, $anggota->password)) {
            Session::put('login', true);
            Session::put('role', 'anggota');
            Session::put('user', $anggota);

            return redirect()->route('anggota.dashboard.index');
        }

        //CEK KE PETUGAS
        $petugas = Petugas::where('email', $request->email)->first();

        if ($petugas && Hash::check($request->password, $petugas->password)) {
            Session::put('login', true);
            Session::put('role', 'petugas');
            Session::put('user', $petugas);

            return redirect('/petugas/dashboard');
        }

        // CEK KE KEPALA PERPUS (Seeder)
        $kepalaperpus = User::where('email', $request->email)->first();
        if ($kepalaperpus && Hash::check($request->password, $kepalaperpus->password)) {
            Session::put('login', true);
            Session::put('role', $kepalaperpus->role);
            Session::put('user', $kepalaperpus);
            return redirect('/kepalaperpus/dashboard'); // ganti sesuai route kepala
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function logout(){
        Session::flush();
        return redirect('/login');
    }
}
