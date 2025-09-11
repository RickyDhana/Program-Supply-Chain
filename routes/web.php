<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
    
});
Route::get('login', function () {
    // Mengembalikan view yang sudah kita buat
    return view('login');
});