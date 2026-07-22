<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\DashboardController;

// Routes yang bisa diakses semua orang (tanpa login)
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [ResepController::class, 'home'])->name('home');

Route::get('/resep', [ResepController::class, 'tampil'])->name('resep.tampil');
Route::get('/kategori/{kategori}', [ResepController::class, 'kategori'])->name('resep.kategori');
Route::get('/resep/{id}', [ResepController::class, 'show'])->name('resep.show');
Route::get('/search', [ResepController::class, 'search'])->name('resep.search');
Route::get('/rekomendasi', [ResepController::class, 'rekomendasi'])->name('resep.rekomendasi');

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');
Route::get('/forgot', function () {
    return view('forgot');
});

// Routes yang memerlukan login
Route::middleware(['auth'])->group(function () {
    // Route untuk logout
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    // Route untuk profile (bisa diakses admin dan user)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Routes khusus admin
    
        Route::resource('users', UserController::class);
        Route::get('/tambah', [ResepController::class, 'tambah'])->name('resep.tambah'); 
        Route::post('/resep/tambah', [ResepController::class, 'store'])->name('resep.recipe');
        Route::get('/resep/{id}/edit', [ResepController::class, 'edit'])->name('resep.edit');
        Route::put('/resep/{id}', [ResepController::class, 'update'])->name('resep.update');
        Route::delete('/resep/{id}', [ResepController::class, 'destroy'])->name('resep.destroy');
    });

    // Routes yang memerlukan login
Route::middleware(['auth'])->group(function () {
    // Routes khusus user (bookmark)
    Route::post('/bookmarks/{resep}', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::delete('/bookmarks/{resep}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');

    // Routes khusus admin
    Route::middleware(['auth','check.role:admin'])->group(function () {
        Route::resource('recipes', ResepController::class)->except(['index', 'show']);
        Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

        Route::get('/dashboard/resep', [DashboardController::class,'resep'])
            ->name('dashboard.resep');
        Route::get('/dashboard/user', [UserController::class,'index'])
            ->name('dashboard.user');
    });
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class,'index'])
        ->name('dashboard');

});