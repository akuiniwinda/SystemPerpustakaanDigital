<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pinjam extends Model
{
    protected $guarded = [];

    // CASTING - PASTIKAN TIPE DATA BENAR
    protected $casts = [
        'denda' => 'integer',
        'tanggal_pinjam' => 'date',
        'tanggal_pengembalian' => 'date',
        'tanggal_kembali' => 'date',
    ];

    //relasi ke anggota
    public function anggota(){
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function buku(){
        return $this->belongsTo(Book::class, 'book_id');
    }

    // METHOD HITUNG DENDA (PASTIKAN POSITIF DAN BULAT)
    public function hitungDenda($tanggal_kembali_real, $kondisi_buku)
    {
        $rencana_kembali = Carbon::parse($this->tanggal_pengembalian)->startOfDay();
        $kembali = Carbon::parse($tanggal_kembali_real)->startOfDay();

        $denda = 0;

        // HITUNG TELAT (hanya jika lebih dari rencana)
        if ($kembali->gt($rencana_kembali)) {
            $hari_telat = $rencana_kembali->diffInDays($kembali);
            $denda = $hari_telat * 5000;
        }

        // DENDA KONDISI BUKU
        if ($kondisi_buku == 'rusak') {
            $denda += 30000;
        } elseif ($kondisi_buku == 'hilang') {
            $denda = 55000;
        }

        // PASTIKAN TIDAK MINUS DAN INTEGER
        return max(0, (int)$denda);
    }
}
