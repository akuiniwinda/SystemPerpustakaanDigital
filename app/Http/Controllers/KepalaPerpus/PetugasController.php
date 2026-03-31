<?php

namespace App\Http\Controllers\KepalaPerpus;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class PetugasController extends Controller
{
    //tampilkan semua data
    public function index(){
        $Petugases = Petugas::all();
        return view('page.kepalaperpus.petugas.index', compact('Petugases'));
    }

    public function create(){
        return view('page.kepalaperpus.petugas.create');
    }

    public function store(Request $request){
        $request->validate([
            'foto'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|unique:petugases,email',
            'nip'    => 'required|string|max:50|unique:petugases,nip',
            'alamat' => 'required|string',
            'password'    => 'required|string|min:4',
        ]);

        $datapetugas_store = [
        'nama'   => $request->nama,
        'email'  => $request->email,
        'nip'    => $request->nip,
        'alamat' => $request->alamat,
        'password' => Hash::make($request->password)
        ];

        // upload foto
        if ($request->hasFile('foto')) {
            $datapetugas_store['foto'] = $request->file('foto')->store('imgpetugas', 'public');
        }

        Petugas::create($datapetugas_store);

        return redirect()->route('petugas.index')->with('success', 'Data petugas berhasil ditambahkan');
    }

    public function destroy(){
        $datapetugas = Petugas::find();

        if ($datapetugas != null){
            Storage::disk('public')->delete($datapetugas->photo_profile);
            $datapetugas->delete();
        }

        return redirect()->route('petugas.index');
    }

    public function show($id){
        //cari ke tabel kelas di database sesuai atau berdasarkan id kelas ada atau tidak
        $datapetugas = Petugas::find($id);

        //cek apakah datanya ada atau tidak
        if($datapetugas == null){
            return redirect()->route('petugas.index');
        }

        //kembalikan kelas ke halaman show dan kembalikan data user yang di ambil

        return view('page.kepalaperpus.petugas.show', compact('datapetugas'));
    }

}
