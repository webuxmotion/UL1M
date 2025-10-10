<?php

use App\Http\Controllers\Admin\PartController;
use App\Http\Controllers\Admin\WorkshopController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [SearchController::class, 'index'])->name('home');
Route::get('/parts/{part}', [SearchController::class, 'show'])->name('parts.show');

// Authentication routes (Laravel Breeze)
require __DIR__.'/auth.php';

// Dashboard redirect (after login)
Route::middleware('auth')->get('/dashboard', function () {
    // Redirect admins to admin panel, others to home
    if (in_array(auth()->user()->role, ['super_admin', 'workshop_admin'])) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home');
})->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Workshops (Super Admin only)
    Route::middleware(\App\Http\Middleware\SuperAdminMiddleware::class)->group(function () {
        Route::resource('workshops', WorkshopController::class);
    });

    // Parts
    Route::resource('parts', PartController::class);
});
