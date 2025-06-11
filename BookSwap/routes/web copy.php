<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KsiazkiController;
use App\Http\Controllers\PunktyController;
use App\Http\Controllers\UzytkownicyController;
use App\Http\Controllers\WiadomosciController;
use App\Http\Controllers\WymianyController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfilController;

// Strona główna
Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth', 'admin'])->group(function () {
    // Ksiazki
    Route::get('/ksiazki', [KsiazkiController::class, 'index']);
    Route::get('/ksiazki/create', [KsiazkiController::class, 'create']);
    Route::post('/ksiazki', [KsiazkiController::class, 'store']);
    Route::get('/ksiazki/search', [KsiazkiController::class, 'search']);
    Route::get('/ksiazki/{id}', [KsiazkiController::class, 'show'])->where('id', '[0-9]+');
    Route::get('/ksiazki/{id}/edit', [KsiazkiController::class, 'edit']);
    Route::put('/ksiazki/{id}', [KsiazkiController::class, 'update']);
    Route::delete('/ksiazki/{id}', [KsiazkiController::class, 'destroy']);
    Route::get('/ksiazki/gatunek/{gatunek}', [KsiazkiController::class, 'filterByGatunek']);

    // Punkty
    Route::get('/punkty', [PunktyController::class, 'index']);
    Route::get('/punkty/create', [PunktyController::class, 'create']);
    Route::post('/punkty', [PunktyController::class, 'store']);
    Route::get('/punkty/exchange', [PunktyController::class, 'showExchangeForm'])->name('punkty.exchange');
    Route::post('/punkty/exchange', [PunktyController::class, 'exchange'])->name('punkty.exchange.post');
    Route::get('/punkty/{id}', [PunktyController::class, 'show']);
    Route::get('/punkty/{id}/edit', [PunktyController::class, 'edit']);
    Route::put('/punkty/{id}', [PunktyController::class, 'update']);
    Route::delete('/punkty/{id}', [PunktyController::class, 'destroy']);

    // Uzytkownicy
    Route::get('/uzytkownicy', [UzytkownicyController::class, 'index']);
    Route::get('/uzytkownicy/create', [UzytkownicyController::class, 'create']);
    Route::post('/uzytkownicy', [UzytkownicyController::class, 'store']);
    Route::get('/uzytkownicy/{id}', [UzytkownicyController::class, 'show']);
    Route::get('/uzytkownicy/{id}/edit', [UzytkownicyController::class, 'edit']);
    Route::put('/uzytkownicy/{id}', [UzytkownicyController::class, 'update']);
    Route::delete('/uzytkownicy/{id}', [UzytkownicyController::class, 'destroy']);

    // Wiadomosci
    Route::get('/wiadomosci', [WiadomosciController::class, 'index']);
    Route::get('/wiadomosci/create', [WiadomosciController::class, 'create']);
    Route::post('/wiadomosci', [WiadomosciController::class, 'store']);
    Route::get('/wiadomosci/{id}', [WiadomosciController::class, 'show']);
    Route::get('/wiadomosci/{id}/edit', [WiadomosciController::class, 'edit']);
    Route::put('/wiadomosci/{id}', [WiadomosciController::class, 'update']);
    Route::delete('/wiadomosci/{id}', [WiadomosciController::class, 'destroy']);

    // Wymiany
    Route::get('/wymiany', [WymianyController::class, 'index']);
    Route::get('/wymiany/create', [WymianyController::class, 'create']);
    Route::post('/wymiany', [WymianyController::class, 'store']);
    Route::get('/wymiany/{id}', [WymianyController::class, 'show']);
    Route::get('/wymiany/{id}/edit', [WymianyController::class, 'edit']);
    Route::put('/wymiany/{id}', [WymianyController::class, 'update']);
    Route::delete('/wymiany/{id}', [WymianyController::class, 'destroy']);
    Route::get('/exchange/request/{book_id}', [WymianyController::class, 'viewRequestExchange'])->name('exchange.view');
    Route::post('/exchange/request', [WymianyController::class, 'requestExchange'])->name('exchange.request');
    Route::get('/exchange/pending', [WymianyController::class, 'viewPendingExchanges'])->name('exchange.pending');
    Route::get('/exchange/accept/{id}', [WymianyController::class, 'acceptExchange'])->name('exchange.accept');
    Route::post('/exchange/accept/{id}', [WymianyController::class, 'acceptExchange'])->name('exchange.accept');
    Route::post('/exchange/deny/{id}', [WymianyController::class, 'denyExchange'])->name('exchange.deny');
    Route::post('/wymiany/{id}/accept', [WymianyController::class, 'acceptOffer'])->middleware('auth');

});
// Logowanie

Route::get('/loguj', [HomeController::class,'zmienStanUwierzytelnienia']);
Route::get('/wyloguj',[HomeController::class,'zmienStanUwierzytelnienia']);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/create', [AdminController::class, 'create']);
    Route::post('/admin/store', [AdminController::class, 'store']);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profil', [ProfilController::class, 'show']);
    Route::post('/profil', [ProfilController::class, 'update']);
});

require __DIR__.'/auth.php';
