@extends('layouts/app')

@section('title','Pinjaman')

@section('content')
	<div class="container">
		<div class="d-flex justify-content-between align-items-center mb-2">
			<h4>Pinjaman</h4>
			<div class="btn btn-sm btn-primary paid-off hide" data-toggle="modal" data-target="#modal-paid-off">Lunasi Pinjaman</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-lg-5 col-xl-4 mb-4">
				<div class="card card-custom">
					<div class="card-body">
						<h6>Besar Pinjaman</h6>
						<div class="d-flex justify-content-between align-items-center position-relative">
							<i class="mdi mdi-notebook-outline mdi-36px"></i>
							<h4 class="mb-0" id="besar_pinjaman">
								<div class="loader loader-sm btn-loading">
									<svg class="circular" viewBox="25 25 50 50">
										<circle class="path-dark" cx="50" cy="50" r="20" fill="none" stroke-width="6" stroke-miterlimit="1"/>
									</svg>
								</div>
							</h4>
							<div class="notification none"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-5 col-xl-4 mb-4">
				<div class="card card-custom">
					<div class="card-body">
						<h6>Tenor</h6>
						<div class="d-flex justify-content-between align-items-center position-relative">
							<i class="mdi mdi-clock-outline mdi-36px"></i>
							<h4 class="mb-0" id="tenor">
								<div class="loader loader-sm btn-loading">
									<svg class="circular" viewBox="25 25 50 50">
										<circle class="path-dark" cx="50" cy="50" r="20" fill="none" stroke-width="6" stroke-miterlimit="1"/>
									</svg>
								</div>
							</h4>
							<div class="notification none"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-5 col-xl-4 mb-4">
				<div class="card card-custom">
					<div class="card-body">
						<h6>Sisa Angsuran</h6>
						<div class="d-flex justify-content-between align-items-center position-relative">
							<i class="mdi mdi-notebook-outline mdi-36px"></i>
							<h4 class="mb-0" id="sisa_angsuran">
								<div class="loader loader-sm btn-loading">
									<svg class="circular" viewBox="25 25 50 50">
										<circle class="path-dark" cx="50" cy="50" r="20" fill="none" stroke-width="6" stroke-miterlimit="1"/>
									</svg>
								</div>
							</h4>
							<div class="notification none"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-7 col-xl-8 mb-4">
				<div class="card card-custom card-height">
					<div class="card-body d-flex align-items-center">
						<div class="font-italic text-uppercase text-secondary">
							<div class="font-weight-bold">Untuk pembayaran ke rekening bendahara</div>
							<div>Mandiri: 1330015140981</div>
							<div>Atas nama Robertus Sulistyo Ardi</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card card-custom">
			<div class="card-header border-bottom-0">
				<div class="d-flex align-items-center">
					<b>Tagihan</b>
				</div>
			</div>
			<div class="table-custom">
				<div class="table-responsive">
					<table class="table table-middle mb-0">
						<thead class="thead-blue">
							<tr>
								<th class="text-truncate pl-4">No.</th>
								<th class="text-truncate">Judul</th>
								<th class="text-truncate">Bulan</th>
								<th class="text-truncate">Total Bayar</th>
								<th class="text-truncate">Bukti Pembayaran</th>
								<th class="text-truncate pr-4">Tanggal Disetujui</th>
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
		</div>
	</div>
	<div class="modal fade" id="modal-paid-off" tabindex="-1" aria-hidden="true">
		<div class="modal-sm modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header border-bottom-0">
					<h5 class="modal-title">Lunasi Pinjaman</h5>
					<div role="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="mdi mdi-close mdi-18px pr-0"></i>
					</div>
				</div>
				<form id="form">
					<div class="modal-body py-0" id="paid-off-body">
						<div class="form-group">
							<label for="hutang_pokok" class="col-form-label text-secondary">Sisa Angsuran</label>
							<div class="" id="hutang_pokok"></div>
						</div>
						<div class="form-group">
							<label for="bunga" class="col-form-label text-secondary">Bunga</label>
							<div class="" id="bunga"></div>
						</div>
						<div class="form-group">
							<label for="total_bayar" class="col-form-label text-secondary">Total Bayar</label>
							<div class="font-weight-bold " id="total_bayar"></div>
						</div>
						<div class="form-group">
							<label for="bukti_pembayaran" class="col-form-label text-secondary mb-0">Bukti Pembayaran</label>
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
							<div class="invalid-feedback" id="bukti_pembayaran-feedback"></div>
						</div>
					</div>
					<div class="modal-footer border-top-0">
						<div class="btn btn-sm btn-link" data-dismiss="modal">Batal</div>
						<button class="btn btn-sm btn-primary" id="submit">Lunasi</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script>const id = '{{Request::route("id")}}'</script>
	<script src="{{asset('assets/js/number.js')}}"></script>
	<script src="{{asset('assets/js/file.js')}}"></script>
	<script src="{{asset('api/view-pinjaman.js')}}"></script>
@endsection