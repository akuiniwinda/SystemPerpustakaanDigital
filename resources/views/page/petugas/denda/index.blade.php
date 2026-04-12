@extends('layout.petugas.app') {{-- sesuaikan dengan layout petugas Anda --}}

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Pengajuan Pelunasan Denda</h4>
                    <p>Daftar anggota yang telah mengajukan pelunasan denda secara offline.</p>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if($pengajuan->isEmpty())
                        <div class="alert alert-info">Tidak ada pengajuan denda saat ini.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th>Judul Buku</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Denda (Rp)</th>
                                        <th>Status Denda</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pengajuan as $index => $p)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $p->anggota->nama ?? $p->anggota_id }}</td>
                                        <td>{{ $p->buku->judul ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d/m/Y') }}</td>
                                        <td>Rp {{ number_format($p->denda, 0, ',', '.') }}</td>
                                        <td>
                                            @if($p->status_denda == 'diajukan')
                                                <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                            @else
                                                <span class="badge badge-success">Lunas</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($p->status_denda == 'diajukan')
                                                <form action="{{ route('petugas.konfirmasi.denda', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengonfirmasi pelunasan denda ini?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">Konfirmasi Lunas</button>
                                                </form>
                                            @else
                                                <button class="btn btn-sm btn-secondary" disabled>Sudah Lunas</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
