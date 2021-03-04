<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Login - Koperasi KWA</title>
	<link rel="stylesheet" href="{{asset('assets/vendors/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/auth.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/loader.css')}}">
</head>
<body>
	<div class="auth mb-0">
		<div class="card shadow">
			<div class="card-head text-center px-4 pt-4">
				<img src="{{asset('assets/images/logo.png')}}" width="70">
				<h2 class="pt-3">Koperasi KWA</h2>
				<p class="text-secondary">PT. Karl Wig Abadi</p>
			</div>
			<div class="card-body">
				<form id="form">
					<div class="alert alert-danger none" role="alert">
						<i class="mdi mdi-close-circle"></i>Email atau Password salah
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" id="email" class="form-control" autofocus="autofocus">
					</div>
					<div class="form-group position-relative">
						<label for="password">Password</label>
						<input type="password" id="password" class="form-control pr-5" maxlength="32" autocomplete="on">
						<i class="password mdi mdi-eye-off mdi-18px" data-id="password"></i>
					</div>
					<div class="form-group mt-4">
						<button class="btn btn-primary btn-block" id="submit">Login</button>
					</div>
				</form>
				<div class="dropdown-divider my-4"></div>
				<a href="{{url('daftar')}}" class="btn btn-block btn-outline-primary mb-4">Daftar Koperasi</a>
			</div>
		</div>
	</div>
	@include('layouts.partials.script')
	<script src="{{asset('api/login.js')}}"></script>
</body>
</html>