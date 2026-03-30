@extends('layout.kepalaperpus.app')
@section('content')
<div class="col-md-7 grid-margin transparent">
  <div class="row">
    <div class="col-md-7 mb-4 stretch-card transparent">
      <div class="card card-tale">
        <div class="card-body">
          <p class="mb-4">Total Buku</p>
          <p class="fs-30 mb-2">{{ $totalBuku }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-7 mb-4 stretch-card transparent">
      <div class="card card-dark-blue">
        <div class="card-body">
          <p class="mb-4">Total Petugas</p>
          <p class="fs-30 mb-2">{{ $totalPetugas }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
