<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Petugas extends Model
{
    use SoftDeletes;
    //nama table
    protected $table = 'petugases';
    //fillable
    protected $guarded = [];
}
