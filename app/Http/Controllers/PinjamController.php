<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Pinjam;
use Carbon\Carbon;


class PinjamController extends Controller
{
    public function create($id){
        $buku = Book::findOrFail($id);
        return view('page.anggota.pinjam.create', compact('buku'));
    }

    // Anggota mengajukan peminjaman
    public function store($book_id) {
        $user = session('user');
        $buku = Book::findOrFail($book_id);

        if ($buku->stock <= 0) {
            return back()->with('error', 'Stok habis.');
        }

        // Cek apakah sudah pernah pinjam dan belum selesai
        $exists = Pinjam::where('anggota_id', $user->id)
                    ->where('book_id', $book_id)
                    ->whereNotIn('status', ['selesai'])
                    ->exists();
        if ($exists) {
            return back()->with('error', 'Anda sudah meminjam buku ini.');
        }

        //mkasimal 3 buku yg dipinjam
        $activeBorrowCount = Pinjam::where('anggota_id', $user->id)
                        ->where('status', 'meminjam')
                        ->count();
        if ($activeBorrowCount >= 3) {
            return back()->with('error', 'Anda sudah meminjam 3 buku. Selesaikan pengembalian terlebih dahulu.');
        }

        Pinjam::create([
            'anggota_id' => $user->id,
            'book_id' => $book_id,
            'tanggal_pinjam' => now(),
            'tanggal_pengembalian' => now()->addDays(1),
            'status' => 'pengajuan',
            'pengajuan_pengembalian' => false,
        ]);

        return redirect()->route('anggota.buku.index')->with('success', 'Pengajuan peminjaman dikirim.');
    }

    // Anggota mengajukan pengembalian
    public function ajukanKembali($id) {
        $pinjam = Pinjam::findOrFail($id);
        if ($pinjam->status != 'meminjam') {
            return back()->with('error', 'Hanya bisa mengajukan untuk buku yang sedang dipinjam.');
        }
        if ($pinjam->pengajuan_pengembalian) {
            return back()->with('error', 'Pengajuan sudah ada, menunggu petugas.');
        }

        // Gunakan tanggal murni (tanpa jam)
        $today = \Carbon\Carbon::today(); // tanggal sekarang pukul 00:00:00
        $batas = \Carbon\Carbon::parse($pinjam->tanggal_pengembalian)->startOfDay();

        $denda = 0;
        if ($today->gt($batas)) {
            $hari_telat = $today->diffInDays($batas); // selisih hari positif
            $denda = max(0, $hari_telat * 5000);
        }

        if ($denda < 0) {
            $denda = 0;
        }

        $pinjam->update([
            'pengajuan_pengembalian' => true,
            'denda_pengajuan' => $denda,
        ]);

        return back()->with('success', 'Pengajuan pengembalian dikirim. Menunggu konfirmasi petugas.');
    }

    // Halaman daftar denda yang belum lunas
    public function daftarDenda()
    {
        $user = session('user');
        $dendas = Pinjam::with('buku')
                    ->where('anggota_id', $user->id)
                    ->where('status', 'selesai')
                    ->where('denda', '>', 0)
                    ->where('status_denda', '!=', 'lunas')
                    ->orderBy('created_at', 'desc')
                    ->get();

        // Total besar denda untuk card
        $besarDenda = $dendas->sum('denda');

        return view('page.anggota.denda.index', compact('dendas', 'besarDenda'));
    }

    // Mengajukan pelunasan denda (setelah bayar offline)
    public function ajukanDenda($id)
    {
        $pinjam = Pinjam::where('id', $id)
                    ->where('anggota_id', session('user')->id)
                    ->firstOrFail();

        if ($pinjam->status_denda != 'belum') {
            return back()->with('error', 'Denda sudah diajukan atau sudah lunas.');
        }

        $pinjam->update(['status_denda' => 'diajukan']);

        return back()->with('success', 'Pengajuan pelunasan denda dikirim. Petugas akan segera memproses.');
    }

}
