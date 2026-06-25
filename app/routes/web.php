<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
Route::get('/', function () {
    return view('lupaPass');
});
