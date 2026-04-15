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
    public function index(Request $request){
        $search = $request->input('search');

        $Petugases = Petugas::when($search, function ($query, $search) {
                return $query->where('nama', 'like', '%' . $search . '%')
                            ->orWhere('alamat', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(5);
        return view('page.kepalaperpus.petugas.index', compact('Petugases'));
    }

    public function trash(Request $request){
        $search = $request->input('search');

        $Petugases = Petugas::onlyTrashed() // Hanya yang sudah di soft delete
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', '%' . $search . '%')
                            ->orWhere('alamat', 'like', '%' . $search . '%');
            })
            ->orderBy('deleted_at', 'desc')
            ->paginate(5);

        return view('page.kepalaperpus.petugas.trash', compact('Petugases'));
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
        //cari data petugas yang blm terhapus
        $hapusdatapetugas = Petugas::find($id);

        //cek apakah data ditemukan
        if (!$hapusdatapetugas) {
            return redirect()->route('petugas.index')->with('error', 'Data petugas tidak ditemukan');
        }

        //Lakukan SOFT DELETE
        $hapusdatapetugas->delete();

        return redirect()->route('petugas.index')->with('success', 'Data petugas berhasil dihapus sementara');
    }

    public function restore($id){
        $petugas = Petugas::withTrashed()->findOrFail($id);
        $petugas->restore();

        return redirect()->route('petugas.trash')->with('success', 'Petugas berhasil dikembalikan');
    }

    public function forceDelete($id){
        $petugas = Petugas::withTrashed()->findOrFail($id);

        // Hapus foto jika ada
        if ($petugas->foto && Storage::disk('public')->exists($petugas->foto)) {
            Storage::disk('public')->delete($petugas->foto);
        }

        $petugas->forceDelete();

        return redirect()->route('petugas.trash')->with('success', 'Petugas dihapus permanen dari database');
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
        if ($request->hasFile('foto')){
            //hapus file gambar sebelumnya
            Storage::disk('public')->delete($datapetugas->foto);

            //upload gambar
            $datapetugas_update['foto'] = $request->file('foto')->store('imgpetugas', 'public');
        }

        //simpan data ke dalam base dengan data yang terbaru sesuai update
        $datapetugas->update($datapetugas_update);

        //simpan data ke halaman beranda
        return redirect()->route('petugas.index');
    }

}
