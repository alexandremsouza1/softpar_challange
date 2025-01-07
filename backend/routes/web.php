<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/token', function () {
    return csrf_token(); 
});

Route::get('/info', function () {
    return phpinfo(); 
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


