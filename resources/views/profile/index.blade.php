@extends('dashboard.layouts.main')


@section('content')

<div class="container py-4">
  <div class="row">
    <div class="col-md-3">
      <div class="outer-card">
        <div class="card background-card"></div>
        <div class="card mt-1">
          <div class="card-header">
            <strong>My Profile</strong>
          </div>
          
          <ul class="list-group list-group-flush">
            <a href="/account/profile" class="text-decoration-none"><li class="list-group-item d-flex justify-content-between align-items-center text-success">
              <strong>Informasi Pribadi</strong>
            </li></a>
            <a href="/account/penawaran" class="text-decoration-none"><li class="list-group-item d-flex justify-content-between align-items-center">
              Penawaran Anda
              <span class="badge bg-success rounded-pill">2</span>
            </li></a>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Transaksi Penawaran
              <span class="badge bg-success rounded-pill">1</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="outer-card">
        <div class="card background-card"></div>
        <div class="card mt-1">
          <div class="card-body">
            <h5><strong>Informasi Pribadi</strong></h5>
            <div class="row">
              <div class="col-5">
                <p class="text-secondary mb-0" >Username</p>          
                <h6 class="mb-3">{{ auth()->user()->username }}</h6>
                <p class="text-secondary mb-0" >Nama</p>          
                <h6 class="mb-3">{{ auth()->user()->pembeli->nama_pembeli }}</h6>
                <p class="text-secondary mb-0" >Pekerjaan</p>          
                <h6 class="mb-3">{{ auth()->user()->pembeli->pekerjaan }}</h6>
                <p class="text-secondary mb-0" >Alamat</p>          
                <h6 class="mb-3">{{ auth()->user()->pembeli->alamat }}</h6>
                <p class="text-secondary mb-0" >No Telepon</p>          
                <h6 class="mb-3">+62{{ auth()->user()->pembeli->no_telepon }}</h6>
              </div>
              <div class="col-md-7">
                <img class="bd-placeholder-img card-img-top" src="{{ asset(auth()->user()->pembeli->foto_ktp) }}"" style="object-fit: cover; width: 100%; height: 300px;"  alt="Your Alt Text">
              </div>
            </div>
            <div>
              <button class="btn btn-sm btn-outline-success">
                Ubah No. Telepon
              </button>
              <button class="btn btn-sm btn-outline-success">
                Ubah Password
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection