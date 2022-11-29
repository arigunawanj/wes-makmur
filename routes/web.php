<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JamuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route Beranda
Route::resource('beranda', BerandaController::class);

Auth::routes();

Route::middleware(['auth', 'Admin'])->group(function () {
    // Route User dan Hapus Data User
    Route::resource('user', UserController::class);
    Route::get('user/{user}', [UserController::class, 'destroy']);
});

Route::middleware(['auth'])->group(function () {
    
    // Route Category dan Hapus Data Kategori
    Route::resource('category', CategoryController::class);
    Route::get('category/{category}', [CategoryController::class, 'destroy']);
    
    // Route Product dan Hapus Data Product
    Route::resource('product', ProductController::class);
    Route::get('product/{product}', [ProductController::class, 'destroy']);
    Route::get('tampilBarang/{id}', [ProductController::class, 'hide']);
    
    
    // Route Post dan Hapus Data Postingan
    Route::resource('post', PostController::class);
    Route::get('post/{post}', [PostController::class, 'destroy']);
    Route::get('tampilPost/{id}', [PostController::class, 'hide']);
    
    // Route Jamu
    Route::resource('jamu', JamuController::class);
    
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
