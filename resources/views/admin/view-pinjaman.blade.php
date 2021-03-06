@extends('layouts/app')

@section('content')
	<div class="container">
		<div class="d-flex justify-content-between align-items-center mb-2">
			<h4>Pinjaman</h4>
			<a class="text-secondary user" id="name"></a>
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
								<th class="text-truncate">Tanggal Disetujui</th>
								<th class="text-truncate pr-4"></th>
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
	<div class="modal fade" id="modal-approve" tabindex="-1" aria-hidden="true">
		<div class="modal-sm modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header border-bottom-0">
					<h5 class="modal-title">Setujui Tagihan</h5>
					<div role="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="mdi mdi-close mdi-18px pr-0"></i>
					</div>
				</div>
				<div class="modal-body py-0">
					<span id="approve-body"></span>
					<span class="user">?</span>
				</div>
				<div class="modal-footer border-top-0">
					<div class="btn btn-sm btn-link" data-dismiss="modal">Batal</div>
					<button class="btn btn-sm btn-primary" id="approve">Setujui</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script>const id = '{{Request::route("id")}}'</script>
	<script>const user = '{{Request::route("user")}}'</script>
	<script src="{{asset('assets/js/number.js')}}"></script>
	<script src="{{asset('api/admin/view-pinjaman.js')}}"></script>
@endsection