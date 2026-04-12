<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BukuAnggotaController extends Controller
{
    public function index(Request $request){
        // Ambil semua data buku
        $search = $request->input('search');

        $bukubuku = Book::query()
            ->when($search, function ($query, $search) {
                return $query->where('judul', 'LIKE', "%{$search}%")
                            ->orWhere('penulis', 'LIKE', "%{$search}%");
            })
            ->get();

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
