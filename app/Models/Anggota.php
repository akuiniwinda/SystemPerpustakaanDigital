<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    //nama table
    protected $fillable = [
    'nama',
    'email',
    'nomor_induk',
    'no_telp',
    'jenis_kelamin',
    'alamat',
    'password',
    'foto'
    ];
}
