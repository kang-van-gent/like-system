<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.index');
});
Route::get('/login', function () {
    return view('layouts.login');
});
