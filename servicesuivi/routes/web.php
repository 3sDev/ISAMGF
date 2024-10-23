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
use App\Http\Controllers\PointageController;
use App\Http\Controllers\RattrapageController;
use App\Http\Controllers\BibliothequeController;
use App\Http\Controllers\AvisTeacherController;
use App\Http\Controllers\DashboardController;

//Emploi de temps
use App\Http\Controllers\Emploi\MatiereTeacherController;
use App\Http\Controllers\Emploi\MatiereClasseController;
use App\Http\Controllers\Emploi\EmploiTempsFileController;
use App\Http\Controllers\Emploi\EmploiTempsFileStudentController;

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

//Salles Routes
Route::resource('/salles',       SalleController::class);
Route::post('salles',            [SalleController::class, 'store']);
Route::get('show-salles/{id}',   [SalleController::class, 'show']);
Route::get('edit-salles/{id}',   [SalleController::class, 'edit']);
Route::get('update-salle/{id}',  [SalleController::class, 'update']);
Route::get('delete-salle/{id}',  [SalleController::class, 'destroy']);

//Salle Disponible Routes
Route::get('/salledisponible',          [SalleController::class, 'disponibleSalle']);
Route::get('/sallestatut',              [SalleController::class, 'saisirJourDisponibilite']);
Route::get('/emploi-salle/{id}',        [SalleController::class, 'emploiSalle']);
Route::get('/emploi-salle-semestre/{id}/{semestre}', [SalleController::class, 'emploiSalleSemestre']);
Route::get('/edit-seance-salle/{id}',   [SalleController::class, 'editSeanceSalle']);
Route::get('/update-seance-salle/{id}', [SalleController::class, 'updateSeanceSalle']);
Route::post('/display-salle',           [SalleController::class, 'salleDisponibiliteByDay']);
Route::get('/reserver-salle',           [SalleController::class, 'reserverSalleEmploi']);
Route::post('/reserver-seance-salle',   [SalleController::class, 'reserverSeanceToSalle']);
Route::put('/modifier-statut-salle',    [SalleController::class, 'updateStatutSalle']);

//Classe Routes
Route::get('all-classes',      [ClasseController::class, 'index']);
Route::get('classe-matieres/{id}', [ClasseController::class, 'affecter']);
Route::post('matiereregistreByClasse', [ClasseController::class, 'multiMatiere']);
Route::delete('deletematiereByClasse/{id}', [ClasseController::class, 'destroyMatiereFromClasse']);
Route::get('emploi-classe/{id}', [ClasseController::class, 'getScheduleFromClasse']);


//Library(bibliothèque) Routes
Route::resource('/stages',      StageController::class);
Route::post('stages',           [StageController::class, 'store']);
Route::get('getStudent',        [StageController::class, 'getStudent'])->name('getStudent');
Route::get('show-stage/{id}',   [StageController::class, 'show']);
Route::get('edit-stage/{id}',   [StageController::class, 'edit']);
Route::put('update-stage/{id}', [StageController::class, 'update']);
Route::get('delete-stage/{id}', [StageController::class, 'destroy']);

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

//APi Teachers
Route::resource('/teachers',         TeacherController::class);
Route::get('/teachers/{id}/profile', [TeacherController::class, 'addprofilePage']);
Route::post('teacherprofile', [TeacherController::class, 'addprofileStore']);
Route::get('teachers-matieres/{id}', [TeacherController::class, 'affecter']);
Route::post('teachers', [TeacherController::class, 'store']);
Route::post('matiereregistre', [TeacherController::class, 'multiMatiere']);
Route::get('getStudent', [MessageController::class, 'getStudent'])->name('getStudent'); //MessageController
Route::get('edit-teacher/{id}',          [TeacherController::class, 'edit']);
Route::put('update-teacher/{id}',        [TeacherController::class, 'update']);
Route::put('update-photo/{id}',          [TeacherController::class, 'updateProfile']);
Route::get('delete-teacher/{id}',        [TeacherController::class, 'destroy']);
Route::delete('deletematiere/{id}', [TeacherController::class, 'destroyMatiereFromTeacher']);

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

//Classe Emploi+Classe
Route::get('scheduleclasse',     [ClasseController::class, 'index']);
Route::get('emploi-classe/{id}', [ClasseController::class, 'getScheduleFromClasse']);
Route::get('createClasse',       [ClasseController::class, 'create']);
Route::post('classes',           [ClasseController::class, 'store']);
Route::get('delete-classe/{id}', [ClasseController::class, 'destroy']);
Route::get('getMatiere',         [TeacherController::class, 'getMatiere'])->name('getMatiere');
Route::get('/dynamic_dependent', [TeacherController::class, 'getAllSalles']);
Route::post('/dynamic_dependent/fetch', [TeacherController::class, 'fetch'])->name('dynamicdependent.fetch');
Route::get('fetch', [TeacherController::class, 'fetch']);
Route::get('getAllSalles', [TeacherController::class, 'getAllSalles']);
Route::get('getHeureByDay/{id_salle}/{nom_jour}', [TeacherController::class, 'getHeureByDay']);
Route::get('disponibiliteSalles/{debut}/{fin}/{day}', [RattrapageController::class, 'disponibiliteSalles']);


//Emplois de temps de type File teacher
Route::resource('/emploi',       EmploiTempsFileController::class);
Route::get('emploi', [EmploiTempsFileController::class, 'index']);
Route::post('emploi-teacher-file', [EmploiTempsFileController::class, 'store']);
Route::get('show-emploiTeacher/{id}',   [EmploiTempsFileController::class, 'show']);
Route::get('edit-emploiTeacher/{id}',   [EmploiTempsFileController::class, 'edit']);
Route::put('update-emploiTeacher/{id}', [EmploiTempsFileController::class, 'update']);
Route::put('update-photoEmploi/{id}',   [EmploiTempsFileController::class, 'photoEmploi']);
Route::get('delete-emploiTeacher/{id}', [EmploiTempsFileController::class, 'destroy']);

//Emplois de temps de type File student
Route::resource('/emplois',       EmploiTempsFileStudentController::class);
Route::get('emplois', [EmploiTempsFileStudentController::class, 'index']);
Route::post('emploi-student-file', [EmploiTempsFileStudentController::class, 'store']);
Route::get('show-emploiStudent/{id}',   [EmploiTempsFileStudentController::class, 'show']);
Route::get('edit-emploiStudent/{id}',   [EmploiTempsFileStudentController::class, 'edit']);
Route::put('update-emploiStudent/{id}', [EmploiTempsFileStudentController::class, 'update']);
Route::put('update-photoEmploiStudent/{id}',   [EmploiTempsFileStudentController::class, 'photoEmploi']);
Route::get('delete-emploiStudent/{id}', [EmploiTempsFileStudentController::class, 'destroy']);

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

//Rattrapage Routes
Route::resource('/rattrapage',       RattrapageController::class);
Route::get('rattrapage',             [RattrapageController::class, 'index']);
Route::post('rattrapages',           [RattrapageController::class, 'store']);
Route::get('show-rattrapage/{id}',   [RattrapageController::class, 'show']);
Route::get('edit-rattrapage/{id}',   [RattrapageController::class, 'edit']);
Route::put('update-rattrapage/{id}', [RattrapageController::class, 'update']);
Route::get('delete-rattrapage/{id}', [RattrapageController::class, 'destroy']);

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