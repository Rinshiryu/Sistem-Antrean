<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AntreanController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// Halaman Login
Route::get('/', function () {
    return view('login');
})->name('login');

// Proses Login
Route::post('/', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// Halaman Register
Route::get('/register', function () {
    return view('regis');
})->name('register.form');

// Proses Register
Route::post('/register', [AuthController::class, 'register'])
    ->name('register');


/*
|--------------------------------------------------------------------------
| HALAMAN PASIEN
|--------------------------------------------------------------------------
*/

Route::get('/main', function () {

    if (!session()->has('id_akun')) {
        return redirect('/');
    }

    return view('main');

})->name('main');

// Ambil nomor antrean
Route::post('/ambil-antrean', [AntreanController::class, 'store'])
    ->name('ambil.antrean');

// Status antrean realtime
Route::get('/status-antrean', [AntreanController::class, 'statusAntrean'])
    ->name('status.antrean');


/*
|--------------------------------------------------------------------------
| HALAMAN PETUGAS
|--------------------------------------------------------------------------
*/

Route::get('/dashboard-petugas', [AntreanController::class, 'index'])
    ->name('dashboard-petugas');

Route::prefix('petugas/antrean')->group(function () {

    Route::get('/live-data', [AntreanController::class, 'getLiveData']);

    Route::post('/next', [AntreanController::class, 'nextAntrean']);

    Route::post('/skip', [AntreanController::class, 'skipAntrean']);

    Route::post('/recall', [AntreanController::class, 'recallAntrean']);

    Route::post('/manual', [AntreanController::class, 'manualAntrean']);

    Route::post('/tambah-pasien', [AntreanController::class, 'tambahPasienBaru']);

});