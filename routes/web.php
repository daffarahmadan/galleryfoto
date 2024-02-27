<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\KomentarfotoController;
use App\Http\Controllers\LikefotoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', function () {
        return view('home');
    })->name('home');
});

Route::get('/welcome', function () {
    return view('welcome');
})->middleware('auth.custom');

Route::get('/auth/login', [AuthController::class, 'loginIndex'])->name('login');
Route::post('/auth/login', [AuthController::class, 'authenticate']);

Route::get('/auth/register', [AuthController::class, 'registerIndex'])->name('register');
Route::post('/auth/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('album', AlbumController::class);
Route::get('/albums/{id}', [AlbumController::class, 'show'])->name('album.show');
Route::put('/album/{id}/edit', [AlbumController::class, 'update'])->name('album.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/komentarfoto/create/{fotoId}', [KomentarfotoController::class, 'create'])->name('komentarfoto.create');
Route::resource('komentarfoto', KomentarfotoController::class);
Route::post('/komentarfoto/store', [KomentarfotoController::class, 'store'])->name('komentarfoto.store');
Route::put('/komentarfoto/{id}/edit', [KomentarfotoController::class, 'update'])->name('komentarfoto.update');

Route::resource('foto', FotoController::class);
Route::get('/home', [FotoController::class, 'index'])->name('home');



Route::resource('likefoto', LikefotoController::class);

// Route::post('/album/{id}/toggle-like', [AlbumController::class, 'toggleLike'])->name('album.toggle-like');
