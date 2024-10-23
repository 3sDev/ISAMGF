<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\DemandePersonnelController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\FormationController;

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
Route::put('update-photoAvis/{id}',[AvisController::class, 'updatePhotoAvis']);
Route::put('update-photoPdf/{id}',[AvisController::class, 'updatePhotoPdf']);
Route::get('delete-avis/{id}', [AvisController::class, 'destroy']);

//Demandes Personnels Routes
Route::resource('/demandepersonnel',       DemandePersonnelController::class);
Route::post('show-demandepersonnel/{id}',   [DemandePersonnelController::class, 'show']);
Route::get('edit-demandepersonnel/{id}',   [DemandePersonnelController::class, 'edit']);
Route::get('update-demandepersonnel/{id}', [DemandePersonnelController::class, 'update']);
Route::get('delete-demandepersonnel/{id}', [DemandePersonnelController::class, 'destroy']);

//Reclamations Personnels Routes
Route::resource('/reclamations',      ReclamationController::class);
Route::get('show-reclamations/{id}',  [ReclamationController::class, 'show']);
Route::get('edit-reclamation/{id}',   [ReclamationController::class, 'edit']);
Route::get('update-reclamation/{id}', [ReclamationController::class, 'update']);
Route::get('delete-reclamation/{id}', [ReclamationController::class, 'destroy']);

//Teacher Routes
Route::resource('/personnels',         PersonnelController::class);
Route::get('/personnels/{id}/profile', [PersonnelController::class, 'addprofilePage']);
Route::post('personnelprofile', [PersonnelController::class, 'addprofileStore']);
Route::post('personnels', [PersonnelController::class, 'store']);
//Route::get('getPersonnel', [MessageController::class, 'getPersonnel'])->name('getPersonnel'); //MessageController
Route::get('getStudent', [MessageController::class, 'getStudent'])->name('getStudent'); //MessageController

Route::get('edit-personnel/{id}',          [PersonnelController::class, 'edit']);
Route::get('update-personnel/{id}',        [PersonnelController::class, 'update']);
Route::get('update-profilepersonnel/{id}', [PersonnelController::class, 'updateProfile']);
Route::get('delete-personnel/{id}',        [PersonnelController::class, 'destroy']);

//Messagerie
Route::resource('/message',         MessageController::class);
Route::get('/message',              [MessageController::class, 'index']);
Route::post('/addmessage',          [MessageController::class, 'store']);
Route::post('/addmessagemultiple',  [MessageController::class, 'storeServiceMultipleUsers']);
Route::post('/addmessageservice',   [MessageController::class, 'storeService']);
//Route::get('/message',            [MessageController::class, 'msgEnvoye']);
Route::get('show-message/{id}',     [MessageController::class, 'show']);
Route::get('show-message-service/{id}/{idMessageUser}', [MessageController::class, 'showService']);
Route::get('show-message-send/{message}', [MessageController::class, 'showServiceSend']);
Route::get('show-message-receive/{id}/{idMessageUser}', [MessageController::class, 'showServiceReceive']);
Route::get('edit-message/{id}',     [MessageController::class, 'edit']);
Route::get('update-message/{id}',   [MessageController::class, 'update']);
Route::get('reply-message/{idUser}/{nameUser}/{roleUser}',[MessageController::class, 'replayMessage']);
Route::get('corbeil-message/{id}',  [MessageController::class, 'corbeilMessage']);
Route::get('restaurer-message/{id}',[MessageController::class, 'restaurerMessage']);
Route::get('delete-message/{id}',   [MessageController::class, 'deleteMessage']);

//Agenda Routes
Route::resource('/agenda',           AgendaController::class);
Route::get('/agenda',                [AgendaController::class, 'liste']);
Route::get('dashboards',             [AgendaController::class, 'index']);
Route::post('agenda',                [AgendaController::class, 'store']);
Route::get('show-agenda/{id}',       [AgendaController::class, 'show']);
Route::get('edit-agenda/{id}',       [AgendaController::class, 'edit']);
Route::get('update-agenda/{id}',     [AgendaController::class, 'update']);
Route::put('update-fileAgenda/{id}', [AgendaController::class, 'updateFileAgenda']);
Route::get('delete-agenda/{id}',     [AgendaController::class, 'destroy']);

