<?php

use App\Http\Controllers\Anggota\AnggotaController;
use App\Http\Controllers\Anggota\BukuAnggotaController;
use App\Http\Controllers\Anggota\DashboardController;
use App\Http\Controllers\KepalaPerpus\BukuController;
use App\Http\Controllers\KepalaPerpus\DashboardKepalaPerpusController;
use App\Http\Controllers\KepalaPerpus\PetugasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Petugas\AnggotaPetugasController;
use App\Http\Controllers\Petugas\BukuPetugasController;
use App\Http\Controllers\Petugas\DashboardPetugasController;
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
    // PINJAM
    Route::get('/pinjam/{id}', [PinjamController::class, 'create'])->name('pinjam.create');
    Route::post('/pinjam/{id}', [PinjamController::class, 'store'])->name('pinjam');

});

//KEPALA PERPUSTAKAAN
Route::prefix('kepalaperpus')->group(function () {
    Route::resource('petugas', PetugasController::class);
    Route::resource('dashboard', DashboardKepalaPerpusController::class);
    Route::resource('books', BukuController::class);
});



//PETUGAS
Route::prefix('petugas')->name('petugas.')->group(function () {
    Route::resource('anggota', AnggotaPetugasController::class);
    Route::resource('buku', BukuPetugasController::class);
    Route::resource('dashboard', DashboardPetugasController::class);
    Route::resource('pinjam', PinjamPetugasController::class);
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


