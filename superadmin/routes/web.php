<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\LienController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PointageController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\AttendancePersonnelController;
use App\Http\Controllers\PostePersonnelController;
use App\Http\Controllers\VariableController;

use App\Http\Controllers\DemandeStudentController;
use App\Http\Controllers\ReclamationStudentController;
use App\Http\Controllers\DemandePersonnelController;
use App\Http\Controllers\ReclamationPersonnelController;
use App\Http\Controllers\DemandeTeacherController;
use App\Http\Controllers\ReclamationTeacherController;

Route::get('test', function () {
    return view('test');
});

Route::get('empty', function () {
    return view('empty');
});

Route::get('dashboards', function () {
    return view('dashboard');
});

//Admin Routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

//Avis Routes
Route::resource('/avis',       AvisController::class);
Route::post('avis',            [AvisController::class, 'store']);
Route::get('show-avis/{id}',   [AvisController::class, 'show']);
Route::get('edit-avis/{id}',   [AvisController::class, 'edit']);
Route::get('update-avis/{id}', [AvisController::class, 'update']);
Route::get('delete-avis/{id}', [AvisController::class, 'destroy']);

//Liens utiles Routes
Route::resource('/liens',       LienController::class);
Route::post('liens',            [LienController::class, 'store']);
Route::get('show-liens/{id}',   [LienController::class, 'show']);
Route::get('edit-liens/{id}',   [LienController::class, 'edit']);
Route::get('update-liens/{id}', [LienController::class, 'update']);
Route::get('delete-liens/{id}', [LienController::class, 'destroy']);

//Matières Routes
Route::resource('/matieres',      MatiereController::class);
Route::post('matieres',           [MatiereController::class, 'store']);
Route::get('edit-matiere/{id}',   [MatiereController::class, 'edit']);
Route::get('update-matiere/{id}', [MatiereController::class, 'update']);
Route::get('delete-matiere/{id}', [MatiereController::class, 'destroy']);

//Départements Routes
Route::resource('/departements',      DepartementController::class);
Route::post('departements',           [DepartementController::class, 'store']);
Route::get('edit-departement/{id}',   [DepartementController::class, 'edit']);
Route::get('update-departement/{id}', [DepartementController::class, 'update']);
Route::get('delete-departement/{id}', [DepartementController::class, 'destroy']);

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
Route::get('/edit-seance-salle/{id}',   [SalleController::class, 'editSeanceSalle']);
Route::get('/update-seance-salle/{id}', [SalleController::class, 'updateSeanceSalle']);
Route::post('/display-salle',           [SalleController::class, 'salleDisponibiliteByDay']);
Route::get('/reserver-salle',           [SalleController::class, 'reserverSalleEmploi']);
Route::post('/reserver-seance-salle',   [SalleController::class, 'reserverSeanceToSalle']);
Route::put('/modifier-statut-salle',    [SalleController::class, 'updateStatutSalle']);

//Classe Routes
Route::get('all-classes',                   [ClasseController::class, 'indexGroupe']);
Route::get('classe-matieres/{id}',          [ClasseController::class, 'affecter']);
Route::post('matiereregistreByClasse',      [ClasseController::class, 'multiMatiere']);
Route::delete('deletematiereByClasse/{id}', [ClasseController::class, 'destroyMatiereFromClasse']);
Route::get('emploi-classe/{id}', [ClasseController::class, 'getScheduleFromClasse']);

//Levels (Niveaux) Routes
Route::resource('/levels',       LevelController::class);
Route::post('levels',            [LevelController::class, 'store']);
Route::get('show-levels/{id}',   [LevelController::class, 'show']);
Route::get('edit-levels/{id}',   [LevelController::class, 'edit']);
Route::get('update-levels/{id}', [LevelController::class, 'update']);
Route::get('delete-levels/{id}', [LevelController::class, 'destroy']);

//Sections Routes
Route::resource('/sections',       SectionController::class);
Route::post('sections',            [SectionController::class, 'store']);
Route::get('show-sections/{id}',   [SectionController::class, 'show']);
Route::get('edit-sections/{id}',   [SectionController::class, 'edit']);
Route::get('update-sections/{id}', [SectionController::class, 'update']);
Route::get('delete-sections/{id}', [SectionController::class, 'destroy']);

//Admins (users) Routes
Route::resource('/admins',       AdminController::class);
Route::post('admins',            [AdminController::class, 'store']);
Route::get('show-admins/{id}',   [AdminController::class, 'show']);
Route::get('edit-admins/{id}',   [AdminController::class, 'edit']);
Route::get('update-admins/{id}', [AdminController::class, 'update']);
Route::put('update-passwordAdmin/{id}', [AdminController::class, 'updatePasswordAdmin']);
Route::get('delete-admins/{id}', [AdminController::class, 'destroy']);
Route::get('getDepartement',     [AdminController::class, 'getDepartement'])->name('getDepartement');

//Ordres et Missions Routes
Route::resource('/missions',       MissionController::class);
Route::post('missions',            [MissionController::class, 'store']);
Route::get('show-missions/{id}',   [MissionController::class, 'show']);
Route::get('edit-missions/{id}',   [MissionController::class, 'edit']);
Route::get('update-missions/{id}', [MissionController::class, 'update']);
Route::put('update-missionFile/{id}', [MissionController::class, 'updateFileMission']);
Route::get('delete-missions/{id}', [MissionController::class, 'destroy']);

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
Route::get('reply-message/{idUser}/{nameUser}/{roleUser}/{objetUser}',[MessageController::class, 'replayMessage']);
Route::get('corbeil-message/{id}',  [MessageController::class, 'corbeilMessage']);
Route::get('restaurer-message/{id}',[MessageController::class, 'restaurerMessage']);
Route::get('delete-message/{id}',   [MessageController::class, 'deleteMessage']);

