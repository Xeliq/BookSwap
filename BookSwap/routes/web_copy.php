<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KsiazkiController;
use App\Http\Controllers\PunktyController;
use App\Http\Controllers\UzytkownicyController;
use App\Http\Controllers\WiadomosciController;
use App\Http\Controllers\WymianyController;

// Strona główna
Route::get('/', [HomeController::class, 'index']);

// Ksiazki
Route::get('/ksiazki', [KsiazkiController::class, 'index']);
Route::get('/ksiazki/create', [KsiazkiController::class, 'create']);
Route::post('/ksiazki', [KsiazkiController::class, 'store']);
Route::get('/ksiazki/{id}', [KsiazkiController::class, 'show']);
Route::get('/ksiazki/{id}/edit', [KsiazkiController::class, 'edit']);
Route::put('/ksiazki/{id}', [KsiazkiController::class, 'update']);
Route::delete('/ksiazki/{id}', [KsiazkiController::class, 'destroy']);

// Punkty
Route::get('/punkty', [PunktyController::class, 'index']);
Route::get('/punkty/create', [PunktyController::class, 'create']);
Route::post('/punkty', [PunktyController::class, 'store']);
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
