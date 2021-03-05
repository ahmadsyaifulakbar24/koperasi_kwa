<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title') - Koperasi KWA</title>
	<link rel="stylesheet" href="{{asset('assets/vendors/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/loader.css')}}">
	@yield('style')
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom">
        <div class="form-inline">
            <i class="mdi mdi-menu mdi-24px d-block d-lg-none pointer text-dark mr-2" id="menu"></i>
            <a class="navbar-brand d-none d-lg-block" href="{{url('dashboard')}}">
				<img src="{{asset('assets/images/logo.png')}}" width="30" class="d-inline-block align-top mr-2" alt="Logo" loading="lazy">
            	Koperasi KWA
            </a>
        </div>
        <div class="dropdown ml-auto">
            <a id="dropdownMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            	<img src="{{asset('assets/images/user.png')}}" class="avatar rounded-circle" width="25">
            </a>
            <div class="dropdown-menu dropdown-menu-right rounded border-0" aria-labelledby="dropdownMenu">
            	<!-- <div class="text-center my-3 px-3 text-break">
	            	<img src="{{asset('assets/images/photo.png')}}" class="avatar rounded-circle" width="75">
	            	<h6 class="name text-truncate pt-3 mb-0"></h6>
	            	<small class="level text-secondary"></small>
	            </div> -->
            	<div class="dropdown-item d-flex align-items-center">
	            	<img src="{{asset('assets/images/user.png')}}" class="avatar rounded-circle align-self-center" width="50">
	            	<div class="ml-3 text-truncate">
		            	<div class="name text-truncate"></div>
		            	<!-- <div class="small text-secondary">Ubah profil</div> -->
		            </div>
	            </div>
	            <div class="dropdown-divider"></div>
                <a class="dropdown-item" id="logout" role="button">
                    <i class="mdi mdi-18px mdi-login-variant"></i><span>Logout</span>
                </a>
            </div>
        </div>
    </nav>
	<div class="sidebar">
		<div class="py-2 pl-3 border-bottom">
			<img src="{{asset('assets/images/logo.png')}}" width="30" class="d-inline-block align-top mr-2 mt-1" alt="Logo" loading="lazy">
			<span class="navbar-brand mb-0">Koperasi KWA</span>
		</div>
		<small class="text-secondary text-uppercase font-weight-bold">Menu</small>
		<a href="{{url('dashboard')}}" class="{{Request::is('dashboard')?'active':''}}">
			<i class="mdi mdi-apps mdi-18px"></i><span>Dashboard</span>
		</a>
		<!-- <small class="text-secondary text-uppercase font-weight-bold">Simpanan</small> -->
		@if(session("level") == 1 || session("level") == 100)
		<a href="{{url('admin/anggota')}}" class="{{Request::is('admin/anggota')?'active':''}}">
			<i class="mdi mdi-account-circle-outline mdi-18px"></i><span>Anggota</span>
		</a>
		<a href="{{url('admin/simpanan')}}" class="{{Request::is('admin/simpanan')?'active':''}}">
			<i class="mdi mdi-wallet-outline mdi-18px"></i><span>Simpanan</span>
		</a>
		<a href="{{url('admin/pinjaman')}}" class="{{Request::is('admin/pinjaman')?'active':''}}">
			<i class="mdi mdi-notebook-outline mdi-18px"></i><span>Pinjaman</span>
		</a>
		<a href="{{url('admin/rekapitulasi')}}" class="{{Request::is('admin/rekapitulasi')?'active':''}}">
			<i class="mdi mdi-file-table-box-outline mdi-18px"></i><span>Rekapitulasi</span>
		</a>
		@elseif(session("level") == 101)
		<a href="{{url('simpanan')}}" class="{{Request::is('simpanan')?'active':''}}">
			<i class="mdi mdi-wallet-outline mdi-18px"></i><span>Simpanan</span>
		</a>
		<a href="{{url('pinjaman')}}" class="{{Request::is('pinjaman')?'active':''}}">
			<i class="mdi mdi-notebook-outline mdi-18px"></i><span>Pinjaman</span>
		</a>
		@endif
		<!-- <small class="text-secondary text-uppercase font-weight-bold">Peminjaman</small> -->
		<!-- @if(session("level") == "101")
		<a href="{{url('approve-alker')}}" class="{{Request::is('approve-alker')?'active':''}}">
			<i class="mdi mdi-check-circle-outline mdi-18px"></i><span>Approve Alker</span>
		</a>
		<a href="{{url('approve-barang')}}" class="{{Request::is('approve-barang')?'active':''}}">
			<i class="mdi mdi-check-circle-outline mdi-18px"></i><span>Approve Barang</span>
		</a>
		@elseif(session("level") == "102")
		<a href="{{url('alker')}}" class="{{Request::is('alker')?'active':''}}">
			<i class="mdi mdi-clipboard-text-outline mdi-18px"></i><span>Daftar Alker</span>
		</a>
		<a href="{{url('project')}}" class="{{Request::is('project')?'active':''}}">
			<i class="mdi mdi-clipboard-text-outline mdi-18px"></i><span>Daftar Project</span>
		</a>
		@endif -->
	</div>
	<div class="overlay"></div>
	<div class="main">@yield('content')</div>
	<div class="customAlert d-flex align-items-center small"></div>
	@include('layouts.partials.script')
	@yield('script')
</body>
</html>