<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pinjam;

class PinjamPetugasController extends Controller
{
    //tampilkan semua data
    public function index(){
        $Pinjambuku = Pinjam::with(['anggota','buku'])->get();
        return view('page.petugas.pinjam.index', compact('Pinjambuku'));
    }
}
