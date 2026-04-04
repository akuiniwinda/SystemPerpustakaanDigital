<?php

namespace App\Http\Controllers\KepalaPerpus;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    //tampilkan semua data
    public function index(){
        $Books = Book::all();
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
            'is_active'      => 'required|in:active,nonactive',
            'status'         => 'required|in:tersedia,dipinjam'
        ]);

        $databuku_store = [
            'judul'          => $request->judul,
            'penulis'        => $request->penulis,
            'tahun_terbit'   => $request->tahun_terbit,
            'deskripsi'      => $request->deskripsi,
            'is_active'      => $request->is_active,
            'status'         => $request->status,
        ];

        //upload foto
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
            return redirect()->route('buku.index');
        }

        //kembalikan kelas ke halaman show dan kembalikan data buku yang di ambil

        return view('page.kepalaperpus.buku.show', compact('databuku'));
    }

    public function edit($id){
        //siapkan data
        $book = Book::all();

        //amabil data petugas di tabel petugas berdasar kan id
        $books = Book::find($id);

        //cek apakah datanya ada atau tidak
        if($books == null){
            return redirect()->route('buku.index');
        }

        return view('page.kepalaperpus.buku.edit', compact('book', 'books'));

    }

    public function update(Request $request, $id){
        //validasi data
        $request->validate([
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'judul'          => 'required|string|max:255',
            'penulis'        => 'required|string|max:255',
            'tahun_terbit'   => 'required|digits:4|integer',
            'deskripsi'      => 'required|string',
        ]);

        //cari apakah ada user di tabel yang akan di update cari berdasarkan id
        $databuku = Book::find($id);

        //siapkan data yang akan disiampan sebagai update
        $databuku_update = [
            'judul'          => $request->judul,
            'penulis'        => $request->penulis,
            'tahun_terbit'   => $request->tahun_terbit,
            'deskripsi'      => $request->deskripsi,
        ];


        //foto hanya diupdate kalau diisi
        if ($request->hasFile('photo')){
            //hapus file gambar sebelumnya
            Storage::disk('public')->delete($databuku->photo);

            //upload gambar
            $databuku_update['photo'] = $request->file('photo')->store('imgbuku', 'public');
        }

        //simpan data ke dalam base dengan data yang terbaru sesuai update
        $databuku->update($databuku_update);

        //simpan data ke halaman beranda
         return redirect()->route('books.index')->with('success', 'Data buku berhasil diedit');
    }
}
