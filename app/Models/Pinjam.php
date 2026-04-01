<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $guarded = [];

    //relasi ke anggota
    public function anggota(){
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function buku(){
        return $this->belongsTo(Book::class, 'book_id');
    }
}
