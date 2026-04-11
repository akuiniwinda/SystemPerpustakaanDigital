<?php

use App\Http\Controllers\Anggota\AnggotaController;
use App\Http\Controllers\Anggota\BukuAnggotaController;
use App\Http\Controllers\Anggota\DashboardController;
use App\Http\Controllers\Anggota\RiwayatAnggotaController;
use App\Http\Controllers\KepalaPerpus\AkunKepalaPerpusController;
use App\Http\Controllers\KepalaPerpus\BukuController;
use App\Http\Controllers\KepalaPerpus\CekLaporanController;
use App\Http\Controllers\KepalaPerpus\DashboardKepalaPerpusController;
use App\Http\Controllers\KepalaPerpus\PetugasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Petugas\AnggotaPetugasController;
use App\Http\Controllers\Petugas\BukuPetugasController;
use App\Http\Controllers\Petugas\DashboardPetugasController;
use App\Http\Controllers\Petugas\LaporanController;
use App\Http\Controllers\Petugas\PinjamPetugasController;
use App\Http\Controllers\PinjamController;
use Illuminate\Support\Facades\Route;

//ANGGOTA
Route::prefix('perpustakaandigital')
    ->name('anggota.')
    ->middleware('cekRole:anggota')
    ->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('buku', BukuAnggotaController::class);
    Route::resource('profile', AnggotaController::class);
    Route::resource('riwayat', RiwayatAnggotaController::class);
    // PINJAM
    Route::get('/pinjam/{id}', [PinjamController::class, 'create'])->name('pinjam.create');
    Route::post('/pinjam/{id}', [PinjamController::class, 'store'])->name('pinjam');
    Route::post('/kembalikan/{id}', [PinjamController::class, 'ajukanKembali'])->name('kembalikan');
    Route::get('denda', [PinjamController::class, 'daftarDenda'])->name('denda.index');
    Route::post('denda/{id}/ajukan', [PinjamController::class, 'ajukanDenda'])->name('denda.ajukan');
});

//KEPALA PERPUSTAKAAN
Route::prefix('kepalaperpus')
    ->middleware('cekRole:kepalaperpus')
    ->group(function () {
    Route::get('books/hapus/{id}', [BukuController::class, 'destroy'])->name('books.delete');
    Route::get('petugas/hapus/{id}', [PetugasController::class, 'destroy'])->name('petugas.delete');
    Route::resource('petugas', PetugasController::class);
    Route::resource('dashboard', DashboardKepalaPerpusController::class);
    Route::resource('books', BukuController::class);
    Route::resource('tambahakun', AkunKepalaPerpusController::class);
    Route::get('/laporan', [CekLaporanController::class, 'index'])->name('laporan.index');
    Route::post('/laporan/{id}/lihat', [CekLaporanController::class, 'lihat'])->name('laporan.lihat');
    Route::post('/books/update-status/{id}', [BukuController::class, 'updateStatus'])->name('books.toggle');
    Route::post('/books/{id}/tambah-stok', [BukuController::class, 'tambahStok'])->name('books.tambahStok');
});



    Route::prefix('petugas')
        ->name('petugas.')
        ->middleware('cekRole:petugas')
        ->group(function () {
        Route::resource('anggota', AnggotaPetugasController::class);
        Route::resource('buku', BukuPetugasController::class);
        Route::resource('dashboard', DashboardPetugasController::class);
        Route::resource('pinjam', PinjamPetugasController::class);

        // Konfirmasi peminjaman (dari halaman show)
        Route::post('/konfirmasi/{id}', [PinjamPetugasController::class, 'konfirmasi'])->name('konfirmasi');

        // Konfirmasi pengembalian (tambahkan ini)
        Route::post('/kembali/{id}', [PinjamPetugasController::class, 'konfirmasiKembali'])->name('kembali');

        Route::get('/pengajuan-denda', [PinjamPetugasController::class, 'listPengajuanDenda'])->name('pengajuan.denda');
        Route::post('/konfirmasi-denda/{id}', [PinjamPetugasController::class, 'konfirmasiDenda'])->name('konfirmasi.denda');

        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/download', [LaporanController::class, 'download'])->name('laporan.download');
        Route::post('/laporan/upload', [LaporanController::class, 'upload'])->name('laporan.upload');
    });


//*register */
Route::get('/register', [AnggotaPetugasController::class, 'create'])->name('register');
Route::post('/register', [AnggotaPetugasController::class, 'store'])->name('register.store');

//login
Route::get('/login', function(){
    return view('page.auth.login');
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.proses');

//logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


