<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Pinjam;
use Carbon\Carbon;

class DashboardController extends Controller
{
        public function index()
    {
        // Ambil data anggota dari session (pastikan session 'user' berisi objek/user model)
        $user = session('user');

        // Jika session tidak ada, redirect ke login (atau handle sesuai kebutuhan)
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 1. Total pernah pinjam (semua status, termasuk selesai, meminjam, pengajuan)
        $totalPernahPinjam = Pinjam::where('anggota_id', $user->id)->count();

        // 2. Buku belum dikembalikan (status = 'meminjam')
        $belumDikembalikan = Pinjam::where('anggota_id', $user->id)
                                   ->where('status', 'meminjam')
                                   ->count();

        // 3. Besar denda (total denda final + denda dari pengajuan pengembalian yang masih pending)
        // Asumsi: kolom 'denda' untuk denda final yang sudah ditetapkan,
        // dan 'denda_pengajuan' untuk denda sementara saat anggota mengajukan pengembalian terlambat.
        $totalDendaFinal = Pinjam::where('anggota_id', $user->id)->sum('denda');
        $totalDendaPengajuan = Pinjam::where('anggota_id', $user->id)
                                     ->where('pengajuan_pengembalian', true)
                                     ->sum('denda_pengajuan');
        $besarDenda = $totalDendaFinal + $totalDendaPengajuan;

        // Kirim data ke view
        return view('page.anggota.dashboard.index', compact(
            'totalPernahPinjam',
            'belumDikembalikan',
            'besarDenda'
        ));
    }
}
