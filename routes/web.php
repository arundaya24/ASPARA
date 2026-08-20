<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/lapor', [HomeController::class, 'lapor'])->name('lapor');
Route::post('/lapor', [ReportController::class, 'store'])->name('report.store');
Route::get('/status', [HomeController::class, 'status'])->name('status');
Route::post('/status', [ReportController::class, 'cekStatus'])->name('report.cek');
Route::get('/peta', [HomeController::class, 'peta'])->name('peta');
Route::get('/statistik', [HomeController::class, 'statistik'])->name('statistik');
Route::get('/riwayat', [HomeController::class, 'riwayat'])->name('riwayat');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');
Route::get('/map-data', [ReportController::class, 'getMapData'])->name('map.data');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::post('/verifikasi/{id}', [AdminController::class, 'verifikasi'])->name('verifikasi');
    Route::post('/tolak/{id}', [AdminController::class, 'tolak'])->name('tolak');
    Route::post('/update-status/{id}', [AdminController::class, 'updateStatus'])->name('updateStatus');

    Route::resource('report', AdminReportController::class);
    Route::patch('/laporan/{id}/status', [AdminReportController::class, 'updateStatus'])->name('laporan.status');
    Route::get('/laporan/{id}', [AdminReportController::class, 'show'])->name('laporan.show');

    Route::resource('users', AdminUserController::class);

    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
    Route::delete('/settings/reset', [AdminSettingController::class, 'reset'])->name('settings.reset');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{id}/reply', [MessageController::class, 'reply'])->name('messages.reply');
    Route::post('/messages/mark-all-read', [MessageController::class, 'markAllRead'])->name('messages.mark-all-read');

    Route::delete('/messages/destroy-all', [MessageController::class, 'destroyAll'])->name('messages.destroy-all');
    Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');

    Route::get('/api/stats', [AdminController::class, 'stats'])->name('api.stats');
    Route::get('/api/reports', [AdminController::class, 'getAllReports'])->name('api.reports');
    Route::get('/api/reports/{id}', [AdminController::class, 'getReport'])->name('api.report');
    Route::get('/api/unread-count', [AdminController::class, 'unreadCount'])->name('api.unread-count');
});

Route::middleware(['auth', 'petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasController::class, 'dashboard'])->name('dashboard');
    Route::post('/progress/{id}', [PetugasController::class, 'updateProgress'])->name('progress');
    Route::post('/selesai/{id}', [PetugasController::class, 'selesai'])->name('selesai');
    Route::post('/upload-dokumentasi', [PetugasController::class, 'uploadDokumentasi'])->name('upload');
});

Route::prefix('api')->name('api.')->group(function () {
    Route::get('/reports', [ReportController::class, 'getAll'])->name('reports.all');

    Route::get('/reports/{id}', [ReportController::class, 'getDetail'])->name('reports.detail');

    Route::post('/reports', [ReportController::class, 'storeApi'])->name('reports.store');

    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
});
