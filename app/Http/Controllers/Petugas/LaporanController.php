<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Pinjam;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request){
        $filter = $request->input('filter', 'semua');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $perPage = $request->input('per_page', 5);

        $query = Pinjam::with(['anggota', 'buku']);

        switch ($filter) {
            case 'minggu':
                $query->whereBetween('tanggal_pinjam', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'bulan':
                $query->whereMonth('tanggal_pinjam', Carbon::now()->month)
                    ->whereYear('tanggal_pinjam', Carbon::now()->year);
                break;
            case 'tahun':
                $query->whereYear('tanggal_pinjam', Carbon::now()->year);
                break;
            case 'custom':
                if ($startDate && $endDate) {
                    $query->whereBetween('tanggal_pinjam', [Carbon::parse($startDate), Carbon::parse($endDate)]);
                }
                break;
        }

        // Base query untuk statistik (tanpa pagination)
        $baseQuery = clone $query;

        $totalDendaDibayar = (clone $baseQuery)->where('denda', '>', 0)->where('status_denda', 'lunas')->sum('denda');
        $totalDendaBelumDibayar = (clone $baseQuery)->where('denda', '>', 0)->where('status_denda', 'belum')->sum('denda');
        $jumlahAnggota = (clone $baseQuery)->distinct('anggota_id')->count('anggota_id');
        $jumlahPinjaman = (clone $baseQuery)->count();
        $jumlahBukuDipinjam = (clone $baseQuery)->whereNull('tanggal_kembali')->count();

        // Data untuk tabel dengan pagination
        $pinjams = $query->orderBy('tanggal_pinjam', 'desc')->paginate($perPage);

        return view('page.petugas.laporan.index', compact(
            'pinjams',
            'totalDendaDibayar',
            'totalDendaBelumDibayar',
            'jumlahAnggota',
            'jumlahPinjaman',
            'jumlahBukuDipinjam',
            'filter',
            'startDate',
            'endDate',
            'perPage'
        ));
    }

    public function download(Request $request){
        // sama persis dengan index
       $filter = $request->input('filter', 'semua');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Pinjam::with(['anggota', 'buku']);

        switch ($filter) {
            case 'minggu':
                $query->whereBetween('tanggal_pinjam', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'bulan':
                $query->whereMonth('tanggal_pinjam', Carbon::now()->month)
                      ->whereYear('tanggal_pinjam', Carbon::now()->year);
                break;
            case 'tahun':
                $query->whereYear('tanggal_pinjam', Carbon::now()->year);
                break;
            case 'custom':
                if ($startDate && $endDate) {
                    $query->whereBetween('tanggal_pinjam', [Carbon::parse($startDate), Carbon::parse($endDate)]);
                }
                break;
        }

        $pinjams = $query->get();

        $totalDendaDibayar = $pinjams->filter(fn($p) => $p->denda > 0 && $p->status_denda == 'lunas')->sum('denda');
        $totalDendaBelumDibayar = $pinjams->filter(fn($p) => $p->denda > 0 && $p->status_denda == 'belum')->sum('denda');
        $jumlahAnggota = $pinjams->pluck('anggota_id')->unique()->count();
        $jumlahPinjaman = $pinjams->count();
        $jumlahBukuDipinjam = $pinjams->whereNull('tanggal_kembali')->count();

        $pdf = Pdf::loadView('page.petugas.laporan.pdf', compact(
            'pinjams',
            'totalDendaDibayar',
            'totalDendaBelumDibayar',
            'jumlahAnggota',
            'jumlahPinjaman',
            'jumlahBukuDipinjam',
            'filter',
            'startDate',
            'endDate'
        ));
        return $pdf->download('laporan_peminjaman.pdf');
    }

    public function upload(Request $request){
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048'
        ]);

        $file = $request->file('file')->store('laporan', 'public');

        Laporan::create([
            'file' => $file,
            'petugas_id' => session('user')->id,
            'status' => 'belum_dilihat'
        ]);

        return back()->with('success','Laporan berhasil diupload');
    }
}
