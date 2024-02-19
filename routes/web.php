<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\KomentarfotoController;
use App\Http\Controllers\LikefotoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
   
});
Route::get('/komentarfoto/create/{fotoId}', [KomentarfotoController::class, 'create'])->name('komentarfoto.create');
Route::resource('komentarfoto', KomentarfotoController::class);

Route::resource('foto', FotoController::class);
// Route::delete('foto/{foto}/hapus', function (Foto $foto) {
//     $foto->delete();

//     return redirect()->route('album.show', $foto->albumid)->with('success', 'Foto berhasil dihapus.');
// })->name('foto.destroy');

Route::resource('komentarfoto', KomentarfotoController::class);
Route::post('/komentar/store', [KomentarfotoController::class, 'store'])->name('komentarfoto.store');
Route::get('/komentarfoto/{id}/edit', 'KomentarfotoController@edit')->name('komentarfoto.edit');

Route::put('/komentar/{komen:id}/edit', [KomentarfotoController::class, 'update'])->name('komentarfoto.update');
 

Route::resource('likefoto', LikefotoController::class);

Route::post('/album/{id}/toggle-like', [AlbumController::class, 'toggleLike'])->name('album.toggle-like');