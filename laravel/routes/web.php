<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/re-auth', function () {
    return view('layouts.regis');
});

Route::get('/farm', function () {
    return view('layouts.farm');
});


// Authenticate
Route::get('/login', [AdminController::class, 'index']);
Route::post('/admin/login', [AdminController::class, 'check_login']);
Route::post('/admin/regis', [AdminController::class, 'register']);
Route::get('/logout', [AdminController::class, 'logout']);

// Home
Route::get('/', [HomeController::class, 'index']);
Route::post('/new-services', [HomeController::class, 'newServices']);
Route::post('/new-farm', [HomeController::class, 'newFarm']);
Route::post('/services', [HomeController::class, 'services']);

// Farm
Route::get('/farm', [FarmController::class, 'index']);
