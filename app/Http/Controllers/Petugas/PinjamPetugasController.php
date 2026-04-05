<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Pinjam;
use Illuminate\Http\Request;

class PinjamPetugasController extends Controller
{
    //tampilkan semua data
    public function index(){
        $Pinjambuku = Pinjam::with(['anggota','buku'])->get();
        return view('page.petugas.pinjam.index', compact('Pinjambuku'));
    }

    public function show($id){
        //cari ke tabel kelas di database sesuai atau berdasarkan id kelas ada atau tidak
        $datapinjam = Pinjam::find($id);
        $databuku = Book::findOrFail($datapinjam->book_id);

        //cek apakah datanya ada atau tidak
        if($datapinjam == null){
            return redirect()->route('pinjam.index');
        }

        //kembalikan kelas ke halaman show dan kembalikan data buku yang di ambil

        return view('page.petugas.pinjam.show', compact('datapinjam', 'databuku'));
    }

    public function konfirmasi(Request $request, $id){
        $pinjam = Pinjam::findOrFail($id);

        if ($request->aksi == 'konfirmasi') {

            $pinjam->update([
                'status' => 'meminjam'
            ]);

            Book::where('id', $pinjam->book_id)
                ->update(['status' => 'dipinjam']);

            return redirect()->route('petugas.pinjam.index')
                ->with('success', 'Pinjaman dikonfirmasi!');

        } elseif ($request->aksi == 'tolak') {

            $pinjam->update(['status' => 'ditolak']);

            return redirect()->route('petugas.pinjam.index')
                ->with('error', 'Pinjaman ditolak!');
        }
    }
}
