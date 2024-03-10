@extends('dashboard.layouts.main')


@section('content')

@if(session('success'))
  <div aria-live="polite" aria-atomic="true" class="position-relative bd-example-toasts rounded-3">
    <div class="toast-container top-0 end-0 p-0" id="toastPlacement">
      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="me-auto">Sukses</strong>
          <small>1 detik yang lalu</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          {{ session('success') }}
        </div>
      </div>
    </div>
  </div>
@elseif(session('error'))
  <div aria-live="polite" aria-atomic="true" class="position-relative bd-example-toasts rounded-3">
    <div class="toast-container top-0 end-0 p-0" id="toastPlacement">
      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="me-auto">Gagal</strong>
          <small>1 detik yang lalu</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          {{ session('error') }}
        </div>
      </div>
    </div>
  </div>
@endif


@if($errors->has('password'))
  <div aria-live="polite" aria-atomic="true" class="position-relative bd-example-toasts rounded-3">
    <div class="toast-container top-0 end-0 p-0" id="toastPlacement">
      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="me-auto">Gagal</strong>
          <small>1 detik yang lalu</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          {{ $errors->first('password') }}
        </div>
      </div>
    </div>
  </div>
@endif

<div class="container py-4">
  <div class="row">
    <div class="col-md-3">
      <div class="outer-card">
        <div class="card background-card"></div>
        <div class="card mt-1">
          <div class="card-header">
            <strong>My Profile</strong>
          </div>
          
          
          @php
            $penawaranAvailable = isset($statusPenawaran['penawaranAvailable']) ? $statusPenawaran['penawaranAvailable'] : null;
            $notifCount = isset($notif['transaksi']) ? $notif['transaksi'] : null;
          @endphp


          <ul class="list-group list-group-flush">
            <a href="/account/profile" class="text-decoration-none"><li class="list-group-item d-flex justify-content-between align-items-center text-success">
              <strong>Informasi Pribadi</strong>
            </li></a>
            <a href="/account/penawaran" class="text-decoration-none"><li class="list-group-item d-flex justify-content-between align-items-center">
              Penawaran Anda
              @if ($penawaranAvailable)
                <span class="badge bg-success rounded-pill" style="position: absolute; top: 50%; transform: translateY(-50%); right: 10px;">{{ $penawaranAvailable->count() }}</span>
              @endif
            </li></a>
            <li class="list-group-item dropdown" style="position: relative;">
              <a class="dropdown-toggle text-decoration-none text-dark" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Transaksi
                @if ($notifCount)
                  @if($notifCount->isNotEmpty())
                    <span class="badge bg-success rounded-pill" style="position: absolute; top: 50%; transform: translateY(-50%); right: 10px;">
                    {{ $notifCount->count() }}</span>
                  @endif
                @endif
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="/pembayaran">Menunggu Pembayaran</a></li>
                <li><a class="dropdown-item" href="/transaksi">Transaksi Anda</a></li>
              </ul>
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
                <p class="text-secondary mb-0" >Email</p>          
                <h6 class="mb-3">{{ auth()->user()->email }}</h6>
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
              <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#telepon">
                Ubah No. Telepon
              </button>
              <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#password">
                Ubah Password
              </button>
            </div>

            <div class="modal fade" id="telepon" tabindex="-1" aria-labelledby="telepon" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah No. Telepon</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="/account/updateNotelp/{{ auth()->user()->pembeli->id }}" method="post" >
                      @csrf
                      @method('PUT')
                      <label class="form-label">Masukkan No. Telepon yang baru</label>
                      <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">+62</span>
                        <input type="number" name="no_telepon" class="form-control" placeholder="Pastikan nomor terhubung dengan WhatsApp" value="{{ auth()->user()->pembeli->no_telepon }}">
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="password" tabindex="-1" aria-labelledby="password" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="/account/updatePassword/{{ auth()->user()->pembeli->id }}" method="POST">
                      @csrf
                      @method('PUT')
                  
                      <div class="mb-3">
                        <label for="current_password" class="form-label">Password Saat Ini</label>
                        <input type="password" name="current_password" class="form-control" placeholder="Masukkan Password Anda saat ini" required>
                      </div>
                  
                      <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password Baru" required>
                      </div>
                  
                      <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password Baru" required>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection