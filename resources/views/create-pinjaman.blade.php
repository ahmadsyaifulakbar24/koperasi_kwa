@extends('layouts/app')

@section('title','Buat Pinjaman')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-10 offset-xl-2 offset-lg-1">
				<h4 class="pb-2">Buat Pinjaman</h4>
				<div class="card card-custom mb-3">
					<form id="form" class="card-body">
						<div class="form-group row">
							<label for="besar_pinjaman" class="col-lg-4 col-md-5 col-form-label text-secondary">Besar Pinjaman</label>
							<div class="col-lg-8 col-md-7">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Rp</span>
									</div>
									<input type="tel" class="form-control" id="besar_pinjaman" autofocus>
									<div class="invalid-feedback" id="besar_pinjaman-feedback"></div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="tenor" class="col-lg-4 col-md-5 col-form-label text-secondary">Tenor</label>
							<div class="col-lg-8 col-md-7">
								<div class="input-group">
									<input type="tel" class="form-control" id="tenor">
									<div class="input-group-append">
										<span class="input-group-text rounded-right">Bulan</span>
									</div>
									<div class="invalid-feedback" id="tenor-feedback"></div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="offset-lg-4 offset-md-5 col-lg-8 col-md-7 ">
								<button class="btn btn-block btn-primary px-3" id="submit">Hitung Cicilan</button>
							</div>
						</div>
					</form>
				</div>
				<div class="card card-custom hide" id="cicilan">
					<form id="form-cicilan" class="card-body">
						<div class="form-group row">
							<label class="col-lg-4 col-md-5 col-form-label text-secondary">Simulasi Cicilan</label>
							<div class="col-lg-8 col-md-7">
								<div class="bg-light border rounded px-3 pt-3">
									<div class="d-flex justify-content-between form-group">
										<div class="text-secondary">Besar Pinjaman</div>
										<div><b id="besar_pinjaman_cicilan"></b></div>
									</div>
									<div class="d-flex justify-content-between form-group">
										<div class="text-secondary">Cicilan <span id="tenor_cicilan"></span>x</div>
										<div><b id="angsuran_cicilan"></b><span class="text-secondary">/bulan</span></div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="offset-lg-4 offset-md-5 col-lg-8 col-md-7">
								<button class="btn btn-block btn-primary px-3 hide" id="pinjaman">Buat Pinjaman</button>
							</div>
						</div>
					</form>
				</div>
			</div>
	    </div>
	</div>
@endsection

@section('script')
	<script src="{{asset('assets/js/number.js')}}"></script>
	<script src="{{asset('api/create-pinjaman.js')}}"></script>
@endsection