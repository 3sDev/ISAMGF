<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DemandeTeacherController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\PointageController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\RattrapageController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\SpecialiteEnseignantController;

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

//Demande Enseignant Routes
Route::resource('/demandeteacher',       DemandeTeacherController::class);
Route::post('show-demandeteacher/{id}',   [DemandeTeacherController::class, 'show']);
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
Route::get('teachers-matieres/{id}', [TeacherController::class, 'affecter']);
Route::post('teachers', [TeacherController::class, 'store']);
Route::post('matiereregistre', [TeacherController::class, 'multiMatiere']);

//Route::get('getTeacher', [MessageController::class, 'getTeacher'])->name('getTeacher'); //MessageController
Route::get('getStudent', [MessageController::class, 'getStudent'])->name('getStudent'); //MessageController

Route::get('edit-teacher/{id}',          [TeacherController::class, 'edit']);
Route::put('update-teacher/{id}',        [TeacherController::class, 'update']);
Route::put('update-photo/{id}',          [TeacherController::class, 'updateProfile']);
// Route::get('update-profileteacher/{id}', [TeacherController::class, 'updateProfile']);
Route::get('delete-teacher/{id}',        [TeacherController::class, 'destroy']);
Route::delete('deletematiere/{id}', [TeacherController::class, 'destroyMatiereFromTeacher']);

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

//Rattrapage Routes
Route::resource('/rattrapage',       RattrapageController::class);
Route::get('rattrapage',             [RattrapageController::class, 'index']);
Route::post('rattrapages',           [RattrapageController::class, 'store']);
Route::get('show-rattrapage/{id}',   [RattrapageController::class, 'show']);
Route::get('edit-rattrapage/{id}',   [RattrapageController::class, 'edit']);
Route::put('update-rattrapage/{id}', [RattrapageController::class, 'update']);
Route::get('delete-rattrapage/{id}', [RattrapageController::class, 'destroy']);

//Teacher   
Route::put('update-teacher-account/{id}', [TeacherController::class, 'updateAccount']);
Route::get('scheduleteacher', [TeacherController::class, 'scheduleteacher']);
Route::get('teachers-schedule/{id}', [TeacherController::class, 'scheduleteacherDetails']);
Route::post('seance-teacher', [EmploiTeacherController::class, 'store']); //EmploiTeacherController
Route::delete('deleteseance/{id}', [EmploiTeacherController::class, 'destroy']);

//pointage Enseignant Routes
Route::get('pointages',            [PointageController::class, 'index']);
Route::post('create-pointage',     [PointageController::class, 'create']);
Route::post('save-pointages',      [PointageController::class, 'store']);
Route::get('show-pointage/{id}',   [PointageController::class, 'show']);
Route::get('edit-pointage/{id}',   [PointageController::class, 'edit']);
Route::get('update-pointage/{id}', [PointageController::class, 'update']);
Route::get('delete-pointage/{id}', [PointageController::class, 'destroy']);
Route::get('delete-pointagePageCreate/{id}', [PointageController::class, 'destroyPageCreate']);

//Attendance Enseignant Routes
Route::get('attendances',            [AttendanceController::class, 'index']);
Route::post('create-attendance',     [AttendanceController::class, 'create']);
Route::post('save-attendances',      [AttendanceController::class, 'store']);
Route::get('show-attendance/{id}',   [AttendanceController::class, 'show']);
Route::get('edit-attendance/{id}',   [AttendanceController::class, 'edit']);
Route::put('update-attendance/{id}', [AttendanceController::class, 'update']);
Route::get('delete-attendance/{id}', [AttendanceController::class, 'destroy']);
Route::get('delete-attendancePageCreate/{id}', [AttendanceController::class, 'destroyPageCreate']);

//Spécialités Routes
Route::resource('/specialites',      SpecialiteController::class);
Route::post('specialites',           [SpecialiteController::class, 'store']);
Route::get('edit-specialite/{id}',   [SpecialiteController::class, 'edit']);
Route::get('update-specialite/{id}', [SpecialiteController::class, 'update']);
Route::get('delete-specialite/{id}', [SpecialiteController::class, 'destroy']);

//Spécialités Enseigants Routes
Route::resource('/specialiteTeachers', SpecialiteEnseignantController::class);
Route::get('allSpecialitesTeachers',   [SpecialiteEnseignantController::class, 'index']);
Route::post('specialiteTeacher',       [SpecialiteEnseignantController::class, 'store']);
Route::get('delete-specialite/{id}',   [SpecialiteEnseignantController::class, 'destroy']);

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