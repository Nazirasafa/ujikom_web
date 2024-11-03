<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Memanggil metode 'index' pada HomeController
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function() {

    Route::get('admin/dashboard', [HomeController::class, 'index']);
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin/products');
    Route::get('admin/products/create', [ProductController::class, 'create'])->name('admin/products/create');
    Route::post('admin/products/save', [ProductController::class, 'save'])->name('admin/products/save');
});


require __DIR__.'/auth.php';

// Route untuk admin dashboard
Route::get('admin/dashboard', [HomeController::class, 'admin'])->name('admindashboard');
Route::get('admin/dashboard', [HomeController::class, 'admin'])->middleware('auth', 'admin');
