<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


/*Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard', ['user' => auth()->user()]);
})->name('dashboard');
require __DIR__.'/auth.php';*/
Route::get('/', function () {
    return view('layouts.app');
});
Route::resource('cart', CartController::class)->except(['destroy']);
Route::delete('/cart', [CartController::class, 'destroy'])->name('cart.destroy');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
