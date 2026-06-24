<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::get('/main', function () {
    return view('main');
});
Route::get('/', function () {
    return view('regis');
});
Route::get('/', function () {
    return view('lupaPass');
});
