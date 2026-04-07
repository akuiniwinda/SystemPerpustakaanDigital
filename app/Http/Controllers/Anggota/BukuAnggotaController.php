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
        //cari ke tabel kelas di database sesuai atau berdasarkan id kelas ada atau tidak
        $buku = Book::find($id);

        //cek apakah datanya ada atau tidak
        return redirect()->route('anggota.buku.index');

        //kembalikan kelas ke halaman show dan kembalikan data user yang di ambil

        return view('page.anggota.buku.show', compact('buku'));
    }
}
