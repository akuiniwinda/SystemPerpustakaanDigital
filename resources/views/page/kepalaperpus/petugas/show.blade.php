@extends('layout.kepalaperpus.app')
@section('content')
    <!-- PROFIL -->
    <div class="card p-4 mb-5 shadow-sm">
        <div class="row align-items-center">
            <div class="col-md-3 text-center">
                @if($datapetugas->foto)
                    <img src="{{ asset('storage/' . $datapetugas->foto) }}"
                         style="width:150px;height:150px;border-radius:50%;object-fit:cover;"
                         alt="Foto {{ $datapetugas->nama }}">
                @else
                    <img src="{{ asset('assets/images/default-avatar.jpg') }}"
                         style="width:150px;height:150px;border-radius:50%;object-fit:cover;"
                         alt="Default Avatar">
                @endif
            </div>

            <!-- DATA PETUGAS -->
            <div class="col-md-9">
                <table class="table table-borderless">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $datapetugas->nama }}</td>
                    </tr>
                    <tr>
                        <th>NIP</th>
                        <td>{{ $datapetugas->nis ?? $datapetugas->nip ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $datapetugas->email }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $datapetugas->alamat }}</td>
                    </tr>
                </table>
                <a href="{{ route('petugas.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
