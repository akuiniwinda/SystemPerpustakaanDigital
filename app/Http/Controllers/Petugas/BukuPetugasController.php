<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BukuPetugasController extends Controller
{
    //tampilkan semua data buku
    public function index(Request $request){
        $search = $request->input('search');

        $Books = Book::when($search, function ($query, $search) {
                return $query->where('judul', 'like', '%' . $search . '%')
                            ->orWhere('penulis', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('page.petugas.buku.index', compact('Books'));
    }
}
