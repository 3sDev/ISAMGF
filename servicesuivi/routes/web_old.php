<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmploiTeacherController;
use App\Http\Controllers\ClasseController;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('empty', function () {
    return view('empty');
});

Route::get('dashboards', function () {
    return view('dashboard');
});

//Student Routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

//Matières Routes
Route::resource('/matieres',       MatiereController::class);
Route::post('matieres',            [MatiereController::class, 'store']);
Route::get('show-matieres/{id}',   [MatiereController::class, 'show']);
Route::get('edit-matieres/{id}',   [MatiereController::class, 'edit']);
Route::get('update-matiere/{id}',  [MatiereController::class, 'update']);
Route::get('delete-matiere/{id}',  [MatiereController::class, 'destroy']);

//Salles Routes
Route::resource('/salles',       SalleController::class);
Route::post('salles',            [SalleController::class, 'store']);
Route::get('show-salles/{id}',   [SalleController::class, 'show']);
Route::get('edit-salles/{id}',   [SalleController::class, 'edit']);
Route::get('update-salle/{id}',  [SalleController::class, 'update']);
Route::get('delete-salle/{id}',  [SalleController::class, 'destroy']);
//Salle Disponible
Route::get('/salledisponible',          [SalleController::class, 'disponibleSalle']);
Route::get('/emploi-salle/{id}',        [SalleController::class, 'emploiSalle']);
Route::get('/edit-seance-salle/{id}',   [SalleController::class, 'editSeanceSalle']);
Route::get('/update-seance-salle/{id}', [SalleController::class, 'updateSeanceSalle']);


//Library(bibliothèque) Routes
Route::resource('/stages',      StageController::class);
Route::post('stages',           [StageController::class, 'store']);
Route::get('getStudent',        [StageController::class, 'getStudent'])->name('getStudent');
Route::get('show-stage/{id}',   [StageController::class, 'show']);
Route::get('edit-stage/{id}',   [StageController::class, 'edit']);
Route::put('update-stage/{id}', [StageController::class, 'update']);
Route::get('delete-stage/{id}', [StageController::class, 'destroy']);

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

//Avis Routes
Route::resource('/avis',       AvisController::class);
Route::post('avis',            [AvisController::class, 'store']);
Route::get('show-avis/{id}',   [AvisController::class, 'show']);
Route::get('edit-avis/{id}',   [AvisController::class, 'edit']);
Route::get('update-avis/{id}', [AvisController::class, 'update']);
Route::get('delete-avis/{id}', [AvisController::class, 'destroy']);

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
Route::get('update-teacher/{id}',        [TeacherController::class, 'update']);
Route::get('update-profileteacher/{id}', [TeacherController::class, 'updateProfile']);
Route::get('delete-teacher/{id}',        [TeacherController::class, 'destroy']);
Route::delete('deletematiere/{id}', [TeacherController::class, 'destroyMatiereFromTeacher']);

//Agenda Routes
Route::resource('/agenda',       AgendaController::class);
Route::get('/agenda',            [AgendaController::class, 'liste']);
Route::get('dashboards',         [AgendaController::class, 'index']);
Route::post('agenda',            [AgendaController::class, 'store']);
Route::get('show-agenda/{id}',   [AgendaController::class, 'show']);
Route::get('edit-agenda/{id}',   [AgendaController::class, 'edit']);
Route::get('update-agenda/{id}', [AgendaController::class, 'update']);
Route::get('delete-agenda/{id}', [AgendaController::class, 'destroy']);

//Attendance Teachers Routes 
Route::post('show-attendances',      [AttendanceController::class, 'show']);
Route::post('show-justification',    [AttendanceController::class, 'showJustification']);
Route::get('student-attendance',     [AttendanceController::class, 'index']); 

Route::get('edit-attendance/{id}',   [AttendanceController::class, 'edit']); 
Route::get('update-attendance/{id}', [AttendanceController::class, 'update']); 
Route::get('/justifications',        [AttendanceController::class, 'selectJustification']); 

//Teacher   
Route::put('update-teacher-account/{id}', [TeacherController::class, 'updateAccount']);
Route::get('scheduleteacher', [TeacherController::class, 'scheduleteacher']);
Route::get('teachers-schedule/{id}', [TeacherController::class, 'scheduleteacherDetails']);
Route::post('seance-teacher', [EmploiTeacherController::class, 'store']); //EmploiTeacherController
Route::delete('deleteseance/{id}', [EmploiTeacherController::class, 'destroy']);

//Classe Emploi
Route::get('scheduleclasse',      [ClasseController::class, 'index']);
Route::get('emploi-classe/{id}', [ClasseController::class, 'getScheduleFromClasse']);
Route::get('show-agenda/{id}',    [ClasseController::class, 'show']);
Route::get('edit-agenda/{id}',    [ClasseController::class, 'edit']);
Route::get('update-agenda/{id}',  [ClasseController::class, 'update']);
Route::get('delete-agenda/{id}',  [ClasseController::class, 'destroy']);
//
Route::get('getMatiere',         [TeacherController::class, 'getMatiere'])->name('getMatiere');
Route::get('/dynamic_dependent', [TeacherController::class, 'getAllSalles']);
Route::post('/dynamic_dependent/fetch', [TeacherController::class, 'fetch'])->name('dynamicdependent.fetch');
Route::get('fetch', [TeacherController::class, 'fetch']);
Route::get('getAllSalles', [TeacherController::class, 'getAllSalles']);
Route::get('getHeureByDay/{id_salle}/{nom_jour}', [TeacherController::class, 'getHeureByDay']);

//Presences Enseignants  
Route::get('presences',             [AttendanceController::class, 'listOfTeachers']);
Route::get('saisir-presence/{id}',  [AttendanceController::class, 'saisirPresence']);
Route::post('save-attendance',      [AttendanceController::class, 'store']);
Route::get('edit-presence/{id}',    [AttendanceController::class, 'edit']);
Route::put('update-attendance/{id}',  [AttendanceController::class, 'update']);
Route::delete('delete-attendance/{id}', [AttendanceController::class, 'destroy']);

//Route::get('seance-teacher', [EmploiTeacherController::class, 'allSeancesFromIdTeacher']);

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