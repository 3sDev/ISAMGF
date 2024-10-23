<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\DemandeStudentController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\RattrapageController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;

//Emploi de temps
use App\Http\Controllers\Emploi\EmploiTempsFileController;
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

//Avis Routes
Route::resource('/avis',       AvisController::class);
Route::post('avis',            [AvisController::class, 'store']);
Route::get('show-avis/{id}',   [AvisController::class, 'show']);
Route::get('edit-avis/{id}',   [AvisController::class, 'edit']);
Route::get('update-avis/{id}', [AvisController::class, 'update']);
Route::put('update-photoAvis/{id}',[AvisController::class, 'updatePhotoAvis']);
Route::put('update-photoPdf/{id}',[AvisController::class, 'updatePhotoPdf']);
Route::get('delete-avis/{id}', [AvisController::class, 'destroy']);

//Demande Etudiant Routes
Route::resource('/demandestudent',       DemandeStudentController::class);
Route::get('show-demandestudent/{id}',   [DemandeStudentController::class, 'show']);
Route::get('edit-demandestudent/{id}',   [DemandeStudentController::class, 'edit']);
Route::get('update-demandestudent/{id}', [DemandeStudentController::class, 'update']);
Route::get('delete-demandestudent/{id}', [DemandeStudentController::class, 'destroy']);

//Reclamation Etudiant Routes
Route::resource('/reclamations',      ReclamationController::class);
Route::get('show-reclamations/{id}',  [ReclamationController::class, 'show']);
Route::get('edit-reclamation/{id}',   [ReclamationController::class, 'edit']);
Route::get('update-reclamation/{id}', [ReclamationController::class, 'update']);
Route::get('delete-reclamation/{id}', [ReclamationController::class, 'destroy']);

//Classes Routes
Route::resource('/classes',      ClasseController::class);
Route::get('getSection',         [ClasseController::class, 'getSection'])->name('getSection');
Route::get('edit-classe/{id}',   [ClasseController::class, 'edit']);
Route::get('update-classe/{id}', [ClasseController::class, 'update']);
Route::get('delete-classe/{id}', [LevelController::class, 'destroy']);

Route::resource('/students',         StudentController::class);
Route::get('/students/{id}/profile', [StudentController::class, 'addprofilePage']);

Route::post('studentprofile', [StudentController::class, 'addprofileStore']);
Route::post('students', [StudentController::class, 'store']);

Route::get('getClasse', [StudentController::class, 'getClasse'])->name('getClasse');

Route::get('getStudent', [MessageController::class, 'getStudent'])->name('getStudent'); //MessageController

Route::get('edit-student/{id}',          [StudentController::class, 'edit']);
Route::put('update-student/{id}',        [StudentController::class, 'update']);
Route::get('update-profilestudent/{id}', [StudentController::class, 'updateProfile']);
Route::get('delete-student/{id}',        [StudentController::class, 'destroy']);
//Update Files Profile Student
Route::put('update-cin1/{id}',  [StudentController::class, 'updateCinF1']);
Route::put('update-cin2/{id}',  [StudentController::class, 'updateCinF2']);
Route::put('update-fiche/{id}', [StudentController::class, 'updateFichePay']);
Route::put('update-photo/{id}', [StudentController::class, 'updatePhotoPro']);

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


