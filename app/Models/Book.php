<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    //nama table
    protected $table = 'books';
    //fillable
    protected $guarded = [];

    protected static function boot(){
        parent::boot();

        static::saving(function ($book) {
            if ($book->stock == 0) {
                $book->status = 'habis';
            } else {
                $book->status = 'tersedia';
            }
        });
    }
}
