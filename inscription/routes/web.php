<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscriptionController;

 

//Inscription Routes

Route::get('inscription',      [InscriptionController::class, 'index']);
Route::post('inscription',     [InscriptionController::class, 'store']);

Route::get('inscription-new',  [InscriptionController::class, 'indexNew']);
Route::post('inscription-new', [InscriptionController::class, 'storeNew']);

Route::get('login-verify/',    [InscriptionController::class, 'verify']);
Route::post('verification/',   [InscriptionController::class, 'verification']);
//Route::get('fiche-inscription/',    [InscriptionController::class, 'verification']);

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard'); })->name('dashboard');
    Route::get('profile.show', [StudentController::class, 'monProfil']);
});