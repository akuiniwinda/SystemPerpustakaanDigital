@extends('layout.petugas.app')
@section('content')
<div class="col-12 grid-margin transparent">
    @php $user = session('user'); @endphp

        <!-- Sambutan -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="p-3 bg-white rounded-3 shadow-sm border-start border-4 border-primary">
                    <h3 class="fw-bold mb-1 text-dark">Selamat Datang, {{ $user->nama ?? 'Petugas Perpustakaan' }}</h3>
                    <p class="text-secondary mb-0">
                        <i class="fas fa-book me-1 text-primary"></i>
                        Selamat Datang di Sistem Perpustakaan Digital
                        <span class="fw-semibold text-primary">SMKN 3 Banjar</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card card-tale">
                    <div class="card-body">
                        <p class="mb-4">Total Buku</p>
                        <p class="fs-30 mb-2">{{ $totalBuku ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-dark-blue">
                    <div class="card-body">
                        <p class="mb-4">Total Anggota</p>
                        <p class="fs-30 mb-2">{{ $totalAnggota ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-light-blue">
                    <div class="card-body">
                        <p class="mb-4">Total Pinjam</p>
                        <p class="fs-30 mb-2">{{ $totalPinjam ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
