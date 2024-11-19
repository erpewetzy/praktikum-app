<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\pelangganController;
use Illuminate\Support\Facades\Route;


Route::get('login', [AdminController::class,'login'])->name('login');
Route::get('logout', [AdminController::class,'logout']);
Route::post('login', [AdminController::class, 'cekLogin']);

Route::middleware('auth:admin')->group(function() {
    Route::get('/', [AdminController::class,'dashboardAdmin']);
    Route::get('/pelanggan', [pelangganController::class,'pelanggan']);
    Route::post('/pelanggan', [pelangganController::class, 'simpan']);
    Route::get('/pelanggan/{id}', [pelangganController::class, 'edit']);
});