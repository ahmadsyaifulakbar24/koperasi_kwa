@extends('layouts/app')

@section('content')
	<div class="container">
		<div class="d-flex justify-content-between align-items-center mb-2">
			<h4>Pinjaman</h4>
			<div class="ml-auto mb-1">
				<div class="form-control form-control-sm" role="button" data-toggle="modal" data-target="#modal-filter">
					Filter <i class="mdi mdi-chevron-down pr-0 pl-1"></i>
				</div>
			</div>
		</div>
		<div class="card card-custom">
			<div class="card-header border-bottom-0">
				<div class="d-flex align-items-center">
					<div class="text-secondary user text-capitalize"></div>
				</div>
			</div>
			<div class="table-custom">
				<div class="table-responsive">
					<table class="table table-middle mb-0">
						<thead class="thead-blue">
							<tr>
								<th class="text-truncate">No.</th>
								<th class="text-truncate">Besar Pinjaman</th>
								<th class="text-truncate">Tenor</th>
								<th class="text-truncate">Angsuran</th>
								<th class="text-truncate">Status</th>
								<th class="text-truncate">Tanggal Disetujui</th>
								<th class="text-truncate">Kontrak Pinjaman</th>
								<th class="text-truncate">Tanggal Lunas</th>
								<th class="text-truncate"></th>
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
						<label for="status" class="mb-0">Status</label>
						<div id="status">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="status" id="s1" value="" checked>
								<label class="form-check-label" for="s1" role="button">Semua status</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="status" id="s2" value="pending">
								<label class="form-check-label" for="s2" role="button">Pending</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="status" id="s3" value="approved">
								<label class="form-check-label" for="s3" role="button">Disetujui</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="status" id="s4" value="rejected">
								<label class="form-check-label" for="s4" role="button">Ditolak</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="status" id="s5" value="paid_off">
								<label class="form-check-label" for="s5" role="button">Lunas</label>
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
	<div class="modal fade" id="modal-approve" tabindex="-1" aria-hidden="true">
		<div class="modal-sm modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header border-bottom-0">
					<h5 class="modal-title">Setujui Pinjaman</h5>
					<div role="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="mdi mdi-close mdi-18px pr-0"></i>
					</div>
				</div>
				<div class="modal-body py-0">
					Anda yakin setujui pinjaman
					<span class="user"></span>
					<span id="approve-body"></span>
				</div>
				<div class="modal-footer border-top-0">
					<div class="btn btn-sm btn-link" data-dismiss="modal">Batal</div>
					<button class="btn btn-sm btn-primary" id="approve">Setujui</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-reject" tabindex="-1" aria-hidden="true">
		<div class="modal-sm modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header border-bottom-0">
					<h5 class="modal-title">Tolak Pinjaman</h5>
					<div role="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="mdi mdi-close mdi-18px pr-0"></i>
					</div>
				</div>
				<div class="modal-body py-0">
					Anda yakin tolak pinjaman
					<span class="user"></span>
					<span id="reject-body"></span>
				</div>
				<div class="modal-footer border-top-0">
					<div class="btn btn-sm btn-link" data-dismiss="modal">Batal</div>
					<button class="btn btn-sm btn-primary" id="reject">Tolak</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-contract" tabindex="-1" aria-hidden="true">
		<div class="modal-sm modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header border-bottom-0">
					<h5 class="modal-title">Upload Kontrak</h5>
					<div role="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="mdi mdi-close mdi-18px pr-0"></i>
					</div>
				</div>
				<form id="form">
					<div class="modal-body py-0" id="paid-off-body">
						<div class="form-group">
							<div id="form-picture">
								<div class="file-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input pdf" id="picture" role="button" accept="application/pdf">
										<label class="custom-file-label">Pilih File</label>
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
							<div id="contract-feedback" class="invalid-feedback">Format file wajib berupa PDF</div>
						</div>
					</div>
					<div class="modal-footer border-top-0">
						<div class="btn btn-sm btn-link" data-dismiss="modal">Batal</div>
						<button class="btn btn-sm btn-primary" id="submit">Upload</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script>const id = '{{Request::route("id")}}'</script>
	<script src="{{asset('assets/js/file.js')}}"></script>
	<script src="{{asset('assets/js/number.js')}}"></script>
	<script src="{{asset('api/admin/pinjaman.js')}}"></script>
@endsection