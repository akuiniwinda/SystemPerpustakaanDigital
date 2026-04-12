<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatAnggotaController extends Controller
{
    public function index(Request $request){
        $user = session('user');
        $search = $request->input('search');

        $pinjams = \App\Models\Pinjam::with('buku')
                ->where('anggota_id', $user->id)
                ->where('status', '!=', 'konfirmasi') // sudah disetujui / dipinjam
                ->when($search, function ($query, $search) {
                    $query->whereHas('buku', function ($q) use ($search) {
                        $q->where('judul', 'LIKE', "%{$search}%")
                        ->orWhere('penulis', 'LIKE', "%{$search}%");

                    });
                })
                ->get();


        return view('page.anggota.riwayat.index',compact('pinjams'));
    }
}
