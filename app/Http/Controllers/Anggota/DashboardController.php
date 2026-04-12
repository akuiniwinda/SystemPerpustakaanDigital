<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Pinjam;
use Carbon\Carbon;

class DashboardController extends Controller
{
        public function index(){
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $totalPernahPinjam = Pinjam::where('anggota_id', $user->id)->count();
        $belumDikembalikan = Pinjam::where('anggota_id', $user->id)
                                ->where('status', 'meminjam')
                                ->count();

        // Total denda yang masih harus dibayar (sudah final, belum lunas)
        $besarDenda = Pinjam::where('anggota_id', $user->id)
                            ->where('status', 'selesai')
                            ->where('denda', '>', 0)
                            ->where('status_denda', '!=', 'lunas')
                            ->sum('denda');

        return view('page.anggota.dashboard.index', compact(
            'totalPernahPinjam',
            'belumDikembalikan',
            'besarDenda'
        ));
    }
}
