<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PasswordController;

// Halaman publik (tanpa authentication)
Route::get('/', [UploadController::class, 'index'])->name('home');
Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');

// Route group untuk user yang sudah login
Route::middleware('auth')->group(function () {
    // Route group untuk admin dengan prefix 'admin'
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/', [AdminController::class, 'tugas'])->name('tugas.index');

        // ✅ PROFILE HARUS DI ATAS
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // PASSWORD (tanpa admin prefix)
        Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

        // ❌ ROUTE DINAMIS TARUH PALING BAWAH
        Route::get('/{id}/download', [AdminController::class, 'downloadTugas'])->name('tugas.download');
        Route::delete('/{id}', [AdminController::class, 'deleteTugas'])->name('tugas.delete');
    });
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
});

require __DIR__.'/auth.php';