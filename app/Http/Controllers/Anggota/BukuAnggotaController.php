<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BukuAnggotaController extends Controller
{
    public function index(){

        // Ambil data About yang aktif
        $activeBuku = Book::where('is_active', 'active')->get();

        // Kirim ke view
        return view('page.anggota.buku.index', compact('activeBuku',));
    }
}
