<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;

Route::get('session/login', [SessionController::class, 'createSession']);
Route::get('session/logout', [SessionController::class, 'deleteSession']);

Route::group(['middleware'=>['afterMiddleware']], function () {
	Route::get('/', function () {
		return view('login');
	});
	Route::get('daftar', function () {
		return view('daftar');
	});
});

Route::group(['middleware'=>['beforeMiddleware']], function () {
	Route::get('dashboard', function () {
		return view('dashboard');
	});
	Route::get('profil', function () {
		return view('profil');
	});

	Route::group(['middleware'=>['adminMiddleware']], function () {
		Route::get('admin/anggota', function () {
			return view('admin/user-anggota');
		});
		Route::get('admin/anggota/{id}', function () {
			return view('admin/anggota');
		});

		Route::get('admin/simpanan', function () {
			return view('admin/user-simpanan');
		});
		Route::get('admin/simpanan/{id}', function () {
			return view('admin/simpanan');
		});

		Route::get('admin/pinjaman', function () {
			return view('admin/user-pinjaman');
		});
		Route::get('admin/pinjaman/{id}', function () {
			return view('admin/pinjaman');
		});
		Route::get('admin/pinjaman/{user}/{id}', function () {
			return view('admin/view-pinjaman');
		});

		Route::get('admin/rekapitulasi', function () {
			return view('admin/rekapitulasi');
		});
	});
	
	Route::group(['middleware'=>['userMiddleware']], function () {
		Route::get('simpanan', function () {
			return view('simpanan');
		});
		Route::get('create/simpanan', function () {
			return view('create-simpanan');
		});

		Route::get('pinjaman', function () {
			return view('pinjaman');
		});
		Route::get('pinjaman/{id}', function () {
			return view('view-pinjaman');
		});
		Route::get('create/pinjaman', function () {
			return view('create-pinjaman');
		});
	});
	
	Route::get('{level}/simpanan/{user}/{id}', function () {
		return view('confirm-simpanan');
	});
	Route::get('{level}/pinjaman/{user}/{pinjaman}/{id}', function () {
		return view('confirm-pinjaman');
	});
});
