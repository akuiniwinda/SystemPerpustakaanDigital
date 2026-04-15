<?php

namespace App\Http\Controllers\KepalaPerpus;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Pinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    //tampilkan semua data
    public function index(Request $request){
        $search = $request->input('search');

        $Books = Book::when($search, function ($query, $search) {
                return $query->where('judul', 'like', '%' . $search . '%')
                            ->orWhere('penulis', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('page.kepalaperpus.buku.index', compact('Books'));
    }

    // tampilan yang ada di soft delete
    public function trash(Request $request){
        $search = $request->input('search');

        $Books = Book::onlyTrashed() // hanya yang sudah di soft delete
            ->when($search, function ($query, $search) {
                return $query->where('judul', 'like', '%' . $search . '%')
                            ->orWhere('penulis', 'like', '%' . $search . '%');
            })
            ->orderBy('deleted_at', 'desc')
            ->paginate(5);

        return view('page.kepalaperpus.buku.trash', compact('Books'));
    }

    public function create(){
        return view('page.kepalaperpus.buku.create');
    }

    public function store(Request $request){
        $request->validate([
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'judul'          => 'required|string|max:255',
            'penulis'        => 'required|string|max:255',
            'tahun_terbit'   => 'required|digits:4|integer',
            'deskripsi'      => 'required|string',
            'stock'          => 'required|integer|min:0'
        ]);

        // tentukan status dari stock
        if ($request->stock == 0) {
            $status = 'habis';
        } else {
            $status = 'tersedia';
        }

        $databuku_store = [
            'judul'          => $request->judul,
            'penulis'        => $request->penulis,
            'tahun_terbit'   => $request->tahun_terbit,
            'deskripsi'      => $request->deskripsi,
            'stock'          => $request->stock,
            'status'         => $status,
        ];

        // upload foto
        if ($request->hasFile('foto')) {
            $databuku_store['foto'] = $request->file('foto')->store('imgbuku', 'public');
        }

        Book::create($databuku_store);

        return redirect()->route('books.index')->with('success', 'Data buku berhasil ditambahkan');
    }

    // menghapus sementara
    public function destroy($id){
        $databuku = Book::find($id);

        if ($databuku == null) {
            return redirect()->route('books.index')->with('error', 'Data buku tidak ditemukan');
        }

        // Cek apakah buku sedang dipinjam
        $sedangDipinjam = Pinjam::where('book_id', $id)
                            ->where('status', 'meminjam')
                            ->exists();

        if ($sedangDipinjam) {
            return redirect()->route('books.index')->with('error', 'Buku tidak dapat dihapus karena sedang dipinjam oleh anggota');
        }

        // SOFT DELETE (hanya mengisi deleted_at, FOTO TIDAK DIHAPUS)
        $databuku->delete();

        return redirect()->route('books.index')->with('success', 'Data buku berhasil dihapus sementara');
    }

    // mengembalikan buku yang ada di soft delete
    public function restore($id){
        $book = Book::withTrashed()->findOrFail($id);
        $book->restore();

        return redirect()->route('books.trash')->with('success', 'Buku berhasil dikembalikan');
    }

    // menghapus permanent
    public function forceDelete($id){
        $book = Book::withTrashed()->findOrFail($id);

        // Hapus foto jika ada
        if ($book->foto && Storage::disk('public')->exists($book->foto)) {
            Storage::disk('public')->delete($book->foto);
        }

        $book->forceDelete();

        return redirect()->route('books.trash')->with('success', 'Buku dihapus permanen dari database');
    }

    public function show($id){
        //cari ke tabel kelas di database sesuai atau berdasarkan id kelas ada atau tidak
        $databuku = Book::find($id);

        //cek apakah datanya ada atau tidak
        if($databuku == null){
            return redirect()->route('books.index');
        }

        //kembalikan kelas ke halaman show dan kembalikan data buku yang di ambil

        return view('page.kepalaperpus.buku.show', compact('databuku'));
    }

    public function edit($id){
        $book = Book::findOrFail($id);

        return view('page.kepalaperpus.buku.edit', compact('book'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'judul'          => 'required|string|max:255',
            'penulis'        => 'required|string|max:255',
            'tahun_terbit'   => 'required|digits:4|integer',
            'deskripsi'      => 'required|string',
            'stock'          => 'required|integer|min:0'
        ]);

        $databuku = Book::findOrFail($id);

        $databuku_update = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tahun_terbit' => $request->tahun_terbit,
            'deskripsi' => $request->deskripsi,
            'stock' => $request->stock
        ];

        if ($request->filled('stock')) {

            $databuku_update['stock'] = $request->stock;

            if ($request->stock == 0) {
                $databuku_update['status'] = 'habis';
            } else {
                $databuku_update['status'] = 'tersedia';
            }
        }

        //foto hanya diupdate kalau diisi
        if ($request->hasFile('foto')){
            //hapus file gambar sebelumnya
            Storage::disk('public')->delete($databuku->foto);

            //upload gambar
            $databuku_update['foto'] = $request->file('foto')->store('imgbuku', 'public');
        }

        //simpan data ke dalam base dengan data yang terbaru sesuai update
        $databuku->update($databuku_update);

        //simpan data ke halaman beranda
         return redirect()->route('books.index')->with('success', 'Data buku berhasil diedit');
    }

}
