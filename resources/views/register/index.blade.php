@extends('dashboard.layouts.main')


@section('content')

<div class="container ">
  <hr>
  <div class="py-3">
    <h3>Pendaftaran <b class="text-success">Pengguna Baru</b></h3>
  </div>
  <div class="outer-card">
    <div class="card background-card"></div>
    <div class="card mt-1">
      <div class="card-body">
        <div class="alert alert-success" role="alert">
          Silakan lengkapi form pendaftaran berikut. Akun pengguna yang didaftarkan harus data yang sebenar benarnya.
        </div>
  
        <form action="/account/register" method="post" enctype="multipart/form-data">
          @csrf

          <input type="text" style="display:none;" id="role" name="role" class="form-control" value="2">
  
          <div class="row mb-3">
            <div class="col-sm-3 col-md-3 col-xs-12">
              <label for="username" class="col-form-label">Username</label>
              <span style="color: #eb340a;">*</span>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <input type="text" name="username" id="username" class="form-control"
              placeholder="Harap masukkan nama pengguna yang akan Anda gunakan untuk mengakses sistem.">
            </div>
          </div>


          <div class="row mb-3">
            <div class="col-sm-3 col-md-3 col-xs-12">
              <label for="password" class="col-form-label">Password</label>
              <span style="color: #eb340a;">*</span>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <input type="password" name="password" id="password" class="form-control"
              placeholder="Minimal 8 karakter">
            </div>
          </div>


          <div class="row mb-3">
            <div class="col-sm-3 col-md-3 col-xs-12">
              <label for="nama_pembeli" class="col-form-label">Nama Lengkap</label>
              <span style="color: #eb340a;">*</span>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control"
              placeholder="Isi dengan nama Anda sesuai dengan yang tertera pada KTP">
            </div>
          </div>


          <div class="row mb-3">
            <div class="col-sm-3 col-md-3 col-xs-12">
              <label for="pekerjaan" class="col-form-label">Pekerjaan</label>
              <span style="color: #eb340a;">*</span>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <input type="text" name="pekerjaan" id="pekerjaan" class="form-control"
              placeholder="Isi dengan pekerjaan Anda yang sebenarnya">
            </div>
          </div>


          <div class="row mb-3">
            <div class="col-sm-3 col-md-3 col-xs-12">
              <label for="no_telepon" class="col-form-label">No Telepon</label>
              <span style="color: #eb340a;">*</span>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <input type="text" name="no_telepon" id="no_telepon" class="form-control"
              placeholder="Pastikan nomor telepon Anda aktif, agar dapat dihubungi">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-3 col-md-3 col-xs-12">
              <label for="alamat" class="col-form-label">Alamat</label>
              <span style="color: #eb340a;">*</span>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <textarea type="text" name="alamat" id="alamat" class="form-control"
              placeholder="Isi dengan alamat rumah Anda yang sebenarnya"></textarea>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-3 col-md-3 col-xs-12">
              <label for="foto_ktp" class="col-form-label">Foto KTP</label>
              <span style="color: #eb340a;">*</span>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <input class="form-control" name="foto_ktp" type="file" id="foto_ktp" accept="image/*">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-3 col-md-3 col-xs-12">
              <label for="foto_pembeli" class="col-form-label">Foto Selfie dengan KTP</label>
              <span style="color: #eb340a;">*</span>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <input class="form-control" name="foto_pembeli" type="file" id="foto_pembeli" accept="image/*">
            </div>
          </div>


          <br>
          <button type="submit" class="btn btn-success d-block mx-auto">Daftarkan Akun Saya</button>
          <br>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection