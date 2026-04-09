@extends('layout.anggota.app')
@section('content')
    {{-- Ganti col-md-8 menjadi col-12 --}}
    <div class="col-12 grid-margin transparent">
        @php $user = session('user'); @endphp

        <!-- Sambutan -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="p-3 bg-white rounded-3 shadow-sm border-start border-4 border-primary">
                    <h3 class="fw-bold mb-1 text-dark">Selamat Datang, {{ $user->nama }}</h3>
                    <p class="text-secondary mb-0">
                        <i class="fas fa-book me-1 text-primary"></i>
                        Selamat Datang di Sistem Perpustakaan Digital
                        <span class="fw-semibold text-primary">SMKN 3 Banjar</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Kartu statistik full width 3 kolom -->
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card card-tale">
                    <div class="card-body">
                        <p class="mb-4">Total Pernah Pinjam</p>
                        <p class="fs-30 mb-2">{{ $totalPernahPinjam ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-dark-blue">
                    <div class="card-body">
                        <p class="mb-4">Buku Belum Dikembalikan</p>
                        <p class="fs-30 mb-2">{{ $belumDikembalikan ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('anggota.denda.index') }}" class="text-decoration-none">
                    <div class="card card-light-blue">
                        <div class="card-body">
                            <p class="mb-4">Besar Denda</p>
                            <p class="fs-30 mb-2">{{ number_format($besarDenda ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
