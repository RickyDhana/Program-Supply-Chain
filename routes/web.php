<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sc1Controller;
use App\Http\Controllers\AuthController;

Route::get('/', [Sc1Controller::class, 'index'])->name('home');

// login admin
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// halaman admin (hanya bisa diakses setelah login)
Route::middleware('auth')->group(function () {
    Route::get('/admin', [Sc1Controller::class, 'admin'])->name('admin');
    Route::put('/admin/update/{No}', [Sc1Controller::class, 'update'])->name('admin.update');
    Route::delete('/admin/delete/{No}', [Sc1Controller::class, 'destroy'])->name('admin.delete');
    Route::post('/admin/store', [Sc1Controller::class, 'store'])->name('admin.store');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});