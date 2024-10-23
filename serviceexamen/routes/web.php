<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DemandeStudentController;
use App\Http\Controllers\AvisTeacherController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\DevoirController;
use App\Http\Controllers\DashboardController;

//Emploi de temps
use App\Http\Controllers\Emploi\NoteController;
use App\Http\Controllers\Emploi\EmploiExamenFileController;
use App\Http\Controllers\Emploi\EmploiExamenFileTeacherController;

use App\Http\Controllers\PostController;
Route::resource('posts', PostController::class);

Route::get('test', function () {
    return view('test');
});

Route::get('empty', function () {
    return view('empty');
});

Route::get('dashboards', function () {
    return view('dashboard');
});


//Route::group(['middleware' => 'APIToken'], function() {
//Student Routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

//Messagerie
Route::resource('/message',         MessageController::class);
Route::get('/message',              [MessageController::class, 'index']);
Route::post('/addmessage',          [MessageController::class, 'store']);
Route::post('/addmessagemultiple',  [MessageController::class, 'storeServiceMultipleUsers']);
Route::post('/addmessageservice',   [MessageController::class, 'storeService']);
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

//Demande Etudiant Routes
Route::resource('/demandestudent',       DemandeStudentController::class);
Route::get('show-demandestudent/{id}',   [DemandeStudentController::class, 'show']);
Route::get('edit-demandestudent/{id}',   [DemandeStudentController::class, 'edit']);
Route::get('update-demandestudent/{id}', [DemandeStudentController::class, 'update']);
Route::get('delete-demandestudent/{id}', [DemandeStudentController::class, 'destroy']);

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

//Avis Students Routes
Route::resource('/avis',       AvisController::class);
Route::post('avis',            [AvisController::class, 'store']);
Route::get('show-avis/{id}',   [AvisController::class, 'show']);
Route::get('edit-avis/{id}',   [AvisController::class, 'edit']);
Route::get('update-avis/{id}', [AvisController::class, 'update']);
Route::put('update-photoAvis/{id}',[AvisController::class, 'updatePhotoAvis']);
Route::put('update-photoPdf/{id}',[AvisController::class, 'updatePhotoPdf']);
Route::get('delete-avis/{id}', [AvisController::class, 'destroy']);

//Avis Teachers Routes
Route::resource('/avisTeacher',       AvisTeacherController::class);
Route::post('avisTeacher',            [AvisTeacherController::class, 'store']);
Route::get('show-avisTeacher/{id}',   [AvisTeacherController::class, 'show']);
Route::get('edit-avisTeacher/{id}',   [AvisTeacherController::class, 'edit']);
Route::get('update-avisTeacher/{id}', [AvisTeacherController::class, 'update']);
Route::put('update-photoAvisTeacher/{id}',[AvisTeacherController::class, 'updatePhotoAvis']);
Route::put('update-photoPdfTeacher/{id}',[AvisTeacherController::class, 'updatePhotoPdf']);
Route::get('delete-avisTeacher/{id}', [AvisTeacherController::class, 'destroy']);

//Emplois des examens de type File student 
Route::resource('/emploiExamens',       EmploiExamenFileController::class);
Route::get('emploi', [EmploiExamenFileController::class, 'index']);
Route::post('emploi-examen-student', [EmploiExamenFileController::class, 'store']);
Route::get('show-emploiExamenStudent/{id}',   [EmploiExamenFileController::class, 'show']);
Route::get('edit-emploiExamenStudent/{id}',   [EmploiExamenFileController::class, 'edit']);
Route::put('update-emploiExamenStudent/{id}', [EmploiExamenFileController::class, 'update']);
Route::put('update-photoEmploiExamen/{id}',   [EmploiExamenFileController::class, 'photoEmploi']);
Route::get('delete-emploiExamenStudent/{id}', [EmploiExamenFileController::class, 'destroy']);

//Emplois des examens de type File teacher 
Route::resource('/emploiExamensTeacher',       EmploiExamenFileTeacherController::class);
Route::get('emploiSurveillances', [EmploiExamenFileTeacherController::class, 'index']);
Route::post('emploi-examen-teacher', [EmploiExamenFileTeacherController::class, 'store']);
Route::get('show-emploiExamenTeacher/{id}',   [EmploiExamenFileTeacherController::class, 'show']);
Route::get('edit-emploiExamenTeacher/{id}',   [EmploiExamenFileTeacherController::class, 'edit']);
Route::put('update-emploiExamenTeacher/{id}', [EmploiExamenFileTeacherController::class, 'update']);
Route::put('update-emploiSurveillanceTeacher/{id}', [EmploiExamenFileTeacherController::class, 'photoEmploiSurveillance']);
Route::get('delete-emploiExamenTeacher/{id}', [EmploiExamenFileTeacherController::class, 'destroy']);

//Notes des étudants
Route::resource('/noteStudents',       NoteController::class);
Route::get('notes', [NoteController::class, 'index']);
Route::post('notes', [NoteController::class, 'store']);
Route::get('show-note/{id}',   [NoteController::class, 'show']);
Route::get('edit-note/{id}',   [NoteController::class, 'edit']);
Route::put('update-note/{id}', [NoteController::class, 'update']);
Route::put('update-noteFile/{id}', [NoteController::class, 'noteFileFn']);
Route::get('delete-note/{id}', [NoteController::class, 'destroy']);

Route::get('dashboards', [DashboardController::class, 'countIndicator']);

});

//});

Route::get('search-student', function () {
    return view('student.search');
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