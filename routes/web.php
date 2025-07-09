<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DekorinController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionApprovalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard pakai controller
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Semua route di bawah hanya untuk user yang sudah login
Route::middleware('auth')->group(function () {

    // Profile user (default dari Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Category
    Route::resource('categories', CategoryController::class);

    // CRUD Dekorin
    Route::resource('dekorins', DekorinController::class);

    Route::resource('users', UserController::class)->middleware(['auth']);

    // CRUD Transaction (hanya index, edit, update, destroy)
    Route::resource('transactions', TransactionController::class)->only([
        'index', 'edit', 'update', 'destroy'
    ]);

    // Saldo Approval 
    Route::get('/saldo/approval', [TransactionApprovalController::class, 'index'])->name('transactions.approval');
    Route::patch('/saldo/{id}/approve', [TransactionApprovalController::class, 'approve'])->name('transactions.approve');
    Route::patch('/saldo/{id}/reject', [TransactionApprovalController::class, 'reject'])->name('transactions.reject');
});

// Route bawaan auth (login, register, dll)
require __DIR__.'/auth.php';
