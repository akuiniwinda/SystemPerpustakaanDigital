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

    public function store($book_id){
        $user = session('user');

        // CEK LOGIN
        if (!$user) {
            return redirect()->route('login')->with('error', 'Harus login dulu!');
        }

        // CEK BUKU SUDAH DIPINJAM
        $cek = Pinjam::where('book_id', $book_id)
                    ->where('status', '!=', 'selesai')
                    ->first();

        if ($cek) {
            return back()->with('error', 'Buku sedang dipinjam!');
        }

        // TANGGAL OTOMATIS
        $tanggal_pinjam = Carbon::now();
        $tanggal_pengembalian = Carbon::now()->addDays(30);

        // SIMPAN
        Pinjam::create([
            'anggota_id' => $user->id,
            'book_id' => $book_id,
            'tanggal_pinjam' => $tanggal_pinjam,
            'tanggal_pengembalian' => $tanggal_pengembalian,
            'status' => 'pengajuan'
        ]);

        // UPDATE STATUS BUKU
        Book::where('id', $book_id)->update([
            'status' => 'dipinjam'
        ]);

        return redirect()->route('anggota.buku.index')
            ->with('success', 'Buku berhasil dipinjam!');
    }

    public function kembalikan($id){
        $pinjam = Pinjam::findOrFail($id);

        // ubah status pinjam
        $pinjam->update([
            'status' => 'selesai'
        ]);

        // ubah status buku jadi tersedia lagi
        \App\Models\Book::where('id', $pinjam->book_id)
            ->update(['status' => 'tersedia']);

        return back()->with('success', 'Buku berhasil dikembalikan!');
    }

}
