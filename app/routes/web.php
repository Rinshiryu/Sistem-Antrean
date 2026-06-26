<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AntreanController;

Route::get('/', function () {
    return view('login');
});

Route::post('/login', [AuthController::class, 'login'])
    ->name('login');

Route::get('/main', function () {
    if (!session()->has('id_akun')) {
        return redirect('/');
    }
    return view('main');
});

Route::get('/register', function () {
    return view('regis');
});

Route::post('/register', [AuthController::class, 'register'])
    ->name('register');

// Route::get('/', function () {
//     return view('lupaPass');
// });


Route::get('/dashboard-petugas', [AntreanController::class, 'index']);


Route::prefix('petugas/antrean')->group(function () {
    Route::post('/next', [AntreanController::class, 'nextAntrean']);
    Route::post('/skip', [AntreanController::class, 'skipAntrean']);
    Route::post('/recall', [AntreanController::class, 'recallAntrean']);
    Route::get('/live-data', [AntreanController::class, 'getLiveData']);
    Route::post('/manual', [AntreanController::class, 'manualAntrean']);
    Route::post('/tambah-pasien', [AntreanController::class, 'tambahPasienBaru']);
});