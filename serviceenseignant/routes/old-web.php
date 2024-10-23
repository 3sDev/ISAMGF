<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DemandeTeacherController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\RattrapageController;

Route::get('test', function () {
    return view('test');
});

Route::get('empty', function () {
    return view('empty');
});

Route::get('dashboards', function () {
    return view('dashboard');
});

//Student Routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

//Avis Routes
Route::resource('/avis',       AvisController::class);
Route::post('avis',            [AvisController::class, 'store']);
Route::get('show-avis/{id}',   [AvisController::class, 'show']);
Route::get('edit-avis/{id}',   [AvisController::class, 'edit']);
Route::get('update-avis/{id}', [AvisController::class, 'update']);
Route::get('delete-avis/{id}', [AvisController::class, 'destroy']);

//Demande Enseignant Routes
Route::resource('/demandeteacher',       DemandeTeacherController::class);
Route::get('show-demandeteacher/{id}',   [DemandeTeacherController::class, 'show']);
Route::get('edit-demandeteacher/{id}',   [DemandeTeacherController::class, 'edit']);
Route::get('update-demandeteacher/{id}', [DemandeTeacherController::class, 'update']);
Route::get('delete-demandeteacher/{id}', [DemandeTeacherController::class, 'destroy']);

//Reclamation Enseignant Routes
Route::resource('/reclamations',      ReclamationController::class);
Route::get('show-reclamations/{id}',  [ReclamationController::class, 'show']);
Route::get('edit-reclamation/{id}',   [ReclamationController::class, 'edit']);
Route::get('update-reclamation/{id}', [ReclamationController::class, 'update']);
Route::get('delete-reclamation/{id}', [ReclamationController::class, 'destroy']);

//Teacher Routes
// Route::resource('/classes',      ClasseController::class);
// Route::get('getSection',         [ClasseController::class, 'getSection'])->name('getSection');
// Route::get('edit-classe/{id}',   [ClasseController::class, 'edit']);
// Route::get('update-classe/{id}', [ClasseController::class, 'update']);
// Route::get('delete-classe/{id}', [LevelController::class, 'destroy']);

Route::resource('/teachers',         TeacherController::class);
Route::get('/teachers/{id}/profile', [TeacherController::class, 'addprofilePage']);

Route::post('teacherprofile', [TeacherController::class, 'addprofileStore']);
Route::post('teachers', [TeacherController::class, 'store']);

//Route::get('getTeacher', [MessageController::class, 'getTeacher'])->name('getTeacher'); //MessageController
Route::get('getStudent', [MessageController::class, 'getStudent'])->name('getStudent'); //MessageController

Route::get('edit-teacher/{id}',          [TeacherController::class, 'edit']);
Route::get('update-teacher/{id}',        [TeacherController::class, 'update']);
Route::get('update-profileteacher/{id}', [TeacherController::class, 'updateProfile']);
Route::get('delete-teacher/{id}',        [TeacherController::class, 'destroy']);

//Messagerie
Route::resource('/message', MessageController::class);
Route::get('/message', [MessageController::class, 'index']);
Route::post('/addmessage', [MessageController::class, 'store']);
Route::post('/addmessageservice', [MessageController::class, 'storeService']);
//Route::get('/message', [MessageController::class, 'msgEnvoye']);
Route::get('show-message/{id}', [MessageController::class, 'show']);
Route::get('show-message-service/{id}', [MessageController::class, 'showService']);
Route::get('edit-message/{id}', [MessageController::class, 'edit']);
Route::get('update-message/{id}', [MessageController::class, 'update']);
Route::get('delete-message/{id}', [MessageController::class, 'destroy']);

//Agenda Routes
Route::resource('/agenda',       AgendaController::class);
Route::get('/agenda',            [AgendaController::class, 'liste']);
Route::get('dashboards',         [AgendaController::class, 'index']);
Route::post('agenda',            [AgendaController::class, 'store']);
Route::get('show-agenda/{id}',   [AgendaController::class, 'show']);
Route::get('edit-agenda/{id}',   [AgendaController::class, 'edit']);
Route::get('update-agenda/{id}', [AgendaController::class, 'update']);
Route::get('delete-agenda/{id}', [AgendaController::class, 'destroy']);

//Rattrapage Routes
Route::resource('/rattrapage',       RattrapageController::class);
Route::get('rattrapage',             [RattrapageController::class, 'index']);
Route::post('rattrapages',           [RattrapageController::class, 'store']);
Route::get('show-rattrapage/{id}',   [RattrapageController::class, 'show']);
Route::get('edit-rattrapage/{id}',   [RattrapageController::class, 'edit']);
Route::get('update-rattrapage/{id}', [RattrapageController::class, 'update']);
Route::get('delete-rattrapage/{id}', [RattrapageController::class, 'destroy']);

});



Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard'); })->name('dashboard');
    Route::get('profile.show', [StudentController::class, 'monProfil']);
    //Route::get('/user/profile', [StudentController::class, 'monProfil']);
});

// Route::get('login/locked', 'Auth\LoginController@locked')->middleware('auth')->name('login.locked');
// Route::post('login/locked', 'Auth\LoginController@unlock')->name('login.unlock');