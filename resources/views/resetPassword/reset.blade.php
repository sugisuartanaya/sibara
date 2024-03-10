<!-- resources/views/auth/passwords/reset.blade.php -->
@extends('dashboard.layouts.main')

@section('content')
	<div class="container">
		<hr>

		<div class="row">
			<div class="offset-md-3 col-md-6">
				<div class="py-3">
					<h3>Password <b class="text-success">Baru</b></h3>
				</div>
				<div class="outer-card">
					<div class="card background-card"></div>
					<div class="card mt-1">
						<div class="card-body">
	
							<form method="POST" action="{{ route('password.update') }}">
								@csrf
								
								<input type="hidden" name="token" value="{{ $token }}">
								<input type="hidden" name="email" value="{{ $email }}">

								<div class="mb-3">
									<label for="password" class="form-label">Password Baru</label>
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Masukkan password baru anda" autofocus>
									@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								
								<div class="mb-3">
									<label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Masukkan konfirmasi password baru anda">
								</div>

								<button type="submit" class="btn btn-success d-block mx-auto w-100">
									{{ __('Reset Password') }}
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
