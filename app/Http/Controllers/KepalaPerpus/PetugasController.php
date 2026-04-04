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

    public function destroy($id){
        $hpusdatapetugas = Petugas::find($id);

        if ($hpusdatapetugas != null){
            if ($hpusdatapetugas->foto) {
                Storage::disk('public')->delete($hpusdatapetugas->foto);
            }

            $hpusdatapetugas->delete();
        }

        return redirect()->route('petugas.index')->with('success', 'Data berhasil dihapus');
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

        public function edit($id){
        //siapkan data
        $petugas = Petugas::all();

        //amabil data petugas di tabel petugas berdasar kan id
        $Petugases = Petugas::find($id);

        //cek apakah datanya ada atau tidak
        if($Petugases == null){
            return redirect()->route('petugas.index');
        }

        return view('page.kepalaperpus.petugas.edit', compact('petugas', 'Petugases'));

    }

    public function update(Request $request, $id){
        //validasi data
        $request->validate([
            'foto'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|unique:petugases,email,' . $id,
            'nip'    => 'required|string|max:50|unique:petugases,nip,' . $id,
            'alamat' => 'required|string',
            'password' => 'nullable|string|min:4',
        ]);

        //cari apakah ada user di tabel yang akan di update cari berdasarkan id
        $datapetugas = Petugas::find($id);

        //siapkan data yang akan disiampan sebagai update
        $datapetugas_update = [
            'nama'   => $request->nama,
            'email'  => $request->email,
            'nip'    => $request->nip,
            'alamat' => $request->alamat,
        ];

        //password hanya diupdate kalau diisi
        if ($request->password) {
            $datapetugas_update['password'] = Hash::make($request->password);
        }

        //foto hanya diupdate kalau diisi
        if ($request->hasFile('photo')){
            //hapus file gambar sebelumnya
            Storage::disk('public')->delete($datapetugas->photo);

            //upload gambar
            $datapetugas_update['photo'] = $request->file('photo')->store('imgpetugas', 'public');
        }

        //simpan data ke dalam base dengan data yang terbaru sesuai update
        $datapetugas->update($datapetugas_update);

        //simpan data ke halaman beranda
        return redirect()->route('petugas.index');
    }

}
