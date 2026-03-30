<?php

use App\Http\Controllers\KepalaPerpus\BukuController;
use App\Http\Controllers\KepalaPerpus\DashboardKepalaPerpusController;
use App\Http\Controllers\KepalaPerpus\PetugasController;
use App\Http\Controllers\Petugas\AnggotaPetugasController;
use App\Http\Controllers\Petugas\BukuPetugasController;
use App\Http\Controllers\Petugas\DashboardPetugasController;
use Illuminate\Support\Facades\Route;

//dashboard
Route::prefix('kepalaperpus')->group(function () {
    Route::resource('dashboard', DashboardKepalaPerpusController::class);
});

//buku
Route::prefix('kepalaperpus')->group(function () {
    Route::resource('books', BukuController::class);
});

//petugas
Route::prefix('kepalaperpus')->group(function () {
    Route::resource('petugas', PetugasController::class);
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


