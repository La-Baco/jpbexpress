<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\AreaController;
use App\Http\Controllers\admin\KurirController;
use App\Http\Controllers\admin\BarangController;
use App\Http\Controllers\admin\PelangganController;
use App\Http\Controllers\admin\ProfileController as AdminProfileController;
use App\Http\Controllers\kurir\ProfileController as KurirProfileController;

use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\kurir\DashboardController as KurirDashboardController;
use App\Http\Controllers\admin\PengirimanController as AdminPengirimanController;
use App\Http\Controllers\kurir\PengirimanController as KurirPengirimanController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile');
    Route::put('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::post('/admin/profile/foto', [AdminProfileController::class, 'updateFoto'])->name('admin.profile.updateFoto');
    Route::post('/admin/profile/password', [AdminProfileController::class, 'updatePassword'])->name('admin.profile.updatePassword');

    Route::get('/admin/kurir', [KurirController::class, 'index'])->name('admin.kurir.index');
    Route::get('admin/kurir/{id}/show', [KurirController::class, 'show'])->name('admin.kurir.show');
    Route::post('/admin/kurir', [KurirController::class, 'store'])->name('admin.kurir.store');
    Route::put('/admin/kurir/{id}', [KurirController::class, 'update'])->name('admin.kurir.update');
    Route::delete('/admin/kurir/{id}', [KurirController::class, 'destroy'])->name('admin.kurir.destroy');

    Route::get('/admin/area', [AreaController::class, 'index'])->name('admin.area.index');
    Route::post('/admin/area', [AreaController::class, 'store'])->name('admin.area.store');
    Route::put('/admin/area/{id}', [AreaController::class, 'update'])->name('admin.area.update');
    Route::delete('/admin/area/{id}', [AreaController::class, 'destroy'])->name('admin.area.destroy');

    Route::get('/admin/pelanggan', [PelangganController::class, 'index'])->name('admin.pelanggan.index');
    Route::post('/admin/pelanggan', [PelangganController::class, 'store'])->name('admin.pelanggan.store');
    Route::put('/admin/pelanggan/{id}', [PelangganController::class, 'update'])->name('admin.pelanggan.update');
    Route::delete('/admin/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('admin.pelanggan.destroy');

    // Pengiriman
    Route::get('/admin/pengiriman', [AdminPengirimanController::class, 'index'])->name('admin.pengiriman.index');
    Route::post('/admin/pengiriman', [AdminPengirimanController::class, 'store'])->name('admin.pengiriman.store');
    Route::get('/admin/pengiriman/{id}', [AdminPengirimanController::class, 'show'])->name('admin.pengiriman.show');
    Route::put('/admin/pengiriman/{id}', [AdminPengirimanController::class, 'update'])->name('admin.pengiriman.update');
    Route::delete('/admin/pengiriman/{id}', [AdminPengirimanController::class, 'destroy'])->name('admin.pengiriman.destroy');

    Route::get('/pengiriman/{pengiriman}/barang', [BarangController::class, 'index'])->name('admin.barang.index');
    Route::get('/pengiriman/{pengiriman}/barang/create', [BarangController::class, 'create'])->name('admin.barang.create');
    Route::post('/pengiriman/{pengiriman}/barang', [BarangController::class, 'store'])->name('admin.barang.store');
    Route::get('/pengiriman/{pengiriman}/barang/{barang}/edit', [BarangController::class, 'edit'])->name('admin.barang.edit');
    Route::put('/pengiriman/{pengiriman}/barang/{barang}', [BarangController::class, 'update'])->name('admin.barang.update');
    Route::delete('/pengiriman/{pengiriman}/barang/{barang}', [BarangController::class, 'destroy'])->name('admin.barang.destroy');

    Route::get('/admin/pengiriman/{id}/pdf', [AdminPengirimanController::class, 'pdf'])
        ->name('admin.pengiriman.pdf');
});

// Kurir routes
Route::middleware(['auth', 'role:kurir'])->group(function () {

    Route::get('/kurir/dashboard', [KurirDashboardController::class, 'index'])->name('kurir.dashboard');

    Route::get('/kurir/profile', [KurirProfileController::class, 'edit'])->name('kurir.profile');
    Route::put('/kurir/profile', [KurirProfileController::class, 'update'])->name('kurir.profile.update');
    Route::post('/kurir/profile/foto', [KurirProfileController::class, 'updateFoto'])->name('kurir.profile.updateFoto');
    Route::post('/kurir/profile/password', [KurirProfileController::class, 'updatePassword'])->name('kurir.profile.updatePassword');

    Route::get('/kurir/pengiriman', [KurirPengirimanController::class, 'index'])->name('kurir.pengiriman.index');
    Route::post('/kurir/pengiriman/{barang}/status', [KurirPengirimanController::class, 'updateStatus'])->name('kurir.pengiriman.updateStatus');

});
