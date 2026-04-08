<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BukuAnggotaController extends Controller
{
    public function index(){
        // Ambil semua data buku
        $bukubuku = Book::all();

        // Kirim ke view
        return view('page.anggota.buku.index', compact('bukubuku'));
    }

    public function show($id){
        // Cari buku berdasarkan id
        $buku = Book::find($id);

        // Jika buku tidak ditemukan, redirect ke index dengan pesan error
        if (!$buku) {
            return redirect()->route('anggota.buku.index')->with('error', 'Buku tidak ditemukan.');
        }

        // Tampilkan halaman show
        return view('page.anggota.buku.show', compact('buku'));
    }
}
