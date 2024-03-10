@extends('dashboard.layouts.main')


@section('content')

<div class="container">
  <hr>

  <div class="row">
    <div class="offset-md-3 col-md-6">
      <div class="py-3">
        <h3>Lupa <b class="text-success">Password?</b></h3>
      </div>
      <div class="outer-card">
        <div class="card background-card"></div>
        <div class="card mt-1">
          <div class="card-body">

            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            
            <form method="POST" action="{{ route('password.email') }}">
              @csrf
              
              <div class="mb-3">
                <label for="email" class="form-label">{{ __('Alamat Email') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukkan alamat email anda" autofocus>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              
              <br>
              <button type="submit" class="btn btn-success d-block mx-auto w-100">{{ __('Kirim reset password') }}</button>
              <br>
              <a href="/account/register" class="text-success" style="text-decoration: none;"><p>Belum punya akun? Daftar</p></a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection