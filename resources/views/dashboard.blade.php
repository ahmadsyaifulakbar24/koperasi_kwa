@extends('layouts/app')

@section('title','Dashboard')

@section('content')
	<div class="container">
		<div class="d-flex justify-content-between align-items-center mb-2">
			<h4>Dashboard</h4>
		</div>
		@if(session("level") == 1 || session("level") == 100)
		<div class="row">
			<div class="col-md-6 col-xl-4 mb-4">
				<div class="card card-custom">
					<div class="card-body">
						<h6>Saldo Koperasi</h6>
						<div class="d-flex justify-content-between align-items-center position-relative">
							<i class="mdi mdi-wallet-outline mdi-36px"></i>
							<h4 class="mb-0" id="saldo">
								<div class="loader loader-sm btn-loading">
									<svg class="circular" viewBox="25 25 50 50">
										<circle class="path-dark" cx="50" cy="50" r="20" fill="none" stroke-width="6" stroke-miterlimit="1"/>
									</svg>
								</div>
							</h4>
							<div class="notification none"></div>
						</div>
					</div>
					<div class="card-footer container text-primary" style="height: 48px">
						<div class="row">
							<div class="col" data-toggle="modal" data-target="#modal-add" role="button">
								<i class="mdi mdi-plus"></i>Tambah saldo
							</div>
	
							<div class="col" data-toggle="modal" data-target="#modal-min" role="button">
								<i class="mdi mdi-minus"></i>Kurangi saldo
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-xl-4 mb-4">
				<div class="card card-custom">
					<div class="card-body">
						<h6>Total Debit</h6>
						<div class="d-flex justify-content-between align-items-center position-relative">
							<i class="mdi mdi-credit-card-outline mdi-36px"></i>
							<h4 class="mb-0" id="debit">
								<div class="loader loader-sm btn-loading">
									<svg class="circular" viewBox="25 25 50 50">
										<circle class="path-dark" cx="50" cy="50" r="20" fill="none" stroke-width="6" stroke-miterlimit="1"/>
									</svg>
								</div>
							</h4>
							<div class="notification none"></div>
						</div>
					</div>
					<div class="card-footer d-flex justify-content-center text-primary" id="download_debit" role="button" style="height: 48px">
						<div id="text_debit"><i class="mdi mdi-arrow-down"></i>Unduh debit</div>
						<div class="d-flex flex-column justify-content-center align-items-center hide" id="loading_debit">
							<div class="loader loader-sm">
								<svg class="circular" viewBox="25 25 50 50">
									<circle class="path-primary" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
								</svg>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-xl-4 mb-4">
				<div class="card card-custom">
					<div class="card-body">
						<h6>Total Kredit</h6>
						<div class="d-flex justify-content-between align-items-center position-relative">
							<i class="mdi mdi-credit-card-outline mdi-36px"></i>
							<h4 class="mb-0" id="kredit">
								<div class="loader loader-sm btn-loading">
									<svg class="circular" viewBox="25 25 50 50">
										<circle class="path-dark" cx="50" cy="50" r="20" fill="none" stroke-width="6" stroke-miterlimit="1"/>
									</svg>
								</div>
							</h4>
							<div class="notification none"></div>
						</div>
					</div>
					<div class="card-footer d-flex justify-content-center text-primary" id="download_kredit" role="button" style="height: 48px">
						<div id="text_kredit"><i class="mdi mdi-arrow-down"></i>Unduh kredit</div>
						<div class="d-flex flex-column justify-content-center align-items-center hide" id="loading_kredit">
							<div class="loader loader-sm">
								<svg class="circular" viewBox="25 25 50 50">
									<circle class="path-primary" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
								</svg>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="d-flex justify-content-between align-items-center mb-2">
			<h4>History</h4>
		</div>
		<div class="card card-custom">
			<div class="table-custom">
				<div class="table-responsive">
					<table class="table table-middle mb-0">
						<thead class="thead-blue">
							<tr>
								<th class="text-truncate">No.</th>
								<th class="text-truncate">Keterangan</th>
								<th class="text-truncate">Jumlah</th>
								<th class="text-truncate">Tanggal</th>
							</tr>
						</thead>
						<tbody id="table"></tbody>
						<tbody id="loading_table">
							<tr>
								<td colspan="10" class="text-center">
									<div class="loader loader-sm btn-loading">
									<svg class="circular" viewBox="25 25 50 50">
										<circle class="path-dark" cx="50" cy="50" r="20" fill="none" stroke-width="6" stroke-miterlimit="1"/>
									</svg>
								</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer hide" id="pagination">
				<div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
					<small class="text-secondary pb-3 pb-md-0" id="pagination-label"></small>
					<nav>
						<ul class="pagination pagination-sm mb-0" data-filter="request">
							<li class="page page-item disabled" id="first">
								<span class="page-link"><i class="mdi mdi-chevron-double-left"></i></span>
							</li>
							<li class="page page-item disabled" id="prev">
								<span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
							</li>
							<li class="page page-item" id="prevCurrentDouble"><span class="page-link"></span></li>
							<li class="page page-item" id="prevCurrent"><span class="page-link"></span></li>
							<li class="page page-item" id="current"><span class="page-link"></span></li>
							<li class="page page-item" id="nextCurrent"><span class="page-link"></span></li>
							<li class="page page-item" id="nextCurrentDouble"><span class="page-link"></span></li>
							<li class="page page-item" id="next">
								<span class="page-link"><i class="mdi mdi-chevron-right"></i></span>
							</li>
							<li class="page page-item" id="last">
								<span class="page-link"><i class="mdi mdi-chevron-double-right"></i></span>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal-add" tabindex="-1" aria-hidden="true">
			<div class="modal-sm modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header border-bottom-0">
						<h5 class="modal-title">Tambah Saldo</h5>
						<div role="button" class="close" data-dismiss="modal" aria-label="Close">
							<i class="mdi mdi-close mdi-18px pr-0"></i>
						</div>
					</div>
					<form id="add_saldo">
						<div class="modal-body py-0">
							<div class="form-group">
								<!-- <label for="besaran">Besaran</label> -->
								<div class="input-group mt-2">
									<div class="input-group-prepend">
										<small class="input-group-text">Rp</small>
									</div>
									<input type="tel" id="besaran" class="form-control rounded-right">
									<div class="invalid-feedback" id="besaran-feedback"></div>
								</div>
							</div>
						</div>
						<div class="modal-footer border-top-0">
							<div class="btn btn-sm btn-link" data-dismiss="modal">Batal</div>
							<button class="btn btn-sm btn-primary" id="add">Tambah</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal-min" tabindex="-1" aria-hidden="true">
			<div class="modal-sm modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header border-bottom-0">
						<h5 class="modal-title">Kurangi Saldo</h5>
						<div role="button" class="close" data-dismiss="modal" aria-label="Close">
							<i class="mdi mdi-close mdi-18px pr-0"></i>
						</div>
					</div>
					<form id="min_saldo">
						<div class="modal-body py-0">
							<div class="form-group">
								<!-- <label for="besaran">Besaran</label> -->
								<div class="input-group mt-2">
									<div class="input-group-prepend">
										<small class="input-group-text">Rp</small>
									</div>
									<input type="tel" id="minSaldo" class="form-control rounded-right">
									<div class="invalid-feedback" id="minSaldo-feedback"></div>
								</div>
								<div class="form-group mt-2">
									<label for="description">keterangan</label>
									<textarea class="form-control" id="description" rows="3"></textarea>
									<div class="invalid-feedback" id="description-feedback"></div>
								  </div>
							</div>
						</div>
						<div class="modal-footer border-top-0">
							<div class="btn btn-sm btn-link" data-dismiss="modal">Batal</div>
							<button class="btn btn-sm btn-primary" id="min">Kurangi</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="none">
			<table id="table_debit" border="1"></table>
			<table id="table_kredit" border="1"></table>
		</div>
		@elseif(session("level") == 101)
		<div class="row">
			<div class="col-6 col-md-4 col-xl-3 mb-4">
				<a href="{{url('simpanan')}}">
					<div class="card card-custom">
						<div class="card-body">
							<h6>Simpanan</h6>
							<div class="d-flex justify-content-between align-items-center position-relative">
								<i class="mdi mdi-wallet-outline mdi-36px"></i>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-6 col-md-4 col-xl-3 mb-4">
				<a href="{{url('pinjaman')}}">
					<div class="card card-custom">
						<div class="card-body">
							<h6>Pinjaman</h6>
							<div class="d-flex justify-content-between align-items-center position-relative">
								<i class="mdi mdi-notebook-outline mdi-36px"></i>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="row hide" id="biodata">
			<div class="col-xl-8 col-lg-10 order-1">
				<div class="card card-custom">
					<form id="form" class="card-body">
						<div class="form-group row">
							<label for="name" class="col-lg-4 col-sm-5 col-form-label">Nama Lengkap</label>
							<div class="col-lg-8 col-sm-7">
								<input class="form-control" id="name">
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
								<img id="ktp" class="rounded img-fluid">
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
			</div>
			<!-- <div class="col-lg-4 order-lg-1 mb-4 mb-lg-0">
				<div class="card card-custom">
					<div class="card-body text-center">
						<div class="d-inline-block py-4" data-toggle="modal" data-target="#modalAvatar" role="button">
							<img src="{{asset('assets/images/user.png')}}" class="avatar rounded-circle" width="100"><br>
						</div>
					</div>
				</div>
			</div> -->
	    </div>
		<div class="d-flex flex-column justify-content-center align-items-center state" id="loading-biodata">
			<div class="loader">
				<svg class="circular" viewBox="25 25 50 50">
					<circle class="path-primary" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
				</svg>
			</div>
		</div>
		@endif
	</div>
@endsection

@section('script')
	<script src="{{asset('assets/js/number.js')}}"></script>
	<script src="{{asset('assets/js/exportCsv.js')}}"></script>
	<script src="{{asset('api/dashboard.js')}}"></script>
	@if(session("level") == 1 || session("level") == 100)
	<script src="{{asset('api/admin/history.js')}}"></script>
	@endif
@endsection