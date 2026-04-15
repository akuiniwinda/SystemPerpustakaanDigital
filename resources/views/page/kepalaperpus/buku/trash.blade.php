@extends('layout.kepalaperpus.app')

@section('content')
<div class="container">
    <h1 class="mb-4">🗑️ Buku Terhapus (Sampah)</h1>

    <a href="{{ route('books.index') }}" class="btn btn-primary mb-3">
        ← Kembali ke Daftar Buku
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
    <!--form untuk searcing-->
    <form action="{{ route('books.trash') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari judul atau penulis..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
            @if(request('search'))
                <a href="{{ route('books.trash') }}" class="btn btn-secondary">Reset</a>
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
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Tahun Terbit</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Tanggal Dihapus</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($Books as $key => $book)
                        <tr>
                            <td>{{ $Books->firstItem() + $key }}</td>
                            <td>
                                @if($book->foto)
                                    <img src="{{ asset('storage/' . $book->foto) }}" width="50" height="60" style="object-fit: cover;" class="rounded">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $book->judul }}</td>
                            <td>{{ $book->penulis }}</td>
                            <td>{{ $book->tahun_terbit }}</td>
                            <td>{{ $book->stock }}</td>
                            <td>
                                @if($book->status == 'tersedia')
                                    <span class="badge bg-success">Tersedia</span>
                                @else
                                    <span class="badge bg-danger">Habis</span>
                                @endif
                            </td>
                            <td>{{ $book->deleted_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!-- Tombol Restore -->
                                    <form action="{{ route('books.restore', $book->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Pulihkan buku ini?')">
                                            🔄 Pulihkan
                                        </button>
                                    </form>

                                    <!-- Tombol Force Delete -->
                                    <form action="{{ route('books.force-delete', $book->id) }}" method="POST" style="display: inline;">
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
                            <td colspan="9" class="text-center text-muted">
                                Tidak ada data buku terhapus
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $Books->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
