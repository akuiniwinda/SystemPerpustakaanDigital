<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BukuPetugasController extends Controller
{
    //tampilkan semua data
    public function index(){
        $Books = Book::all();
        return view('page.petugas.buku.index', compact('Books'));
    }
}