//Student
Route::get('add-student', [StudentController::class, 'create']);
Route::get('classe-student', [StudentController::class, 'classe']);
Route::get('classe-student-attendance', [StudentController::class, 'classeAttendance']);
Route::get('searchclasse', [StudentController::class, 'searchclasse']);
Route::get('search', [StudentController::class, 'search']);
Route::post('show-student-class', [StudentController::class, 'showclass']);
Route::put('update-student-account/{id}', [StudentController::class, 'updateAccount']);
//import Students
Route::get('import-student', [StudentController::class, 'import']);
Route::post('file-import',   [StudentController::class, 'fileImport']);
Route::get('filtrage',   [StudentController::class, 'filtrage']);
Route::put('update-passwordStudent/{id}', [StudentController::class, 'updatePasswordStudent']);
//Update Profil Student (CIN face 1 + CIN face 2 + Paiement + Photo profil)
// Route::put('update-cin/{id}',   [StudentController::class, 'updateCinFaceOne']);
// Route::put('update-cin2/{id}',  [StudentController::class, 'updateCinFaceTwo']);
// Route::put('update-fiche/{id}', [StudentController::class, 'updateFichePay']);
// Route::put('update-photo/{id}', [StudentController::class, 'updatePhotoprofil']);

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
Route::get('update-rattrapage/{id}', [RattrapageController::class, 'update']);
Route::get('delete-rattrapage/{id}', [RattrapageController::class, 'destroy']);

//Attendance Students Routes 
Route::get('classe-student-attendance', [AttendanceController::class, 'classeAttendance']);
Route::post('create-attendances',    [AttendanceController::class, 'show']);
Route::post('show-justification',    [AttendanceController::class, 'showJustification']);
Route::get('student-attendance',     [AttendanceController::class, 'index']); 
Route::post('/attendances',          [AttendanceController::class, 'store']);
Route::get('edit-attendance/{id}',   [AttendanceController::class, 'edit']); 
Route::get('update-attendance/{id}', [AttendanceController::class, 'update']); 
Route::get('/justifications',        [AttendanceController::class, 'selectJustification']); 
Route::get('/eliminations',          [AttendanceController::class, 'selectElimination']); 
Route::get('delete-attendance-student/{id}', [AttendanceController::class, 'destroy']);
Route::get('getMatiere',             [AttendanceController::class, 'getMatiere'])->name('getMatiere');
Route::post('/elimination-post',     [AttendanceController::class, 'getElimination']);
//Route::get('/elimination-list',      [AttendanceController::class, 'getElimination']);

//Emplois de temps de type File student 
Route::resource('/emploi',       EmploiTempsFileController::class);
Route::get('emploi', [EmploiTempsFileController::class, 'index']);
Route::post('emploi-teacher-file', [EmploiTempsFileController::class, 'store']);
Route::get('show-emploiStudent/{id}',   [EmploiTempsFileController::class, 'show']);
Route::get('edit-emploiStudent/{id}',   [EmploiTempsFileController::class, 'edit']);
Route::put('update-emploiStudent/{id}', [EmploiTempsFileController::class, 'update']);
Route::put('update-photoEmploi/{id}',   [EmploiTempsFileController::class, 'photoEmploi']);
Route::get('delete-emploiStudent/{id}', [EmploiTempsFileController::class, 'destroy']);

Route::get('remplirtableau', [AttendanceController::class, 'disponibiliteSalle']);

//Emplois des examens de type File student 
Route::resource('/emploiExamens',       EmploiExamenFileController::class);
Route::get('emploiExamens', [EmploiExamenFileController::class, 'index']);
Route::post('emploi-examen-student', [EmploiExamenFileController::class, 'store']);
Route::get('show-emploiExamenStudent/{id}',   [EmploiExamenFileController::class, 'show']);

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

//SELECT DISTINCT s.cin as cinStudent, c.identifiant_classe as identifiantGroupe, c.abbreviation as nomGroupe, m.identifiant_matiere as identifiantMatiere, m.subjectLabel as nomMatiere, s.matricule as matriculeStudent, s.nom as nomFR, s.prenom as prenomFR, s.nom_ar as nomAR, s.prenom_ar as prenomAR, (select count(att.id) from attendances att INNER JOIN students st INNER JOIN classes cl WHERE att.student_id = st.id AND att.classe_id = cl.id AND att.matiere_id = '1' AND att.classe_id = '1') as "count" FROM students s INNER JOIN classes c INNER JOIN matieres m INNER JOIN attendances a WHERE s.classe_id = c.id AND m.id = '1' AND c.id = '1' AND a.attendance_date BETWEEN '2022-09-15' AND '2022-12-31'