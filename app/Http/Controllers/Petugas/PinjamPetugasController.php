<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Pinjam;
use Carbon\Carbon;
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

    public function konfirmasiKembali(Request $request, $id){
        $pinjam = Pinjam::findOrFail($id);

        if (!$pinjam->pengajuan_pengembalian || $pinjam->status != 'meminjam') {
            return back()->with('error', 'Tidak ada pengajuan pengembalian yang valid.');
        }

        // VALIDASI - TAMBAHKAN tanggal_kembali
        $request->validate([
            'kondisi_buku' => 'required|in:baik,rusak,hilang',
            'tanggal_kembali' => 'required|date', // TAMBAHKAN INI
        ]);

        // PAKAI TANGGAL DARI REQUEST, BUKAN Carbon::now()!!!
        $tanggal_kembali_real = Carbon::parse($request->tanggal_kembali);
        $rencana_kembali = Carbon::parse($pinjam->tanggal_pengembalian);

        $denda = 0;

        // Denda telat
        if ($tanggal_kembali_real->gt($rencana_kembali)) {
            $hari_telat = $tanggal_kembali_real->diffInDays($rencana_kembali);
            $denda = $hari_telat * 5000;
        }

        // Denda kondisi
        if ($request->kondisi_buku == 'rusak') {
            $denda += 30000;
        }
        if ($request->kondisi_buku == 'hilang') {
            $denda = 55000;
        }

        // UPDATE - PAKAI TANGGAL DARI REQUEST
        $pinjam->update([
            'status' => 'selesai',
            'tanggal_kembali' => $request->tanggal_kembali, // LANGSUNG DARI REQUEST
            'denda' => $denda,
            'pengajuan_pengembalian' => false,
            'status_denda' => $denda > 0 ? 'belum' : 'lunas',
            'kondisi_buku' => $request->kondisi_buku,
        ]);

        $buku = Book::find($pinjam->book_id);
        if ($request->kondisi_buku != 'hilang') {
            $buku->increment('stock');
        }
        $buku->update(['status' => $buku->stock > 0 ? 'tersedia' : 'habis']);

        return redirect()->route('petugas.pinjam.index')->with('success',
            'Pengembalian berhasil! Tanggal: ' . $request->tanggal_kembali .
            ', Denda: ' . $denda
        );
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