//Personnels Routes
Route::resource('/personnels',         PersonnelController::class);
Route::get('/personnels/{id}/profile', [PersonnelController::class, 'addprofilePage']);
Route::post('personnelprofile', [PersonnelController::class, 'addprofileStore']);
Route::post('personnels', [PersonnelController::class, 'store']);
//Route::get('getPersonnel', [MessageController::class, 'getPersonnel'])->name('getPersonnel'); //MessageController
Route::get('getStudent', [MessageController::class, 'getStudent'])->name('getStudent'); //MessageController
Route::get('edit-personnel/{id}',          [PersonnelController::class, 'edit']);
Route::put('update-personnel/{id}',        [PersonnelController::class, 'update']);
Route::put('update-profilePersonnel/{id}', [PersonnelController::class, 'updateProfile']);
Route::get('delete-personnel/{id}',        [PersonnelController::class, 'destroy']);

//Ordres et Missions Routes
Route::resource('/missions',       MissionController::class);
Route::post('missions',            [MissionController::class, 'store']);
Route::get('show-missions/{id}',   [MissionController::class, 'show']);
Route::get('edit-missions/{id}',   [MissionController::class, 'edit']);
Route::get('update-missions/{id}', [MissionController::class, 'update']);
Route::put('update-missionFile/{id}', [MissionController::class, 'updateFileMission']);
Route::get('delete-missions/{id}', [MissionController::class, 'destroy']);

//Attendance Personnels Routes
Route::get('attendances',            [AttendanceController::class, 'index']);
Route::post('create-attendance',     [AttendanceController::class, 'create']);
Route::post('save-attendances',      [AttendanceController::class, 'store']);
Route::get('show-attendance/{id}',   [AttendanceController::class, 'show']);
Route::get('edit-attendance/{id}',   [AttendanceController::class, 'edit']);
Route::put('update-attendance/{id}', [AttendanceController::class, 'update']);
Route::get('delete-attendance/{id}', [AttendanceController::class, 'destroy']);
Route::get('delete-attendancePageCreate/{id}', [AttendanceController::class, 'destroyPageCreate']);

//Congés Routes
Route::resource('/conges',      CongeController::class);
Route::post('conges',           [CongeController::class, 'store']);
Route::get('show-conge/{id}',   [CongeController::class, 'show']);
Route::get('edit-conge/{id}/{personnel}', [CongeController::class, 'edit']);
Route::get('show-DemandeConge/{id}/{personnel}', [CongeController::class, 'showDemandeConge']);
Route::get('update-conge/{id}', [CongeController::class, 'update']);
Route::put('update-fileConge/{id}',  [CongeController::class, 'updateFileConge']);
Route::get('delete-conge/{id}', [CongeController::class, 'destroy']);
//Soldes congés personnels Routes
Route::get('soldes',   [CongeController::class, 'indexSolde']);
Route::get('edit-solde/{id}',  [CongeController::class, 'editSolde']);
Route::post('addSoldeAndAnnee', [CongeController::class, 'addSoldeAndAnnee']);
Route::post('save-solde-personnel', [CongeController::class, 'saveSoldePersonnel']);
Route::get('update-solde/{id}',[CongeController::class, 'updateSolde']);
Route::get('delete-elementSolde/{id}/{idPersonnel}',[CongeController::class, 'destroySoldePersonnel']);


//Notes Professionnelles Routes
Route::resource('/notes',      NoteController::class);
Route::post('notes',           [NoteController::class, 'store']);
Route::get('show-note/{id}',   [NoteController::class, 'show']);
Route::get('edit-note/{id}',   [NoteController::class, 'edit']);
Route::get('update-note/{id}', [NoteController::class, 'update']);
Route::get('delete-note/{id}', [NoteController::class, 'destroy']);

//Formations Routes
Route::resource('/formations',      FormationController::class);
Route::post('formations',           [FormationController::class, 'store']);
Route::get('show-formation/{id}',   [FormationController::class, 'show']);
Route::get('edit-formation/{id}',   [FormationController::class, 'edit']);
Route::get('update-formation/{id}', [FormationController::class, 'update']);
Route::put('update-formationFile/{id}', [FormationController::class, 'updateFileFormation']);
Route::get('delete-formation/{id}', [FormationController::class, 'destroy']);

Route::get('getSoldePersonnelAjax/{idPersonnel}/{idCategorie}/{annee}', [CongeController::class, 'getSoldePersonnelAjax'])->name('getSoldePersonnelAjax');

Route::get('dashboards', [DashboardController::class, 'countIndicator']);

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