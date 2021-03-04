<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\MainSetting\MainSettingController;
use App\Http\Controllers\API\MainSetting\SaldoKoperasiController;
use App\Http\Controllers\API\Param\GetParamController;
use App\Http\Controllers\API\Pinjaman\ContractController;
use App\Http\Controllers\API\Pinjaman\CreatePinjamanController;
use App\Http\Controllers\API\Pinjaman\GetPinjamanController;
use App\Http\Controllers\API\Pinjaman\LunasPinjamanController;
use App\Http\Controllers\API\Pinjaman\ReportPinjamanController;
use App\Http\Controllers\API\Pinjaman\StatusPinjamanController;
use App\Http\Controllers\API\Transaction\AcceptTransactionController;
use App\Http\Controllers\API\Transaction\CreateTransactionController;
use App\Http\Controllers\API\Transaction\GetTransactionController;
use App\Http\Controllers\API\Transaction\ReportTransactionController;
use App\Http\Controllers\API\Transaction\UploadBuktiController;
use App\Http\Controllers\API\User\DeleteUserController;
use App\Http\Controllers\API\User\GetUserController;
use App\Http\Controllers\API\User\UpdateUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'  => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/logout', LogoutController::class);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [GetUserController::class, 'all']);
        Route::get('/{user_id}', [GetUserController::class, 'by_id']);
        Route::delete('/delete/{user_id}', DeleteUserController::class);
        Route::post('/update/{user_id}', UpdateUserController::class);
    });

    Route::group(['prefix' => 'transaction'], function () {
        Route::get('/get/{transaction_id}', [GetTransactionController::class, 'byId']);
        Route::get('/get_simpanan_perbulan', [GetTransactionController::class, 'simpanan_perbulan']);
        Route::get('/filter/{user_id?}', [GetTransactionController::class, 'filter']);
        Route::post('/bukti_pembayaran/{transaction_id}', UploadBuktiController::class);
        Route::patch('/accept_transaction/{transaction_id}', AcceptTransactionController::class);
        Route::post('/create_transaction', CreateTransactionController::class);
        Route::get('/report', ReportTransactionController::class);
    });

    Route::group(['prefix' => 'pinjaman'], function () {
        Route::get('/get/{pinjaman_id}', [GetPinjamanController::class, 'byId']);
        Route::get('/filter/{user_id?}', [GetPinjamanController::class, 'filter']);
        Route::post('/detail', [CreatePinjamanController::class, 'detail']);
        Route::post('/create_pinjaman/detail', [CreatePinjamanController::class, 'detail']);
        Route::post('/create_pinjaman', [CreatePinjamanController::class, 'create_pinjaman']);
        Route::post('/upload_contract/{pinjaman_id}', ContractController::class);
        Route::patch('/accept_pinjaman/{pinjaman_id}', [StatusPinjamanController::class, 'accept']);
        Route::patch('/reject_pinjaman/{pinjaman_id}', [StatusPinjamanController::class, 'reject']);
        Route::patch('/paid_off_pinjaman/{pinjaman_id}', [StatusPinjamanController::class, 'paid_off']);
        Route::get('/lunas_pinjaman/{pinjaman_id}', [LunasPinjamanController::class, 'info_lunas']);
        Route::post('/create_lunas_pinjaman/{pinjaman_id}', [LunasPinjamanController::class, 'create_pinjaman_lunas']);
        Route::get('/report', ReportPinjamanController::class);
        Route::get('/cek_pinjaman', [GetPinjamanController::class, 'cek_pinjaman']);
    });

    Route::group(['prefix' => 'main_setting'], function () {
        Route::post('/update', [MainSettingController::class, 'update']);
        Route::get('/', [MainSettingController::class, 'getData']);
        Route::post('/add_saldo_koperasi', [SaldoKoperasiController::class, 'add_saldo']);
    });
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', LoginController::class);
    Route::post('/register', RegisterController::class);
});

Route::group(['prefix' => 'param'], function () {
    Route::get('/pendidikan', [GetParamController::class, 'pendidikan']);
    Route::get('/jabatan', [GetParamController::class, 'jabatan']);
    Route::get('/status_keluarga', [GetParamController::class, 'status_keluarga']);
});