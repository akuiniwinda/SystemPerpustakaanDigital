@extends('layout.anggota.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Ajukan Pelunasan Denda</h4>
                    <p>Silakan ajukan setelah Anda membayar denda secara langsung ke petugas.</p>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if($dendas->isEmpty())
                        <div class="alert alert-info">Tidak ada denda yang perlu diajukan.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Buku</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Rencana Kembali</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Denda (Rp)</th>
                                        <th>Alasan Denda</th>
                                        <th>Status Denda</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dendas as $index => $d)
                                     @php
                                        // Hitung keterlambatan
                                        $rencana = \Carbon\Carbon::parse($d->tanggal_pengembalian);
                                        $kembali = \Carbon\Carbon::parse($d->tanggal_kembali);
                                        $telat = 0;
                                        $alasan = [];

                                        if ($kembali->gt($rencana)) {
                                            $telat = $kembali->diffInDays($rencana);
                                            $alasan[] = "Telat {$telat} hari (Rp " . number_format($telat * 5000) . ")";
                                        }

                                        if ($d->kondisi_buku == 'rusak') {
                                            $alasan[] = "Buku rusak (Denda Rp 30.000)";
                                        } elseif ($d->kondisi_buku == 'hilang') {
                                            $alasan[] = "Buku hilang (Denda Rp 55.000)";
                                        }

                                        $alasanText = !empty($alasan) ? implode(' + ', $alasan) : '-';
                                     @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $d->buku->judul }}</td>
                                        <td>{{ \Carbon\Carbon::parse($d->tanggal_pinjam)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($d->tanggal_pengembalian)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($d->tanggal_kembali)->format('d/m/Y') }}</td>
                                        <td>Rp {{ number_format($d->denda, 0, ',', '.') }}</td>
                                        <td>
                                            <small class="text-danger">
                                                {{ $alasanText }}
                                            </small>
                                        </td>
                                        <td>
                                            @if($d->status_denda == 'belum')
                                                <span class="badge badge-danger">Belum dibayar</span>
                                            @elseif($d->status_denda == 'diajukan')
                                                <span class="badge badge-warning">Menunggu konfirmasi</span>
                                            @else
                                                <span class="badge badge-success">Lunas</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($d->status_denda == 'belum')
                                                <form action="{{ route('anggota.denda.ajukan', $d->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-primary">Ajukan Pelunasan</button>
                                                </form>
                                            @elseif($d->status_denda == 'diajukan')
                                                <button class="btn btn-sm btn-secondary" disabled>Menunggu Petugas</button>
                                            @else
                                                <button class="btn btn-sm btn-success" disabled>Lunas</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- total denda -->
                        <div class="alert alert-info mt-3">
                            <strong>Total Denda yang Harus Dibayar: Rp {{ number_format($besarDenda, 0, ',', '.') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