//Demande Etudiant Routes
Route::resource('/demandeEtudiant',      DemandeStudentController::class);
Route::get('show-demandestudent/{id}',   [DemandeStudentController::class, 'show']);
Route::get('edit-demandestudent/{id}',   [DemandeStudentController::class, 'edit']);
Route::get('update-demandestudent/{id}', [DemandeStudentController::class, 'update']);
Route::get('delete-demandestudent/{id}', [DemandeStudentController::class, 'destroy']);

//Reclamation Etudiant Routes
Route::resource('/reclamationEtudiant',      ReclamationStudentController::class);
Route::get('show-reclamationStudent/{id}',   [ReclamationStudentController::class, 'show']);
Route::get('edit-reclamationStudent/{id}',   [ReclamationStudentController::class, 'edit']);
Route::get('update-reclamationStudent/{id}', [ReclamationStudentController::class, 'update']);
Route::get('delete-reclamationStudent/{id}', [ReclamationStudentController::class, 'destroy']);

//Reclamation Etudiant Routes
Route::resource('/reclamations',      ReclamationController::class);
Route::get('show-reclamations/{id}',  [ReclamationController::class, 'show']);
Route::get('edit-reclamation/{id}',   [ReclamationController::class, 'edit']);
Route::get('update-reclamation/{id}', [ReclamationController::class, 'update']);
Route::get('delete-reclamation/{id}', [ReclamationController::class, 'destroy']);

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

//Enseignants Routes
Route::resource('/teachers',         TeacherController::class);
Route::get('/teachers/{id}/profile', [TeacherController::class, 'addprofilePage']);
Route::post('teacherprofile', [TeacherController::class, 'addprofileStore']);
Route::get('teachers-matieres/{id}', [TeacherController::class, 'affecter']);
Route::post('teachers', [TeacherController::class, 'store']);
Route::post('matiereregistre', [TeacherController::class, 'multiMatiere']);
Route::get('edit-teacher/{id}',          [TeacherController::class, 'edit']);
Route::put('update-teacher/{id}',        [TeacherController::class, 'update']);
Route::put('update-photo/{id}',          [TeacherController::class, 'updateProfile']);
Route::get('delete-teacher/{id}',        [TeacherController::class, 'destroy']);
Route::delete('deletematiere/{id}', [TeacherController::class, 'destroyMatiereFromTeacher']);

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

//Personnels Routes
Route::resource('/personnels', PersonnelController::class);

//Attendance Personnels Routes
Route::get('attendancePersonnels', [AttendancePersonnelController::class, 'index']);

//Demandes Personnels
Route::resource('/demandePersonnel',       DemandePersonnelController::class);
Route::get('show-demandepersonnel/{id}',   [DemandePersonnelController::class, 'show']);

//Reclamation Personnel Routes
Route::resource('/reclamationPersonnel',      ReclamationPersonnelController::class);
Route::get('show-reclamationPersonnel/{id}',  [ReclamationPersonnelController::class, 'show']);
Route::get('edit-reclamationPersonnel/{id}',  [ReclamationPersonnelController::class, 'edit']);

//Demande Enseignant Routes
Route::resource('/demandeEnseignant',    DemandeTeacherController::class);
Route::get('show-demandeteacher/{id}',   [DemandeTeacherController::class, 'show']);

//Reclamation Enseignant Routes
Route::resource('/reclamationEnseignant',  ReclamationTeacherController::class);
Route::get('show-reclamationTeacher/{id}', [ReclamationTeacherController::class, 'show']);
Route::get('edit-reclamationTeacher/{id}', [ReclamationTeacherController::class, 'edit']);

//Téléchargement Routes
Route::resource('/downloads',      DownloadController::class);
Route::post('downloads',           [DownloadController::class, 'store']);
Route::get('show-download/{id}',   [DownloadController::class, 'show']);
Route::get('edit-download/{id}',   [DownloadController::class, 'edit']);
Route::get('update-download/{id}', [DownloadController::class, 'update']);
Route::put('update-downloadFile/{id}', [DownloadController::class, 'updateFileDownload']);
Route::get('delete-download/{id}', [DownloadController::class, 'destroy']);

//Variables Routes
//Route::resource('/variables',       VariableController::class);
Route::get('edit-variable',         [VariableController::class, 'edit']);
Route::get('update-variable',       [VariableController::class, 'update']);
Route::put('update-logoVariable',   [VariableController::class, 'updateLogoVariable']);
Route::put('update-signDirecteur',  [VariableController::class, 'updateSignatureDirecteur']);
Route::put('update-signSecretaire', [VariableController::class, 'updateSignatureSecretaire']);

//Postes Personnels (Fonction, Grade, Categorie) Routes
Route::resource('/postePersonnels', PostePersonnelController::class);
Route::get('AllPostePersonnels',    [PostePersonnelController::class, 'index']);
Route::post('postePersonnels/{cat}',[PostePersonnelController::class, 'store']);
Route::get('edit-poste/{id}',       [PostePersonnelController::class, 'edit']);
Route::get('update-poste/{id}',     [PostePersonnelController::class, 'update']);
Route::get('delete-poste/{id}',     [PostePersonnelController::class, 'destroy']);

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