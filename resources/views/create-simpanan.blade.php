@extends('layouts/app')

@section('title','Tambah Simpanan Sukarela')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-10 offset-xl-2 offset-lg-1">
				<h4 class="pb-2">Tambah Simpanan Sukarela</h4>
				<div class="card card-custom">
					<form id="form" class="card-body">
						<div class="form-group row">
							<label for="title" class="col-lg-4 col-sm-5 col-form-label text-secondary">Judul</label>
							<div class="col-lg-8 col-sm-7">
								<input class="form-control" id="title" autofocus>
								<div class="invalid-feedback" id="title-feedback"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="message" class="col-lg-4 col-sm-5 col-form-label text-secondary">Pesan</label>
							<div class="col-lg-8 col-sm-7">
								<textarea class="form-control form-control-sm" id="message" rows="3"></textarea>
								<div class="invalid-feedback" id="message-feedback"></div>
							</div>
						</div>
						<div id="data"></div>
						<div class="row">
							<div class="offset-lg-4 offset-md-5 col-lg-8 col-md-7 mt-3">
								<div class="form-group">
									<!-- <div class="btn btn-md btn-block btn-outline-primary position-relative" id="item">
										<i class="position-absolute mdi mdi-plus mdi-18px" style="left:10px;top:5px"></i>Tambah
									</div> -->
									<button class="btn btn-block btn-primary px-3" id="submit">Tambah Simpanan Sukarela</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
	    </div>
	</div>
@endsection

@section('script')
	<script src="{{asset('assets/js/file.js')}}"></script>
	<script src="{{asset('assets/js/number.js')}}"></script>
	<script src="{{asset('api/create-simpanan.js')}}"></script>
@endsection