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
}
