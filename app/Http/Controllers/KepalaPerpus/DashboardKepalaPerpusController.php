<?php

namespace App\Http\Controllers\KepalaPerpus;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Petugas;
use App\Models\Pinjam;

class DashboardKepalaPerpusController extends Controller
{
    public function index(){
        $totalBuku = Book::count();
        $totalPetugas = Petugas::count();
        $totalPeminjaman = Pinjam::count();
        return view('page.kepalaperpus.dashboard.index', compact('totalBuku','totalPetugas','totalPeminjaman'));
    }
}
