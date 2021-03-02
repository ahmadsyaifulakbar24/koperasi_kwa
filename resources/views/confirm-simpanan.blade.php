@extends('layouts/app')

@section('title','Konfirmasi Simpanan')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-10 offset-xl-2 offset-lg-1">
				<h4 class="pb-2">Konfirmasi Simpanan</h4>
				<div class="card card-custom hide" id="data">
					<form id="form" class="card-body">
						<div class="form-group row">
							<label for="title" class="col-lg-4 col-md-5 col-form-label text-secondary">Judul</label>
							<div class="col-lg-8 col-md-7">
								<div class="mt-md-2 mt-0" id="title"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="message" class="col-lg-4 col-md-5 col-form-label text-secondary">Pesan</label>
							<div class="col-lg-8 col-md-7">
								<div class="mt-md-2 mt-0" id="message"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="sub_transaction" class="col-lg-4 col-md-5 col-form-label text-secondary">Pembayaran</label>
							<div class="col-lg-8 col-md-7">
								<div class="mt-md-2 mt-0">
									<ul class="pl-3 mb-0" id="sub_transaction"></ul>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="total_sub_transaction" class="col-lg-4 col-md-5 col-form-label text-secondary">Total Bayar</label>
							<div class="col-lg-8 col-md-7">
								<div class="font-weight-bold mt-md-2 mt-0" id="total_sub_transaction"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="bukti_pembayaran" class="col-lg-4 col-md-5 col-form-label text-secondary mb-0">Bukti Pembayaran</label>
							<div id="form-picture" class="col-lg-8 col-md-7">
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
						<div class="form-group row">
							<div class="offset-lg-4 offset-md-5 col-lg-8 col-md-7">
								<button class="btn btn-block btn-primary px-3" id="submit">Kirim</button>
							</div>
						</div>
					</form>
				</div>
				<div class="d-flex flex-column justify-content-center align-items-center state" id="loading_data">
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
	<script>const level = '{{Request::route("level")}}'</script>
	<script>const user = '{{Request::route("user")}}'</script>
	<script>const id = '{{Request::route("id")}}'</script>
	<script src="{{asset('assets/js/number.js')}}"></script>
	<script src="{{asset('assets/js/file.js')}}"></script>
	<script src="{{asset('api/confirm-simpanan.js')}}"></script>
@endsection