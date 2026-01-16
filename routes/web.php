<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\DashboardStaffController; // DIUBAH

Route::prefix('staff')->name('staff.')->group(function () {
    // Dashboard Routes
    Route::get('/dashboard', [DashboardStaffController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/{id}', [DashboardStaffController::class, 'show'])->name('dashboard.show');
    
    // Pesanan Actions
    Route::put('/pesanan/verifikasi/{id}', [DashboardStaffController::class, 'verifikasi'])->name('pesanan.verifikasi');
    Route::put('/pesanan/cancel/{id}', [DashboardStaffController::class, 'cancel'])->name('pesanan.cancel');
    Route::put('/pesanan/proses/{id}', [DashboardStaffController::class, 'proses'])->name('pesanan.proses');
    Route::put('/pesanan/selesai/{id}', [DashboardStaffController::class, 'selesai'])->name('pesanan.selesai');
});