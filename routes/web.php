<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Client\HomeController as ClientHomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\web\HomeController;
use App\Models\ClientProduct;
use Illuminate\Support\Facades\Route;

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
Route::get('/',[HomeController::class,'index'])->name('home');


Route::middleware(['auth','verified'])->name('client.')->group(function(){
    Route::get('/client/dashboard',[ClientHomeController::class,'index'])->name('dashboard');
});

// admin Routes
Route::middleware(['auth', 'verified','isAdmin'])->name('admin.')->group(function (){
    Route::get('/dashboard',[AdminHomeController::class,'index'])->name('dashboard');
    Route::get('/dashboard/clients',[AdminHomeController::class,'client'])->name('client');
    Route::get('/dashboard/clients/{user:name}',[AdminHomeController::class,'editClientProduct'])->name('client.edit');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
