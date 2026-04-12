<?php

namespace App\Http\Controllers\KepalaPerpus;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    //tampilkan semua data
    public function index(Request $request){
        $search = $request->input('search');

        $Books = Book::when($search, function ($query, $search) {
                return $query->where('judul', 'like', '%' . $search . '%')
                            ->orWhere('penulis', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('page.kepalaperpus.buku.index', compact('Books'));
    }

    public function create(){
        return view('page.kepalaperpus.buku.create');
    }

    public function store(Request $request){
        $request->validate([
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'judul'          => 'required|string|max:255',
            'penulis'        => 'required|string|max:255',
            'tahun_terbit'   => 'required|digits:4|integer',
            'deskripsi'      => 'required|string',
            'stock'          => 'required|integer|min:0'
        ]);

        // tentukan status dari stock
        if ($request->stock == 0) {
            $status = 'habis';
        } else {
            $status = 'tersedia';
        }

        $databuku_store = [
            'judul'          => $request->judul,
            'penulis'        => $request->penulis,
            'tahun_terbit'   => $request->tahun_terbit,
            'deskripsi'      => $request->deskripsi,
            'stock'          => $request->stock,
            'status'         => $status, // ✅ pakai hasil logic
        ];

        // upload foto
        if ($request->hasFile('foto')) {
            $databuku_store['foto'] = $request->file('foto')->store('imgbuku', 'public');
        }

        Book::create($databuku_store);

        return redirect()->route('books.index')->with('success', 'Data buku berhasil ditambahkan');
    }

    public function destroy($id){
        $databuku = Book::find($id);

        if ($databuku != null){
            Storage::disk('public')->delete($databuku->foto);
            $databuku->delete();
        }

        return redirect()->route('books.index')->with('success', 'Data buku berhasil dihapuskan');
    }

    public function show($id){
        //cari ke tabel kelas di database sesuai atau berdasarkan id kelas ada atau tidak
        $databuku = Book::find($id);

        //cek apakah datanya ada atau tidak
        if($databuku == null){
            return redirect()->route('books.index');
        }

        //kembalikan kelas ke halaman show dan kembalikan data buku yang di ambil

        return view('page.kepalaperpus.buku.show', compact('databuku'));
    }

    public function edit($id){
        $book = Book::findOrFail($id);

        return view('page.kepalaperpus.buku.edit', compact('book'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'judul'          => 'required|string|max:255',
            'penulis'        => 'required|string|max:255',
            'tahun_terbit'   => 'required|digits:4|integer',
            'deskripsi'      => 'required|string',
            'stock'          => 'required|integer|min:0'
        ]);

        $databuku = Book::findOrFail($id);

        $databuku_update = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tahun_terbit' => $request->tahun_terbit,
            'deskripsi' => $request->deskripsi,
            'stock' => $request->stock
        ];

        if ($request->filled('stock')) {

            $databuku_update['stock'] = $request->stock;

            if ($request->stock == 0) {
                $databuku_update['status'] = 'habis';
            } else {
                $databuku_update['status'] = 'tersedia';
            }
        }

        //foto hanya diupdate kalau diisi
        if ($request->hasFile('foto')){
            //hapus file gambar sebelumnya
            Storage::disk('public')->delete($databuku->foto);

            //upload gambar
            $databuku_update['foto'] = $request->file('foto')->store('imgbuku', 'public');
        }

        //simpan data ke dalam base dengan data yang terbaru sesuai update
        $databuku->update($databuku_update);

        //simpan data ke halaman beranda
         return redirect()->route('books.index')->with('success', 'Data buku berhasil diedit');
    }

}
