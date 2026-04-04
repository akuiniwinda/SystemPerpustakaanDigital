<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Book;
use App\Models\Pinjam;

class DashboardPetugasController extends Controller
{
    public function index(){
        $totalBuku = Book::count();
        $totalAnggota = Anggota::count();
        $totalPinjam = Pinjam::count();
        return view('page.petugas.dashboard.index', compact('totalBuku','totalAnggota', 'totalPinjam'));
    }
}
