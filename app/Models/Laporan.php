<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $guarded = [];

    public function petugas(){
        return $this->belongsTo(Petugas::class);
    }
}
