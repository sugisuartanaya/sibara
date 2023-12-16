@extends('dashboard.layouts.main')


@section('content')

<div class="container">
  <hr>

  <div class="row">
    <div class="offset-md-3 col-md-6">
      <div class="py-3">
        <h3>Login <b class="text-success">Pengguna</b></h3>
      </div>
      <div class="outer-card">
        <div class="card background-card"></div>
        <div class="card mt-1">
          <div class="card-body">
      
            <form action="/account/login" method="post" enctype="multipart/form-data">
              @csrf
              
              
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" placeholder="Masukkan username Anda.." class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
                @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" placeholder="Masukkan password Anda.." class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
                @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
    
              <br>
              <button type="submit" class="btn btn-success d-block mx-auto w-100">Masuk</button>
              <br>
              <a href="#" class="text-success" style="text-decoration: none;"><p style="margin: 0;">Lupa password?</p></a>
              <a href="/account/register" class="text-success" style="text-decoration: none;"><p>Belum punya akun? Daftar</p></a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection