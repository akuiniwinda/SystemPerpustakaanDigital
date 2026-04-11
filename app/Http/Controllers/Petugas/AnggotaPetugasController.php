<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaPetugasController extends Controller
{
    public function index(){
        $anggotas = Anggota::paginate(5);
        return view('page.petugas.anggota.index', compact('anggotas'));
    }

    public function create(){
    return view('page.auth.register');
    }

    public function store(Request $request){
        $request->validate([
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'nama'           => 'required|string|max:255',
            'email'          => 'required|email|unique:anggotas,email',
            'nomor_induk'    => 'required|string|max:50|unique:anggotas,nomor_induk',
            'no_telp'        => 'required|string|max:20',
            'jenis_kelamin'  => 'required|in:laki-laki,perempuan',
            'alamat'         => 'required|string',
            'password'       => 'required|string|min:4',
        ]);

        $dataanggota_store = [
            'nama'           => $request->nama,
            'email'          => $request->email,
            'nomor_induk'    => $request->nomor_induk,
            'no_telp'        => $request->no_telp,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'alamat'         => $request->alamat,
            'password'       => Hash::make($request->password)
        ];

        // upload foto
        if ($request->hasFile('foto')) {
            $dataanggota_store['foto'] = $request->file('foto')->store('imganggota', 'public');
        }

        Anggota::create($dataanggota_store);


        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login!');
    }
}
