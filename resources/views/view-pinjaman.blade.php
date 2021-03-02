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
		</div>
		<div class="card card-custom">
			<div class="card-header border-bottom-0">
				<div class="d-flex align-items-center">
					<b>Invoice</b>
					<div class="ml-auto">
						<div class="form-control form-control-sm" role="button" data-toggle="modal" data-target="#modal-filter">
							Filter <i class="mdi mdi-chevron-down pr-0 pl-1"></i>
						</div>
					</div>
					<!-- <div class="position-relative">
						<i class="mdi mdi-close-circle position-absolute hide px-2" id="search-close" role="button" style="right: 0;padding: 5px 0"></i>
						<input class="form-control form-control-sm pr-4" placeholder="Cari..." id="search" autocomplete="off">
					</div> -->
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
			<div class="card-footer hide" id="pagination">
				<div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
					<small class="text-secondary pb-3 pb-md-0" id="pagination-label"></small>
					<nav>
						<ul class="pagination pagination-sm mb-0" data-filter="request">
							<li class="page_transaction page-item disabled" id="first">
								<span class="page-link"><i class="mdi mdi-chevron-double-left"></i></span>
							</li>
							<li class="page_transaction page-item disabled" id="prev">
								<span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
							</li>
							<li class="page_transaction page-item" id="prevCurrentDouble"><span class="page-link"></span></li>
							<li class="page_transaction page-item" id="prevCurrent"><span class="page-link"></span></li>
							<li class="page_transaction page-item" id="current"><span class="page-link"></span></li>
							<li class="page_transaction page-item" id="nextCurrent"><span class="page-link"></span></li>
							<li class="page_transaction page-item" id="nextCurrentDouble"><span class="page-link"></span></li>
							<li class="page_transaction page-item" id="next">
								<span class="page-link"><i class="mdi mdi-chevron-right"></i></span>
							</li>
							<li class="page_transaction page-item" id="last">
								<span class="page-link"><i class="mdi mdi-chevron-double-right"></i></span>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-filter" tabindex="-1" aria-hidden="true">
		<div class="modal-sm modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header border-bottom-0">
					<h5 class="modal-title">Filter</h5>
					<div role="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="mdi mdi-close mdi-18px pr-0"></i>
					</div>
				</div>
				<div class="modal-body py-0">
					<div class="form-group">
						<label class="d-block" for="approved">Cari berdasarkan</label>
						<select class="custom-select custom-select-sm" id="filter_by" role="button">
							<option value="">Semua tanggal</option>
							<option value="date">Tanggal</option>
							<option value="month">Bulan</option>
							<option value="year">Tahun</option>
						</select>
					</div>
					<div class="form-group none">
						<label for="date">Tanggal</label>
						<input type="date" class="form-control form-control-sm" min="2021-01-01" id="date" role="button">
					</div>
					<div class="form-group none">
						<label for="month">Bulan</label>
						<input type="month" class="form-control form-control-sm" min="2021-01" id="month" role="button">
					</div>
					<div class="form-group none">
						<label for="year">Tahun</label>
						<select class="custom-select custom-select-sm" id="year">
							<option value="2021">2021</option>
						</select>
					</div>
					<div class="form-group">
						<label for="approved" class="mb-0">Status</label>
						<div id="approved">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="approved" id="s1" value="" checked>
								<label class="form-check-label" for="s1" role="button">Semua status</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="approved" id="s2" value="false">
								<label class="form-check-label" for="s2" role="button">Pending</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="approved" id="s3" value="true">
								<label class="form-check-label" for="s3" role="button">Disetujui</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer border-top-0">
					<div class="btn btn-sm btn-link" data-dismiss="modal">Batal</div>
					<button class="btn btn-sm btn-primary" id="filter">Terapkan</button>
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