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

        //cek user yang login
        if (!$user) {
            return redirect()->route('login')->with('error', 'Harus login dulu!');
        }

        //cek buku sudah dipinjam atau belum
        $cek = Pinjam::where('book_id', $book_id)
                    ->where('status', '!=', 'selesai')
                    ->first();

        if ($cek) {
            return back()->with('error', 'Buku sedang dipinjam!');
        }

        //tanggal biar otomatis saat pinjam
        $tanggal_pinjam = Carbon::now();
        $tanggal_pengembalian = Carbon::now()->addDays(1);

        //simpat pinjaman ke table pinjam
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

        $today = \Carbon\Carbon::now();
        $batas = \Carbon\Carbon::parse($pinjam->tanggal_pengembalian);

        $denda = 0;

        // cek telat
        if ($today->gt($batas)) {
            $hari_telat = $today->diffInDays($batas);
            $denda = $hari_telat * 5000;
        }

        // update pinjam
        $pinjam->update([
            'status' => 'selesai',
            'tanggal_kembali' => $today,
            'denda' => $denda
        ]);

        // update buku
        \App\Models\Book::where('id', $pinjam->book_id)
            ->update(['status' => 'tersedia']);

        return back()->with('success', 'Buku dikembalikan. Denda: Rp ' . $denda);
    }

}
