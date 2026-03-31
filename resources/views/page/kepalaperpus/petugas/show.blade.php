@extends('layout.kepalaperpus.app')
@section('content')
    <!-- PROFIL -->
    <div class="card p-4 mb-5 shadow-sm">
        <div class="row align-items-center">

            <!-- FOTO -->
            <div class="col-md-3 text-center">
                <img src="{{ asset('assets/images/Jisoo.jpg') }}"
                     style="width:150px;height:150px;border-radius:50%;object-fit:cover;">
            </div>

            <!-- DATA -->
            <div class="col-md-9">
                <table class="table table-borderless">
                    <tr>
                        <th>Nama</th>
                        <td>Winda</td>
                    </tr>
                    <tr>
                        <th>NIS</th>
                        <td>293894</td>
                    </tr>
                    <tr>
                        <th>No Telepon</th>
                        <td>08727636</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>windut@gmail</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>sybauuu</td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
@endsection
