@extends('layouts/app')

@section('title','Anggota')

@section('content')
	<div class="container">
		<div class="d-flex justify-content-between align-items-center mb-2">
			<h4>Anggota</h4>
			<div class="position-relative mb-1">
				<i class="mdi mdi-close-circle position-absolute hide px-2" id="search-close" role="button" style="right: 0;padding: 5px 0"></i>
				<input class="form-control form-control-sm pr-4" placeholder="Cari Anggota" id="search" autocomplete="off">
			</div>
		</div>
		<div class="card card-custom">
			<div class="table-custom">
				<div class="table-responsive">
					<table class="table mb-0">
						<thead>
							<tr>
								<th class="text-center">No.</th>
								<th class="text-truncate">Nama</th>
								<th class="text-truncate"></th>
							</tr>
						</thead>
						<tbody id="table"></tbody>
						<tbody id="loading_table">
							<tr>
								<td colspan="7" class="text-center">
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
@endsection

@section('script')
	<script src="{{asset('api/admin/user-anggota.js')}}"></script>
@endsection