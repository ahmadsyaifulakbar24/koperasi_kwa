<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Transaction\AcceptTransactionController;
use App\Http\Controllers\API\Transaction\CreateTransactionController;
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
        Route::get('/logout', LogoutController::class);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [GetUserController::class, 'all']);
        Route::get('/{user_id}', [GetUserController::class, 'by_id']);
        Route::delete('/delete/{user_id}', DeleteUserController::class);
        Route::post('/update/{user_id}', UpdateUserController::class);
    });

    Route::group(['prefix' => 'transaction'], function () {
        Route::post('/bukti_pembayaran/{transaction_id}', UploadBuktiController::class);
        Route::patch('/accept_transaction/{transaction_id}', AcceptTransactionController::class);
        Route::post('/create_transction/{user_id}', CreateTransactionController::class);
    });
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', LoginController::class);
    Route::post('/register', RegisterController::class);
});
