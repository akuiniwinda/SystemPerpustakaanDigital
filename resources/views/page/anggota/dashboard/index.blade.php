@extends('layout.anggota.app')
@section('content')
    <div class="col-md-8 grid-margin transparent">
        <div class="row">
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-tale">
                    <div class="card-body">
                        <p class="mb-4">Total Pernah Pinjam</p>
                        <p class="fs-30 mb-2">{{ $totalPernahPinjam ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-dark-blue">
                    <div class="card-body">
                        <p class="mb-4">Buku Belum Dikembalikan</p>
                        <p class="fs-30 mb-2">{{ $belumDikembalikan ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-light-blue">
                    <div class="card-body">
                        <p class="mb-4">Besar Denda</p>
                        <p class="fs-30 mb-2">{{ number_format($besarDenda ?? 0, 0, ',', '.') }}</p>
                        <!-- tambahkan format rupiah jika perlu -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
