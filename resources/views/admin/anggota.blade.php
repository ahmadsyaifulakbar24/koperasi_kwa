@extends('layouts/app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="offset-lg-1 offset-xl-2 col-lg-10 col-xl-8 order-1">
				<h4>Anggota</h4>
				<div class="card card-custom hide" id="data">
					<form id="form" class="card-body">
						<div class="form-group row">
							<label for="name" class="col-lg-4 col-sm-5 col-form-label">Nama Lengkap</label>
							<div class="col-lg-8 col-sm-7">
								<input class="form-control text-capitalize" id="name">
								<div class="invalid-feedback" id="name-feedback"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="no_id" class="col-lg-4 col-sm-5 col-form-label">Nomor Identitas</label>
							<div class="col-lg-8 col-sm-7">
								<input type="tel" id="no_id" class="form-control" disabled>
							</div>
						</div>
						<div class="form-group row">
							<label for="code" class="col-lg-4 col-sm-5 col-form-label">NIK</label>
							<div class="col-lg-8 col-sm-7">
								<input type="tel" id="code" class="form-control" disabled>
							</div>
						</div>
						<div class="form-group row">
							<label for="jenis_kelamin" class="col-lg-4 col-sm-5 col-form-label pb-0">Jenis Kelamin</label>
							<div class="col-lg-8 col-sm-7">
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
						</div>
						<div class="form-group row">
							<label for="tempat_lahir" class="col-lg-4 col-sm-5 col-form-label">Tempat Lahir</label>
							<div class="col-lg-8 col-sm-7">
								<input type="text" id="tempat_lahir" class="form-control">
								<div class="invalid-feedback" id="tempat_lahir-feedback"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="tanggal_lahir" class="col-lg-4 col-sm-5 col-form-label">Tanggal Lahir</label>
							<div class="col-lg-8 col-sm-7">
								<input type="date" id="tanggal_lahir" class="form-control">
								<div class="invalid-feedback" id="tanggal_lahir-feedback"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="alamat" class="col-lg-4 col-sm-5 col-form-label">Alamat Lengkap</label>
							<div class="col-lg-8 col-sm-7">
								<textarea id="alamat" class="form-control form-control-sm" rows="3"></textarea>
								<div class="invalid-feedback" id="alamat-feedback"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="no_telp" class="col-lg-4 col-sm-5 col-form-label">Nomor Telepon</label>
							<div class="col-lg-8 col-sm-7">
								<input type="tel" id="no_telp" class="form-control">
								<div class="invalid-feedback" id="no_telp-feedback"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="pendidikan_id" class="col-lg-4 col-sm-5 col-form-label pb-0">Pendidikan Terakhir</label>
							<div class="col-lg-8 col-sm-7">
								<div id="pendidikan_id"></div>
								<div class="invalid-feedback" id="pendidikan_id-feedback"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="jabatan_id" class="col-lg-4 col-sm-5 col-form-label pb-0">Jabatan</label>
							<div class="col-lg-8 col-sm-7">
								<div id="jabatan_id"></div>
								<div class="invalid-feedback" id="jabatan_id-feedback"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="status_keluarga_id" class="col-lg-4 col-sm-5 col-form-label pb-0">Status Dalam Keluarga</label>
							<div class="col-lg-8 col-sm-7">
								<div id="status_keluarga_id"></div>
								<div class="invalid-feedback" id="status_keluarga_id-feedback"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="nama_ahliwaris" class="col-lg-4 col-sm-5 col-form-label">Nama Ahli Waris</label>
							<div class="col-lg-8 col-sm-7">
								<input type="text" id="nama_ahliwaris" class="form-control">
								<div class="invalid-feedback" id="nama_ahliwaris-feedback"></div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-4 col-sm-5">
								<label for="besar_simpanan_wajib" class="mb-0">Besaran Simpanan Wajib</label>
								<small class="form-text text-muted">Simpanan Wajib dibayarakan setiap bulan</small>
							</div>
							<div class="col-lg-8 col-sm-7">
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
						</div>
						<div class="form-group row">
							<label for="ktp" class="col-lg-4 col-sm-5 col-form-label">Foto KTP</label>
							<div class="col-lg-8 col-sm-7">
								<div id="form-picture">
									<div class="file-group" id="nullfile">
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="picture" role="button" accept="image/jpeg, image/png">
											<label class="custom-file-label">Pilih Foto</label>
											<div id="picture-feedback" class="invalid-feedback"></div>
										</div>
									</div>
									<div class="file-group mt-2" id="existfile">
										<div class="staging-file d-flex align-items-center border rounded-top pr-0">
											<div class="d-flex align-items-center text-truncate w-100">
												<i class="mdi mdi-18px mdi-image-outline px-2"></i>
												<small class="text-truncate" id="filename"></small>
											</div>
											<i class="mdi mdi-close mdi-staging ml-auto pl-2 py-2" role="button"></i>
										</div>
										<img id="ktp" class="border-right border-bottom border-left rounded-bottom w-100">
									</div>
									<div id="loading-picture" class="text-center none">
										<div class="loader loader-sm btn-loading">
											<svg class="circular" viewBox="25 25 50 50">
												<circle class="path-primary" cx="50" cy="50" r="20" fill="none" stroke-width="6" stroke-miterlimit="1"/>
											</svg>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-lg-4 col-sm-5 col-form-label">Email</label>
							<div class="col-lg-8 col-sm-7">
								<input type="email" class="form-control" id="email" disabled>
							</div>
						</div>
						<!-- <div class="form-group row">
							<label for="username" class="col-lg-4 col-sm-5 col-form-label">Username</label>
							<div class="col-lg-8 col-sm-7">
								<input class="form-control" id="username" disabled>
							</div>
						</div> -->
						<div class="form-group row">
							<div class="offset-lg-4 offset-sm-5 col-lg-8 col-sm-7">
								<button class="btn btn-block btn-primary px-3" id="submit">Simpan</button>
							</div>
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
		</div>
	</div>
@endsection

@section('script')
	<script>const id = '{{Request::route("id")}}'</script>
	<script src="{{asset('assets/js/file.js')}}"></script>
	<script src="{{asset('api/admin/anggota.js')}}"></script>
@endsection