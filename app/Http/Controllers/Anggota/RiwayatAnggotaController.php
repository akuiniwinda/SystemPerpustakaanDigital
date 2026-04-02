<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;

class RiwayatAnggotaController extends Controller
{
    public function index(){
        $user = session('user');

        $pinjams = \App\Models\Pinjam::with('buku')
                ->where('anggota_id', $user->id)
                ->where('status', '!=', 'konfirmasi') // sudah disetujui / dipinjam
                ->get();


        return view('page.anggota.riwayat.index',compact('pinjams'));
    }
}
