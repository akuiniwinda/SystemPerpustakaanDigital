@extends('layout.petugas.app')

@section('content')
<div class="container mt-4">
    <div class="card p-4 mb-5 shadow-sm">
        <div class="row align-items-center">

            <!-- FOTO -->
            <div class="col-md-3 text-center">
                <img src="{{ $dataanggota->foto ? asset('storage/'.$dataanggota->foto) : asset('assets/images/default.png') }}"
                    style="width:150px;height:150px;border-radius:50%;object-fit:cover;">
            </div>

            <!-- DATA -->
            <div class="col-md-9">
                <table class="table table-borderless">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $dataanggota->nama }}</td>
                    </tr>
                    <tr>
                        <th>NIS</th>
                        <td>{{ $dataanggota->nomor_induk }}</td>
                    </tr>
                    <tr>
                        <th>No Telepon</th>
                        <td>{{ $dataanggota->no_telp }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $dataanggota->email }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $dataanggota->alamat }}</td>
                    </tr>
                </table>
            </div>

    </div>
    </div>
</div>
@endsection
