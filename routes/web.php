<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

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

//Auth Controller -> User Registration
Route::post('/register', [AuthController::class, 'register'])->name('register');

//Auth Controller -> User LogOut
Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

// UserController -> Login ID 
Route::post('/login', [UserController::class, 'login'])->name('login');

// ProductController -> All Product view Page
Route::get('/', [ProductController::class, 'index'])->name('index');


// Middleware for Admin Access View only
Route::middleware('isAdmin')->group(function () {
    Route::get('/products', [ProductController::class, 'show'])->name('productList');
    Route::get('/products/create', [ProductController::class, 'create'])->name('create');
    Route::post('/products', [ProductController::class, 'store'])->name('storeProduct');
    Route::post('/products/special-price', [ProductController::class, 'special'])->name('specialPrice');

    Route::get('/products/{id}', [ProductController::class, 'edit'])->name('editProduct');
    Route::post('/products/{id}', [ProductController::class, 'update'])->name('updateProduct');
    Route::get('/product/{id}', [ProductController::class, 'destroy'])->name('deleteProduct');


});