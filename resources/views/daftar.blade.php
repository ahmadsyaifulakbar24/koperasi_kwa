<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Pendaftaran - Koperasi KWA</title>
	<link rel="stylesheet" href="{{asset('assets/vendors/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/auth.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/loader.css')}}">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="auth">
		<div class="card shadow hide" id="data">
			<div class="card-body pb-0">
				<img src="{{asset('assets/images/logo.png')}}" class="pb-2" width="50">
				<h3>Pendaftaran Koperasi KWA</h3>
				<div class="text-secondary">
					<p>Koperasi Karyawan PT. Karl Wig Abadi.<br>
					Ruko Lampu Merah Cikaret (LMC) , Cibinong, Kab Bogor.</p>
				</div>
			</div>
			<div class="dropdown-divider"></div>
			<form id="form">
				<div class="card-body">
					<div class="form-group">
						<label class="font-weight-bold" for="name">Nama Lengkap</label>
						<input type="text" id="name" class="form-control">
						<div class="invalid-feedback" id="name-feedback"></div>
					</div>
					<div class="form-group">
						<label class="font-weight-bold" for="no_id">Nomor Identitas</label>
						<input type="tel" id="no_id" class="form-control" minlength="16" maxlength="16">
						<div class="invalid-feedback" id="no_id-feedback"></div>
					</div>
					<div class="form-group">
						<label class="font-weight-bold mb-0" for="jenis_kelamin">Jenis Kelamin</label>
						<div id="jenis_kelamin">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="jenis_kelamin" id="male" value="laki-laki">
								<label class="form-check-label" for="male" role="button">Laki-Laki</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="jenis_kelamin" id="female" value="perempuan">
								<label class="form-check-label" for="female" role="button">Perempuan</label>
							</div>
						</div>
						<div class="invalid-feedback" id="jenis_kelamin-feedback"></div>
					</div>
					<div class="form-group">
						<label class="font-weight-bold" for="tempat_lahir">Tempat Lahir</label>
						<input type="text" id="tempat_lahir" class="form-control">
						<div class="invalid-feedback" id="tempat_lahir-feedback"></div>
					</div>
					<div class="form-group">
						<label class="font-weight-bold" for="tanggal_lahir">Tanggal Lahir</label>
						<input type="date" id="tanggal_lahir" class="form-control">
						<div class="invalid-feedback" id="tanggal_lahir-feedback"></div>
					</div>
					<div class="form-group">
						<label class="font-weight-bold" for="alamat">Alamat Lengkap</label>
						<textarea id="alamat" class="form-control form-control-sm" rows="3"></textarea>
						<div class="invalid-feedback" id="alamat-feedback"></div>
					</div>
					<div class="form-group">
						<label class="font-weight-bold" for="no_telp">Nomor Telepon</label>
						<input type="tel" id="no_telp" class="form-control">
						<div class="invalid-feedback" id="no_telp-feedback"></div>
					</div>
					<div class="form-group">
						<label class="font-weight-bold mb-0" for="pendidikan_id">Pendidikan Terakhir</label>
						<div id="pendidikan_id"></div>
						<div class="invalid-feedback" id="pendidikan_id-feedback"></div>
					</div>
					<div class="form-group">
						<label class="font-weight-bold mb-0" for="jabatan_id">Jabatan</label>
						<div id="jabatan_id"></div>
						<div class="invalid-feedback" id="jabatan_id-feedback"></div>
					</div>
					<div class="form-group">
						<label class="font-weight-bold mb-0" for="status_keluarga_id">Status Dalam Keluarga</label>
						<div id="status_keluarga_id"></div>
						<div class="invalid-feedback" id="status_keluarga_id-feedback"></div>
					</div>
					<div class="form-group">
						<label class="font-weight-bold" for="nama_ahliwaris">Nama Ahli Waris</label>
						<input type="text" id="nama_ahliwaris" class="form-control">
						<div class="invalid-feedback" id="nama_ahliwaris-feedback"></div>
					</div>
					<!-- <div class="form-group">
						<label for="simpanan_pokok" class="mb-0">Besaran Simpanan Pokok</label>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="simpanan_pokok" id="sp1" value="20000">
							<label class="form-check-label" for="sp1" role="button">Rp20.000</label>
						</div>
						<div class="invalid-feedback" id="simpanan_pokok-feedback"></div>
					</div> -->
					<div class="form-group">
						<label class="font-weight-bold mb-0" for="besar_simpanan_wajib">Besaran Simpanan Wajib</label>
						<small class="form-text text-muted">Simpanan Wajib dibayarakan setiap bulan</small>
						<div id="besar_simpanan_wajib">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="besar_simpanan_wajib" id="s1" value="100000">
								<label class="form-check-label" for="s1" role="button">Rp100.000</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="besar_simpanan_wajib" id="s2" value="50000">
								<label class="form-check-label" for="s2" role="button">Rp50.000</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="besar_simpanan_wajib" id="s3" value="20000">
								<label class="form-check-label" for="s3" role="button">Rp20.000</label>
							</div>
						</div>
						<div class="invalid-feedback" id="besar_simpanan_wajib-feedback"></div>
					</div>
					<div class="form-group">
						<label class="font-weight-bold" for="simpanan_sukarela">Besaran Simpanan Sukarela</label>
						<!-- <small class="form-text text-muted">Simpanan Wajib dibayarakan setiap bulan.</small> -->
						<div class="input-group">
							<div class="input-group-prepend">
								<small class="input-group-text">Rp</small>
							</div>
							<input type="tel" id="simpanan_sukarela" class="form-control rounded-right">
							<div class="invalid-feedback" id="simpanan_sukarela-feedback"></div>
						</div>
					</div>
					<div class="form-group">
						<label class="font-weight-bold mb-0" for="upload_ktp">Foto KTP</label>
						<small class="form-text text-muted mb-2">Sesuai dengan nama pendaftar</small>
						<div id="form-picture">
							<div class="file-group">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="picture" role="button" accept="image/jpeg, image/png">
									<label class="custom-file-label">Pilih Foto</label>
									<div id="picture-feedback" class="invalid-feedback"></div>
								</div>
							</div>
							<div id="loading-picture" class="text-center none">
								<div class="loader loader-sm btn-loading">
									<svg class="circular" viewBox="25 25 50 50">
										<circle class="path-primary" cx="50" cy="50" r="20" fill="none" stroke-width="6" stroke-miterlimit="1"/>
									</svg>
								</div>
							</div>
						</div>
						<div class="invalid-feedback" id="upload_ktp-feedback"></div>
					</div>
					<!-- <div class="form-group">
						<label class="font-weight-bold" for="username">Username</label>
						<input type="text" id="username" class="form-control">
						<div class="invalid-feedback" id="username-feedback"></div>
					</div> -->
					<div class="form-group">
						<label class="font-weight-bold" for="email">Email</label>
						<input type="email" id="email" class="form-control">
						<div class="invalid-feedback" id="email-feedback"></div>
					</div>
					<div class="form-group position-relative">
						<label class="font-weight-bold" for="password">Password</label>
						<input type="password" id="password" class="form-control pr-5" minlength="8" maxlength="32" autocomplete="on">
						<i class="password mdi mdi-eye-off mdi-18px" data-id="password"></i>
						<div class="invalid-feedback" id="password-feedback"></div>
					</div>
					<div class="form-group position-relative">
						<label class="font-weight-bold" for="cpassword">Konfirmasi Password</label>
						<input type="password" id="cpassword" class="form-control pr-5" minlength="8" maxlength="32" autocomplete="on">
						<i class="password mdi mdi-eye-off mdi-18px" data-id="cpassword"></i>
						<div class="invalid-feedback" id="cpassword-feedback"></div>
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-block mt-5" id="submit">Daftar</button>
					</div>
					<div class="dropdown-divider my-4"></div>
					<a href="{{url('/')}}" class="btn btn-block btn-outline-primary mb-4">Login</a>
				</div>
			</form>
		</div>
		<div class="d-flex flex-column justify-content-center align-items-center state" id="loading">
			<div class="loader">
				<svg class="circular" viewBox="25 25 50 50">
					<circle class="path-primary" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
				</svg>
			</div>
		</div>
	</div>
	@include('layouts.partials.script')
	<script src="{{asset('assets/js/file.js')}}"></script>
	<script src="{{asset('assets/js/number.js')}}"></script>
	<script src="{{asset('api/daftar.js')}}"></script>
</body>
</html>