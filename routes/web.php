<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Manager\UserController;
use App\Http\Controllers\Manager\DashBoardControllers;
use App\Http\Controllers\Manager\ProdukController;
use App\Http\Controllers\Manager\LaporanController;
use App\Http\Controllers\Manager\KategoriController; 
use App\Http\Controllers\Auth\AuthController;
use App\Exports\LaporanExport;

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:manager'])
    ->prefix('manager')
    ->name('manager.')
    ->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // PRODUK
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create'); 
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');       
    Route::get('/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{produk}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');
    Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
    

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');


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