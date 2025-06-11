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

    // Ksiazki
    Route::get('/ksiazki', [KsiazkiController::class, 'index'])->middleware('auth', 'admin');
    Route::get('/ksiazki/create', [KsiazkiController::class, 'create'])->middleware('auth');
    Route::post('/ksiazki', [KsiazkiController::class, 'store'])->middleware('auth');
    Route::get('/ksiazki/search', [KsiazkiController::class, 'search']);
    Route::get('/ksiazki/{id}', [KsiazkiController::class, 'show'])->where('id', '[0-9]+');
    Route::get('/ksiazki/{id}/edit', [KsiazkiController::class, 'edit'])->middleware('auth');
    Route::put('/ksiazki/{id}', [KsiazkiController::class, 'update'])->middleware('auth');
    Route::delete('/ksiazki/{id}', [KsiazkiController::class, 'destroy'])->middleware('auth');
    Route::get('/ksiazki/gatunek/{gatunek}', [KsiazkiController::class, 'filterByGatunek']);

    // Punkty
    Route::get('/punkty', [PunktyController::class, 'index'])->middleware('auth', 'admin');
    Route::get('/punkty/create', [PunktyController::class, 'create'])->middleware('auth', 'admin');
    Route::post('/punkty', [PunktyController::class, 'store'])->middleware('auth', 'admin');
    Route::get('/punkty/exchange', [PunktyController::class, 'showExchangeForm'])->name('punkty.exchange')->middleware('auth');
    Route::post('/punkty/exchange', [PunktyController::class, 'exchange'])->name('punkty.exchange.post')->middleware('auth');
    Route::get('/punkty/{id}', [PunktyController::class, 'show'])->middleware('auth', 'admin');
    Route::get('/punkty/{id}/edit', [PunktyController::class, 'edit'])->middleware('auth', 'admin');
    Route::put('/punkty/{id}', [PunktyController::class, 'update'])->middleware('auth', 'admin');
    Route::delete('/punkty/{id}', [PunktyController::class, 'destroy'])->middleware('auth', 'admin');

    Route::middleware(['auth', 'admin'])->group(function () {
        // Uzytkownicy
        Route::get('/uzytkownicy', [UzytkownicyController::class, 'index']);
        Route::get('/uzytkownicy/create', [UzytkownicyController::class, 'create']);
        Route::post('/uzytkownicy', [UzytkownicyController::class, 'store']);
        Route::get('/uzytkownicy/{id}', [UzytkownicyController::class, 'show']);
        Route::get('/uzytkownicy/{id}/edit', [UzytkownicyController::class, 'edit']);
        Route::put('/uzytkownicy/{id}', [UzytkownicyController::class, 'update']);
        Route::delete('/uzytkownicy/{id}', [UzytkownicyController::class, 'destroy']);
    });

    // Wiadomosci
    Route::get('/wiadomosci', [WiadomosciController::class, 'index'])->middleware('auth', 'admin');
    Route::get('/wiadomosci/create', [WiadomosciController::class, 'create'])->middleware('auth');
    Route::post('/wiadomosci', [WiadomosciController::class, 'store'])->middleware('auth');
    Route::get('/wiadomosci/{id}', [WiadomosciController::class, 'show'])->middleware('auth', 'admin');
    Route::get('/wiadomosci/{id}/edit', [WiadomosciController::class, 'edit'])->middleware('auth', 'admin');
    Route::put('/wiadomosci/{id}', [WiadomosciController::class, 'update'])->middleware('auth', 'admin');
    Route::delete('/wiadomosci/{id}', [WiadomosciController::class, 'destroy'])->middleware('auth', 'admin');

    Route::middleware(['auth', 'admin'])->group(function () {
        // Wymiany
        Route::get('/wymiany', [WymianyController::class, 'index']);
        Route::get('/wymiany/create', [WymianyController::class, 'create']);
        Route::post('/wymiany', [WymianyController::class, 'store']);
        Route::get('/wymiany/{id}', [WymianyController::class, 'show']);
        Route::get('/wymiany/{id}/edit', [WymianyController::class, 'edit']);
        Route::put('/wymiany/{id}', [WymianyController::class, 'update']);
        Route::delete('/wymiany/{id}', [WymianyController::class, 'destroy']);
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/exchange/request/{book_id}', [WymianyController::class, 'viewRequestExchange'])->name('exchange.view');
        Route::post('/exchange/request', [WymianyController::class, 'requestExchange'])->name('exchange.request');
        Route::get('/exchange/pending', [WymianyController::class, 'viewPendingExchanges'])->name('exchange.pending');
        Route::get('/exchange/accept/{id}', [WymianyController::class, 'acceptExchange'])->name('exchange.accept');
        Route::post('/exchange/accept/{id}', [WymianyController::class, 'acceptExchange'])->name('exchange.accept');
        Route::get('/exchange/deny/{id}', [WymianyController::class, 'denyExchange'])->name('exchange.deny');
        Route::post('/exchange/deny/{id}', [WymianyController::class, 'denyExchange'])->name('exchange.deny');
        Route::post('/wymiany/{id}/accept', [WymianyController::class, 'acceptOffer']);
    });

// Logowanie

Route::get('/loguj', [HomeController::class,'zmienStanUwierzytelnienia']);
Route::get('/wyloguj',[HomeController::class,'zmienStanUwierzytelnienia']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/create', [AdminController::class, 'create']);
    Route::post('/admin/store', [AdminController::class, 'store']);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth', 'admin');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth', 'admin');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('auth', 'admin');
    Route::get('/profil', [ProfilController::class, 'show']);
    Route::post('/profil', [ProfilController::class, 'update']);
});

require __DIR__.'/auth.php';
