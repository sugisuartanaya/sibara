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
          <input type="text" style="display:none;" id="role" name="komentar" class="form-control" value="belum ada komentar">
          {{-- <input type="checkbox" style="display:none;" id="is_verified" name="is_verified" class="form-control"> --}}
  
          <div class="row mb-3">
            <div class="col-sm-3 col-md-3 col-xs-12">
              <label for="username" class="col-form-label">Username</label>
              <span style="color: #eb340a;">*</span>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <input type="text" name="username" id="username" placeholder="Harap masukkan nama pengguna yang akan Anda gunakan untuk mengakses sistem." class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" >
              @error('username')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>


          <div class="row mb-3">
            <div class="col-sm-3 col-md-3 col-xs-12">
              <label for="password" class="col-form-label">Password</label>
              <span style="color: #eb340a;">*</span>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <input type="password" name="password" id="password" placeholder="Minimal 8 karakter" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
              @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>


          <div class="row mb-3">
            <div class="col-sm-3 col-md-3 col-xs-12">
              <label for="nama_pembeli" class="col-form-label">Nama Lengkap</label>
              <span style="color: #eb340a;">*</span>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <input type="text" name="nama_pembeli" id="nama_pembeli" placeholder="Isi dengan nama Anda sesuai dengan yang tertera pada KTP" class="form-control @error('nama_pembeli') is-invalid @enderror" value="{{ old('nama_pembeli') }}">
              @error('nama_pembeli')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>


          <div class="row mb-3">
            <div class="col-sm-3 col-md-3 col-xs-12">
              <label for="pekerjaan" class="col-form-label">Pekerjaan</label>
              <span style="color: #eb340a;">*</span>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <input type="text" name="pekerjaan" id="pekerjaan" placeholder="Isi dengan pekerjaan Anda yang sebenarnya" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan') }}">
              @error('pekerjaan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-3 col-md-3 col-xs-12">
              <label for="no_telepon" class="col-form-label">No Telepon</label>
              <span style="color: #eb340a;">*</span>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1">+62</span>
                <input type="text" name="no_telepon" id="no_telepon" placeholder="Pastikan nomor telepon Anda aktif (dapat dihubungi) dan terhubung dengan aplikasi WhatsApp" class="form-control @error('no_telepon') is-invalid @enderror" value="{{ old('no_telepon') }}">
                @error('no_telepon')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-3 col-md-3 col-xs-12">
              <label for="alamat" class="col-form-label">Alamat</label>
              <span style="color: #eb340a;">*</span>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <textarea type="text" name="alamat" id="alamat" placeholder="Isi dengan alamat rumah Anda yang sebenarnya" class="form-control @error('alamat') is-invalid @enderror"></textarea>
              @error('alamat')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-3 col-md-3 col-xs-12">
              <label for="foto_ktp" class="col-form-label">Foto KTP</label>
              <span style="color: #eb340a;">*</span>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <input name="foto_ktp" type="file" id="foto_ktp" accept="image/*" class="form-control @error('foto_ktp') is-invalid @enderror" value="{{ old('foto_ktp') }}">
              @error('foto_ktp')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-3 col-md-3 col-xs-12">
              <label for="foto_pembeli" class="col-form-label">Foto Selfie dengan KTP</label>
              <span style="color: #eb340a;">*</span>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <input name="foto_pembeli" type="file" id="foto_pembeli" accept="image/*" class="form-control @error('foto_pembeli') is-invalid @enderror" value="{{ old('foto_pembeli') }}">
              @error('foto_pembeli')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

          <p style="color: #eb340a; text-align:right">* Wajib diisi</p>
          <br>
          <button type="submit" class="btn btn-success d-block mx-auto">Daftarkan Akun Saya</button>
          <br>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection