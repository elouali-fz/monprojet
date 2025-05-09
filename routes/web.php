<?php

use App\Http\Controllers\AchatController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FamilleController;
use App\Http\Controllers\SousFamilleController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtatController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\ModeReglementController;


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
    return view('welcome');
});
Route::get('/layout', function () {
    return view('layouts.app');
});

Route::resource('achats', AchatController::class);
Route::resource('cart', CartController::class)->except(['destroy']);
Route::delete('/cart', [CartController::class, 'destroy'])->name('cart.destroy');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::resource('/familles',FamilleController::class);
Route::resource('/sous-familles',SousFamilleController::class);
Route::resource('etats', EtatController::class);
Route::resource('mode_reglements', ModeReglementController::class);
Route::get('/marques/{marque}', [MarqueController::class, 'show'])->name('marques.show');
Route::resource('commandes', CommandeController::class);
Route::resource('produits', ProduitController::class);
