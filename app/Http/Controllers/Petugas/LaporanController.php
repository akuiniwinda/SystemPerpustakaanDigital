<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Pinjam;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(){
        $pinjams = Pinjam::with(['anggota','buku'])->where('status','selesai')->get();

        return view('page.petugas.laporan.index', compact('pinjams'));
    }

    public function download(){
        $pinjams = Pinjam::with(['anggota','buku'])->get();

        $pdf = Pdf::loadView('page.petugas.laporan.pdf', compact('pinjams'));

        return $pdf->download('laporan.pdf');
    }

        public function upload(Request $request){
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048'
        ]);

        $file = $request->file('file')->store('laporan', 'public');

        Laporan::create([
            'file' => $file,
            'petugas_id' => session('user')->id,
            'status' => 'belum_dilihat'
        ]);

        return back()->with('success','Laporan berhasil diupload');
    }
}
