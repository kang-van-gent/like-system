<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.index');
});
Route::get('/login', function () {
    return view('layouts.login');
});


// Authenticate
Route::get('/login', [AdminController::class, 'index']);
Route::post('/admin/login', [AdminController::class, 'check_login']);
Route::get('/logout', [AdminController::class, 'logout']);
