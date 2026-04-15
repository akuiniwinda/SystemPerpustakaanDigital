@extends('layout.kepalaperpus.app')
@section('content')
    <div class="col-12 grid-margin transparent">
        @php $user = session('user'); @endphp

        <!-- Sambutan -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="p-4 rounded-4 shadow-lg border-0"
                    style="background: #4b49ac;">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div>
                            <h3 class="fw-bold mb-1 text-white">
                                <i class="fas fa-user-graduate me-2"></i>
                                Selamat Datang, {{ $user->name ?? 'Kepala Perpustakaan' }}
                            </h3>
                            <p class="mb-1 text-white-50">
                                <i class="fas fa-book-open me-2"></i>
                                Selamat Datang di Sistem Perpustakaan Digital
                                <span class="fw-semibold text-warning">SMKN 3 Banjar</span>
                            </p>
                            <small class="text-white-50">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ now()->format('l, d F Y') }}
                            </small>
                        </div>
                        <div class="mt-2 mt-sm-0 text-white-50">
                            <i class="fas fa-book fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu statistik full width 3 kolom -->
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
                        <p class="mb-4">Total Petugas</p>
                        <p class="fs-30 mb-2">{{ $totalPetugas ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                {{-- Bisa diubah sesuai kebutuhan, misal total peminjaman atau total denda --}}
                <div class="card card-light-blue">
                    <div class="card-body">
                        <p class="mb-4">Total Peminjaman</p>
                        <p class="fs-30 mb-2">{{ $totalPeminjaman ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
