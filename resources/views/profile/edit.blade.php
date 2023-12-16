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
          Silakan perbaiki foto yang anda upload, pastikan foto yang diupload sesuai dan terlihat jelas.
        </div>
  
        <form action="/account/profile/{{ auth()->user()->username }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="row mb-3">
            <div class="col-sm-3 col-md-3 col-xs-12">
              <label for="foto_ktp" class="col-form-label">Foto KTP</label>
              <span style="color: #eb340a;">*</span>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <input name="foto_ktp" type="file" id="image-ktp" accept="image/*" class="form-control @error('foto_ktp') is-invalid @enderror" value="{{ old('foto_ktp') }}">
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
              <input name="foto_pembeli" type="file" id="image-selfie" accept="image/*" class="form-control @error('foto_pembeli') is-invalid @enderror" value="{{ old('foto_pembeli') }}">
              @error('foto_pembeli')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
              <img id="image-preview-selfie" class="image-preview" alt="Image Preview Selfie">
            </div>
          </div>

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