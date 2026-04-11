<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Pinjam;
use Illuminate\Http\Request;

class PinjamPetugasController extends Controller
{
    //tampilkan semua data
    public function index(Request $request){
        $search = $request->input('search');
        $Pinjambuku = Pinjam::with(['anggota', 'buku'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('anggota', function ($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%');
                })->orWhereHas('buku', function ($q) use ($search) {
                    $q->where('judul', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
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


// Menangani konfirmasi/tolak dari halaman show (pakai input 'aksi')
    public function konfirmasi(Request $request, $id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $aksi = $request->input('aksi');

        if ($aksi == 'konfirmasi') {
            // Logika setujui peminjaman
            if ($pinjam->status != 'pengajuan') {
                return back()->with('error', 'Status tidak valid untuk disetujui.');
            }
            $buku = Book::find($pinjam->book_id);
            if ($buku->stock <= 0) {
                return back()->with('error', 'Stok habis, tidak bisa disetujui.');
            }
            $pinjam->update(['status' => 'meminjam']);
            $buku->decrement('stock');
            $buku->update(['status' => $buku->stock > 0 ? 'tersedia' : 'habis']);
            return redirect()->route('petugas.pinjam.index')->with('success', 'Peminjaman disetujui.');
        }
        elseif ($aksi == 'tolak') {
            if ($pinjam->status != 'pengajuan') {
                return back()->with('error', 'Status tidak valid untuk ditolak.');
            }
            $pinjam->update(['status' => 'ditolak']);
            return redirect()->route('petugas.pinjam.index')->with('success', 'Peminjaman ditolak.');
        }

        return back()->with('error', 'Aksi tidak dikenal.');
    }

    // Daftar pengajuan pinjam (status = 'pengajuan' dan belum ada pengajuan kembali)
    public function listPengajuanPinjam()
    {
        $pengajuan = Pinjam::with(['anggota', 'buku'])
                    ->where('status', 'pengajuan')
                    ->where('pengajuan_pengembalian', false)
                    ->get();
        return view('page.petugas.pengajuan_pinjam', compact('pengajuan'));
    }

    // Daftar pengajuan kembali (status = 'meminjam' dan pengajuan_pengembalian = true)
    public function listPengajuanKembali()
    {
        $pengajuan = Pinjam::with(['anggota', 'buku'])
                    ->where('status', 'meminjam')
                    ->where('pengajuan_pengembalian', true)
                    ->get();
        return view('page.petugas.pengajuan_kembali', compact('pengajuan'));
    }

    // Petugas konfirmasi pengembalian
    public function konfirmasiKembali($id){
        $pinjam = Pinjam::findOrFail($id);
        if (!$pinjam->pengajuan_pengembalian || $pinjam->status != 'meminjam') {
            return back()->with('error', 'Tidak ada pengajuan pengembalian yang valid.');
        }

        $pinjam->update([
            'status' => 'selesai',
            'tanggal_kembali' => now(),
            'denda' => $pinjam->denda_pengajuan,
            'pengajuan_pengembalian' => false,
            'status_denda' => $pinjam->denda_pengajuan > 0 ? 'belum' : 'lunas', // jika denda 0 langsung lunas
        ]);

        $buku = Book::find($pinjam->book_id);
        $buku->increment('stock');
        $buku->update(['status' => 'tersedia']);

        return redirect()->route('petugas.pinjam.index')->with('success', 'Pengembalian disetujui. Denda: Rp ' . number_format($pinjam->denda_pengajuan, 0, ',', '.'));
    }

    // Daftar pengajuan denda
    public function listPengajuanDenda(){
        $pengajuan = Pinjam::with(['anggota', 'buku'])
                    ->where('status_denda', 'diajukan')
                    ->get();
        return view('page.petugas.denda.index', compact('pengajuan'));
    }

    // Konfirmasi pelunasan denda
    public function konfirmasiDenda($id){
        $pinjam = Pinjam::findOrFail($id);
        if ($pinjam->status_denda != 'diajukan') {
            return back()->with('error', 'Status tidak valid.');
        }
        $pinjam->update(['status_denda' => 'lunas']);
        return back()->with('success', 'Denda telah dilunasi.');
    }
}
