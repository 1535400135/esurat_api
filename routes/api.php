<?php

use App\Http\Controllers\Api\ApiSuratController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiPinController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/register', [ApiAuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/pin/cek/{id}', [ApiPinController::class, 'cekPin']);
    Route::post('/pin/proses', [ApiPinController::class, 'proses']);
    Route::post('/outbox/del', [ApiPinController::class, 'prosesOut']);
    Route::post('/inbox/del', [ApiPinController::class, 'prosesIn']);
    Route::post('/pin/save', [ApiPinController::class, 'store']);
    Route::post('/pin/update', [ApiPinController::class, 'update']);
    Route::get('/inbox/{id}', [ApiSuratController::class, 'inbox']);
    Route::get('/outbox/{id}', [ApiSuratController::class, 'outbox']);
    Route::get('/show/out/{id}', [ApiSuratController::class, 'showOut']);
    Route::get('/show/in/{id}', [ApiSuratController::class, 'showIn']);
    Route::get('/proses/{id}', [ApiSuratController::class, 'prosesIn']);
    Route::get('/prosesout/{id}', [ApiSuratController::class, 'prosesOut']);
    Route::post('/outbox/save', [ApiSuratController::class, 'store']);
    Route::delete('/delete/{id}', [ApiSuratController::class, 'destroy']);
    Route::post('/logout', [ApiAuthController::class, 'logout']);
});