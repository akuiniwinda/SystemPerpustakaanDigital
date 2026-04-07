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

        Pinjam::create([
            'anggota_id' => $user->id,
            'book_id' => $book_id,
            'tanggal_pinjam' => now(),
            'tanggal_pengembalian' => now()->addDays(30),
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

        $today = now();
        $batas = \Carbon\Carbon::parse($pinjam->tanggal_pengembalian);
        $denda = 0;
        if ($today->gt($batas)) {
            $hari_telat = $today->diffInDays($batas);
            $denda = $hari_telat * 5000;
        }

        $pinjam->update([
            'pengajuan_pengembalian' => true,
            'denda_pengajuan' => $denda,
        ]);

        return back()->with('success', 'Pengajuan pengembalian dikirim. Menunggu konfirmasi petugas.');
    }

}
