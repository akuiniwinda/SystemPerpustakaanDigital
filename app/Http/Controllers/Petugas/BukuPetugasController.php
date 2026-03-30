<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BukuPetugasController extends Controller
{
    //tampilkan semua data
    public function index(){
        $Books = Book::all();
        return view('page.petugas.buku.index', compact('Books'));
    }
}
