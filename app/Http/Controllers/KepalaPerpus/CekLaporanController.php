<?php

namespace App\Http\Controllers\KepalaPerpus;

use App\Http\Controllers\Controller;
use App\Models\Laporan;

class CekLaporanController extends Controller
{
    public function index(){
        $laporans = Laporan::with('petugas')->latest()->get();

        return view('page.kepalaperpus.laporan.index', compact('laporans'));
    }

    public function lihat($id){
        Laporan::where('id', $id)->update([
            'status' => 'sudah_dilihat'
        ]);

        return back()->with('success', 'Laporan sudah dilihat');
    }
}
