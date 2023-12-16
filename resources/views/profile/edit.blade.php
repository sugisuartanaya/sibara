@extends('dashboard.layouts.main')


@section('content')

<div class="container ">
  <hr>
  <div class="py-3">
    <h3>Data Anda Salah</b></h3>
  </div>
  <div class="outer-card">
    <div class="card background-card"></div>
    <div class="card mt-1">
      <div class="card-body">
        <div class="alert alert-success" role="alert">
          {{ auth()->user()->pembeli->verifikasi->komentar }}
        </div>
  
        <form action="/account/profile/{{ auth()->user()->username }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')


          @if (auth()->user()->pembeli->verifikasi->jenis_kesalahan === 'foto')

            <input type="text" name="nama_pembeli" value="{{ auth()->user()->pembeli->nama_pembeli }}" style="display:none;">
            <input type="text" name="pekerjaan" value="{{ auth()->user()->pembeli->pekerjaan }}" style="display:none;">

            <div class="row mb-3">
              <div class="col-sm-3 col-md-3 col-xs-12">
                <label for="foto_ktp" class="col-form-label">Foto KTP</label>
                <span style="color: #eb340a;">*</span>
              </div>
              <div class="col-sm-9 col-md-9 col-xs-12">
                <input name="foto_ktp" type="file" id="image-ktp" accept="image/*" class="form-control @error('foto_ktp') is-invalid @enderror" value="{{ auth()->user()->pembeli->foto_ktp }}">
                @error('foto_ktp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <img id="image-preview-ktp" class="image-preview" alt="Image Preview KTP">
              </div>
            </div>
      
            <div class="row mb-3">
              <div class="col-sm-3 col-md-3 col-xs-12">
                <label for="foto_pembeli" class="col-form-label">Foto Selfie dengan KTP</label>
                <span style="color: #eb340a;">*</span>
              </div>
              <div class="col-sm-9 col-md-9 col-xs-12">
                <input name="foto_pembeli" type="file" id="image-selfie" accept="image/*" class="form-control @error('foto_pembeli') is-invalid @enderror" value="{{ auth()->user()->pembeli->foto_pembeli }}">
                @error('foto_pembeli')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
                <img id="image-preview-selfie" class="image-preview" alt="Image Preview Selfie">
              </div>
            </div>


          @elseif (auth()->user()->pembeli->verifikasi->jenis_kesalahan === 'nama_pembeli')
            <input type="text" name="pekerjaan" value="{{ auth()->user()->pembeli->pekerjaan }}" style="display:none;">

            <div class="row mb-3">
              <div class="col-sm-3 col-md-3 col-xs-12">
                <label for="nama_pembeli" class="col-form-label">Nama Lengkap</label>
                <span style="color: #eb340a;">*</span>
              </div>
              <div class="col-sm-9 col-md-9 col-xs-12">
                <input type="text" name="nama_pembeli" id="nama_pembeli" placeholder="Isi dengan nama Anda sesuai dengan yang tertera pada KTP" class="form-control @error('nama_pembeli') is-invalid @enderror" value="{{ auth()->user()->pembeli->nama_pembeli }}" required>
                @error('nama_pembeli')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>

          @elseif (auth()->user()->pembeli->verifikasi->jenis_kesalahan === 'pekerjaan')
            <input type="text" name="nama_pembeli" value="{{ auth()->user()->pembeli->nama_pembeli }}" style="display:none;">

            <div class="row mb-3">
              <div class="col-sm-3 col-md-3 col-xs-12">
                <label for="pekerjaan" class="col-form-label">Pekerjaan</label>
                <span style="color: #eb340a;">*</span>
              </div>
              <div class="col-sm-9 col-md-9 col-xs-12">
                <input type="text" name="pekerjaan" id="pekerjaan" placeholder="Isi dengan pekerjaan Anda yang sebenarnya" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ auth()->user()->pembeli->pekerjaan }}" required>
                @error('pekerjaan')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
          
          @endif

          <p style="color: #eb340a; text-align:right">* Wajib diisi</p>
          <br>
          <button type="submit" class="btn btn-success d-block mx-auto">Perbaiki Data</button>
          <br>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection