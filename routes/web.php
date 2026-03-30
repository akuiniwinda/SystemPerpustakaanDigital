<?php

use App\Http\Controllers\Anggota\AnggotaController;
use App\Http\Controllers\Anggota\BukuAnggotaController;
use App\Http\Controllers\Anggota\DashboardController;
use App\Http\Controllers\KepalaPerpus\BukuController;
use App\Http\Controllers\KepalaPerpus\DashboardKepalaPerpusController;
use App\Http\Controllers\KepalaPerpus\PetugasController;
use App\Http\Controllers\Petugas\AnggotaPetugasController;
use App\Http\Controllers\Petugas\BukuPetugasController;
use App\Http\Controllers\Petugas\DashboardPetugasController;
use Illuminate\Support\Facades\Route;

//ANGGOTA
Route::prefix('perpustakaandigital')->name('anggota.')->group(function () {
    Route::resource('buku', BukuAnggotaController::class);
    Route::resource('profile', AnggotaController::class);
    Route::resource('dashboard', DashboardController::class);
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
});

//*register */
Route::get('/register', [AnggotaPetugasController::class, 'create'])->name('register');
Route::post('/register', [AnggotaPetugasController::class, 'store'])->name('register.store');


