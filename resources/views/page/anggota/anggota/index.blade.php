@extends('layout.anggota.app')

@section('content')
<div class="container mt-4">

    <!-- PROFIL -->
    @php
        $user = session('user');
    @endphp

    <div class="card p-4 mb-5 shadow-sm">
        <div class="row align-items-center">

            <!-- FOTO -->
            <div class="col-md-3 text-center">
                <img src="{{ $user->foto ? asset('storage/'.$user->foto) : asset('assets/images/default.png') }}"
                    style="width:150px;height:150px;border-radius:50%;object-fit:cover;">
            </div>

            <!-- DATA -->
            <div class="col-md-9">
                <table class="table table-borderless">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $user->nama }}</td>
                    </tr>
                    <tr>
                        <th>NIS</th>
                        <td>{{ $user->nomor_induk }}</td>
                    </tr>
                    <tr>
                        <th>No Telepon</th>
                        <td>{{ $user->no_telp }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $user->alamat }}</td>
                    </tr>
                </table>
            </div>

    </div>
    </div>

    <!-- JUDUL -->
    <h4 class="text-center mb-4">Buku Dipinjam</h4>

    <!-- LIST BUKU -->
    <div class="row justify-content-center">
        <div class="col-md-3 mb-4">
            <div class="card text-center p-3 shadow-sm">

                <!-- FOTO -->
                <img src="{{ asset('assets/images/Jisoo.jpg') }}"
                     style="height:200px; object-fit:cover; border-radius:10px;">

                <!-- JUDUL -->
                <div class="mt-2">
                    <h6>laut bercerita</h6>
                    <small class="text-muted">Winda</small>
                </div>

                <!-- BUTTON -->
                <div class="mt-2">
                    <form action="" method="POST">
                        @csrf
                        <button class="btn btn-danger btn-sm">
                            Kembalikan
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
