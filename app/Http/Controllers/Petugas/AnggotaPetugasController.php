<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AnggotaPetugasController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');

        $anggotas = Anggota::when($search, function ($query, $search) {
                return $query->where('nama', 'like', '%' . $search . '%')
                            ->orWhere('alamat', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(5);
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

    public function show($id){
        //cari ke tabel kelas di database sesuai atau berdasarkan id kelas ada atau tidak
        $dataanggota = Anggota::find($id);

        //cek apakah datanya ada atau tidak
        if($dataanggota == null){
            return redirect()->route('petugas.anggota.index');
        }

        //kembalikan kelas ke halaman show dan kembalikan data user yang di ambil

        return view('page.petugas.anggota.show', compact('dataanggota'));
    }

    public function destroy($id){
        $hpusdataAnggota = Anggota::find($id);

        if ($hpusdataAnggota != null){
            if ($hpusdataAnggota->foto) {
                Storage::disk('public')->delete($hpusdataAnggota->foto);
            }

            $hpusdataAnggota->delete();
        }

        return redirect()->route('petugas.anggota.index')->with('success', 'Data berhasil dihapus');
    }

    public function edit($id){
        $Anggotas = Anggota::findOrFail($id);

        // Kirim data ke view
        return view('page.anggota.anggota.edit', compact('Anggotas'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'nama'           => 'required|string|max:255',
            'email'          => 'required|email|unique:anggotas,email,' . $id,
            'nomor_induk'    => 'required|string|max:50|unique:anggotas,nomor_induk,' . $id,
            'no_telp'        => 'required|string|max:20',
            'jenis_kelamin'  => 'required|in:laki-laki,perempuan',
            'alamat'         => 'required|string',
            'password'       => 'nullable|string|min:4',
        ]);

        //cari apakah ada user di tabel yang akan di update cari berdasarkan id
        $dataanggota = Anggota::find($id);

        $dataAnggota_update = [
            'nama'           => $request->nama,
            'email'          => $request->email,
            'nomor_induk'    => $request->nomor_induk,
            'no_telp'        => $request->no_telp,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'alamat'         => $request->alamat,
        ];


        //password hanya diupdate kalau diisi
        if ($request->password) {
            $dataAnggota_update['password'] = Hash::make($request->password);
        }

        //foto hanya diupdate kalau diisi
        if ($request->hasFile('foto')){
            //hapus file gambar sebelumnya
            Storage::disk('public')->delete($dataanggota->foto);

            //upload gambar
            $dataAnggota_update['foto'] = $request->file('foto')->store('imgpetugas', 'public');
        }

        //simpan data ke dalam base dengan data yang terbaru sesuai update
        $dataanggota->update($dataAnggota_update);

        //simpan data ke halaman beranda
        return redirect()->route('anggota.dashboard.index');
    }
}
