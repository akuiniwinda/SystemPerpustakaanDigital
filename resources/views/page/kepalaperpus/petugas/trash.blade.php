@extends('layout.kepalaperpus.app')

@section('content')
<div class="container">
    <h1 class="mb-4">🗑️ Data Petugas Terhapus</h1>

    <a href="{{ route('petugas.index') }}" class="btn btn-primary mb-3">
        ← Kembali ke Daftar Petugas
    </a>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    <!-- Search Form -->
    <form action="{{ route('petugas.trash') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari nama atau alamat..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
            @if(request('search'))
                <a href="{{ route('petugas.trash') }}" class="btn btn-secondary">Reset</a>
            @endif
        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIP</th>
                            <th>Alamat</th>
                            <th>Tanggal Dihapus</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($Petugases as $key => $petugas)
                        <tr>
                            <td>{{ $Petugases->firstItem() + $key }}</td>
                            <td>
                                @if($petugas->foto)
                                    <img src="{{ asset('storage/' . $petugas->foto) }}" width="50" height="50" style="object-fit: cover;" class="rounded-circle">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $petugas->nama }}</td>
                            <td>{{ $petugas->email }}</td>
                            <td>{{ $petugas->nip }}</td>
                            <td>{{ $petugas->alamat }}</td>
                            <td>{{ $petugas->deleted_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!-- Tombol Restore -->
                                    <form action="{{ route('petugas.restore', $petugas->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Pulihkan data petugas ini?')">
                                            🔄 Pulihkan
                                        </button>
                                    </form>

                                    <!-- Tombol Force Delete -->
                                    <form action="{{ route('petugas.force-delete', $petugas->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus permanen? Data tidak bisa dikembalikan!')">
                                            💀 Hapus Permanen
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                Tidak ada data petugas terhapus
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $Petugases->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
