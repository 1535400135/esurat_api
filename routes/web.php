<?php

use App\Http\Controllers\SuratController;
use App\Models\Surat;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/logout', function () {
    return view('login');
});
// Route::get('/masuk', function () {
//     return view('inbox');
// });
// Route::get('/masuk/pin/{id}', function () {
//     return view('inputpin');
// });
// Route::get('/show', function () {
//     return view('viewmail');
// });
// Route::get('/keluar', function () {
//     return view('outbox');
// });
// Route::get('/keluar/pin/{id}', function () {
//     return view('inputpin');
// });
// Route::get('/keluar/show', function () {
//     return view('viewmail');
// });
Route::view('/dashboard', 'dashboard');
Route::view('/pin', 'pin');
Route::view('/newpin', 'newpin');
Route::get('/masuk', [SuratController::class, 'inbox']);
Route::get('/delete/inbox/{id}', [SuratController::class, 'pininbox']);
Route::get('/delete/outbox/{id}', [SuratController::class, 'pinoutbox']);
Route::get('/masuk/pin/{id}', [SuratController::class, 'pin']);
Route::get('/keluar', [SuratController::class, 'outbox']);
Route::get('/show/out/{id}', [SuratController::class, 'showout']);
Route::get('/show/in/{id}', [SuratController::class, 'showin']);
Route::get('/keluar/show/{id}', [SuratController::class, 'show']);
Route::get('/keluar/pin/{id}', [SuratController::class, 'pin']);