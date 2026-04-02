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
</div>
@endsection
