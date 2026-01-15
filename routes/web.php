<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\CustomerKatalogController;
use App\Http\Controllers\Customer\CustomerHistoryController;
use App\Http\Controllers\Customer\CustomerProfileController;


Route::prefix('staff')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('staff.dashboard.index');
    Route::get('/dashboard/{id}', [DashboardController::class, 'show'])->name('staff.dashboard.show');
    Route::put('/pesanan/verifikasi/{id}', [DashboardController::class, 'verifikasi'])->name('pesanan.verifikasi');
    Route::put('/pesanan/cancel/{id}', [DashboardController::class, 'cancel'])->name('pesanan.cancel');
    Route::put('/staff/pesanan/proses/{id}', [DashboardController::class, 'proses'])->name('pesanan.proses');
    Route::put('/staff/pesanan/selesai/{id}', [DashboardController::class, 'selesai'])->name('pesanan.selesai');
});

Route::prefix('customer')->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index']);
    Route::get('/katalog', [CustomerDashboardController::class, 'katalog'])->name('katalog');
});