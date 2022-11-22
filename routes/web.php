<?php

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
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::check()) {
            if (Auth::user()->isAdmin()) {
                return redirect('admin');
            }else if(Auth::user()->isClient()){
                return redirect('client');
            }
        }
        //If unauthenticated user hits the route, he will be redirected to login page
    })->name('dashboard');

    //I have used resource routing method so I will be providing all routes in documents as well for your ease
    //I have added 'App\Http\Controllers' namespace in RouteServiceProvider class so it will set as the URL generator's root namespace and some more mapping features for web and api routes
    Route::prefix('admin')->group(function () {
            Route::name('admin.')->group(function () {
                Route::resource('/', AdminController::class);
            });
    });

    Route::prefix('client')->group(function () {
        Route::name('client.')->group(function () {
            Route::resource('/', ClientController::class);
                Route::controller(ClientController::class)->group(function () {
                    Route::get('/get-clients', 'getClientsList')->name('getClientsList');
                });
            });
    });

    Route::prefix('product')->group(function () {
        Route::name('product.')->group(function () {
            Route::resource('/', ProductController::class);
        Route::controller(ProductController::class)->group(function () {
                Route::get('/get-products/{user}', 'getProducts')->name('getProducts');
                Route::post('/set-price-for-client', 'setPriceForClient')->name('setPriceForClient');
            });
        });
    });
});

require __DIR__.'/auth.php';
