<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\BibliothequeController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PointageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClubStudentController;

//Stages
use App\Http\Controllers\Stages\PfeController;
use App\Http\Controllers\Stages\ProfessionnelController;
use App\Http\Controllers\Stages\RapportController;
//Activités
use App\Http\Controllers\Activites\ClubController;
use App\Http\Controllers\Activites\SortieController;
use App\Http\Controllers\Activites\MissionController;


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

//Events Routes
Route::resource('/events',       EventController::class);
Route::post('events',           [EventController::class, 'store']);
Route::get('show-event/{id}',   [EventController::class, 'show']);
Route::get('edit-event/{id}',   [EventController::class, 'edit']);
Route::get('update-event/{id}', [EventController::class, 'update']);
Route::put('update-photoEvent/{id}', [EventController::class, 'updateImageFront']);
Route::get('delete-event/{id}', [EventController::class, 'destroy']);

//News Routes
Route::resource('/news',       NewsController::class);
Route::post('news',            [NewsController::class, 'store']);
Route::get('show-news/{id}',   [NewsController::class, 'show']);
Route::get('edit-news/{id}',   [NewsController::class, 'edit']);
Route::get('update-news/{id}', [NewsController::class, 'update']);
Route::put('update-photoNews/{id}', [NewsController::class, 'updateImageFrontNews']);
Route::get('delete-news/{id}', [NewsController::class, 'destroy']);

//Maps Routes
Route::resource('/maps', MapController::class);
Route::post('maps',            [MapController::class, 'store']);
Route::get('show-maps/{id}',   [MapController::class, 'show']);
Route::get('edit-maps/{id}',   [MapController::class, 'edit']);
Route::get('update-maps/{id}', [MapController::class, 'update']);
Route::put('update-photoMap/{id}', [MapController::class, 'updateImageMap']);
Route::get('delete-maps/{id}', [MapController::class, 'destroy']);

//Library(bibliothèque) Routes
Route::resource('/bibliotheques',      BibliothequeController::class);
Route::post('bibliotheques',           [BibliothequeController::class, 'store']);
Route::get('show-bibliotheque/{id}',   [BibliothequeController::class, 'show']);
Route::get('edit-bibliotheque/{id}',   [BibliothequeController::class, 'edit']);
Route::get('update-bibliotheque/{id}', [BibliothequeController::class, 'update']);
Route::put('update-cover/{id}', [BibliothequeController::class, 'updateCover']);
Route::put('update-book/{id}', [BibliothequeController::class, 'updateBook']);
Route::get('delete-bibliotheque/{id}', [BibliothequeController::class, 'destroy']);

//Stages Routes
Route::resource('/stages',      StageController::class);
Route::post('stages',           [StageController::class, 'store']);
Route::get('getStudent',        [StageController::class, 'getStudent'])->name('getStudent');
Route::get('show-stage/{id}',   [StageController::class, 'show']);
Route::get('edit-stage/{id}',   [StageController::class, 'edit']);
Route::put('update-stage/{id}', [StageController::class, 'update']);
Route::get('delete-stage/{id}', [StageController::class, 'destroy']);

//Emploi Routes
Route::resource('/offres',       EmploiController::class);
Route::post('offres',            [EmploiController::class, 'store']);
Route::get('show-offres/{id}',   [EmploiController::class, 'show']);
Route::get('edit-offres/{id}',   [EmploiController::class, 'edit']);
Route::get('update-offres/{id}', [EmploiController::class, 'update']);
Route::put('update-offreFile/{id}', [EmploiController::class, 'updateFileOffre']);
Route::get('delete-offres/{id}', [EmploiController::class, 'destroy']);

//Téléchargement Routes
Route::resource('/downloads',      DownloadController::class);
Route::post('downloads',           [DownloadController::class, 'store']);
Route::get('show-download/{id}',   [DownloadController::class, 'show']);
Route::get('edit-download/{id}',   [DownloadController::class, 'edit']);
Route::get('update-download/{id}', [DownloadController::class, 'update']);
Route::put('update-downloadFile/{id}', [DownloadController::class, 'updateFileDownload']);
Route::get('delete-download/{id}', [DownloadController::class, 'destroy']);

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

//Stages-PFE Routes
Route::resource('/pfe',                PfeController::class);
Route::post('pfes',                    [PfeController::class, 'store']);
// Route::get('show-pfe/{id}',         [PfeController::class, 'show']);
Route::get('show-demandePFE/{id}',     [PfeController::class, 'show']);
Route::get('show-affectationPFE/{id}', [PfeController::class, 'showAffectation']);
Route::get('show-affectationBinome/{id}/{binome}',[PfeController::class, 'showAffectationBinome']);
Route::get('edit-pfe/{id}',            [PfeController::class, 'edit']);
Route::put('update-pfe/{id}',          [PfeController::class, 'update']);
Route::put('update-pfeDirection/{id}', [PfeController::class, 'updatePFE']);
Route::put('update-proposition/{id}',  [PfeController::class, 'updateProposition']);
Route::put('update-attestation/{id}',  [PfeController::class, 'updateAttestation']);
Route::put('update-rapport/{id}',      [PfeController::class, 'updateRapport']);
Route::get('delete-pfeDirection/{id}', [PfeController::class, 'destroy']);

//Stages-Professionnel Routes
Route::resource('/professionnel',             ProfessionnelController::class);
Route::get('edit-pro/{id}',                   [ProfessionnelController::class, 'edit']);
Route::put('update-pro/{id}',                 [ProfessionnelController::class, 'update']);
Route::put('update-proDirection/{id}',        [ProfessionnelController::class, 'updatePro']);
Route::put('update-propositionStagePro/{id}', [ProfessionnelController::class, 'updatePropositionStagePro']);
Route::put('update-attestationStagePro/{id}', [ProfessionnelController::class, 'updateAttestationStagePro']);
Route::put('update-rapportStagePro/{id}',     [ProfessionnelController::class, 'updateRapportStagePro']);
Route::get('show-demandePro/{id}',            [ProfessionnelController::class, 'show']);
Route::get('show-proTechnicien/{id}',         [ProfessionnelController::class, 'showProTechnicien']);
Route::get('show-proOuvrier/{id}',            [ProfessionnelController::class, 'showProOuvrier']);
Route::get('show-AffectTechnicien/{id}',      [ProfessionnelController::class, 'showAffectTechnicien']);
Route::get('show-AffectOuvrier/{id}',         [ProfessionnelController::class, 'showAffectOuvrier']);
Route::put('update-stage-professionnel/{id}', [ProfessionnelController::class, 'updateStagePro']);
Route::get('delete-professionnel/{id}',       [ProfessionnelController::class, 'destroy']);

//Encadrement PFE routes
Route::get('encadrement',   [PfeController::class, 'encadrement']);

//Stages-emprunter Rapport Routes
Route::resource('/rapport',                 RapportController::class);
Route::put('update-emprunter-rapport/{id}', [RapportController::class, 'updateStageRapport']);
Route::get('delete-rapport/{id}',           [RapportController::class, 'destroy']);

//Activités-Clubs Routes
Route::resource('/clubs',               ClubController::class);
Route::put('update-club-accepter/{id}', [ClubController::class, 'updateClubAccepter']);
Route::put('update-club-activer/{id}',  [ClubController::class, 'updateClubActiver']);
Route::get('delete-club/{id}',          [ClubController::class, 'destroy']);

//Activités-Sorties Routes
Route::resource('/sorties',               SortieController::class);
Route::put('update-sortie-accepter/{id}', [SortieController::class, 'updateSortieAccepter']);
Route::put('update-sortie-faite/{id}',    [SortieController::class, 'updateSortieFaite']);
Route::get('delete-sortie/{id}',          [SortieController::class, 'destroy']);

//Activités-Missions Routes
Route::resource('/missions',               MissionController::class);
Route::put('update-mission-accepter/{id}', [MissionController::class, 'updateMissionAccepter']);
Route::put('update-mission-faite/{id}',    [MissionController::class, 'updateMissionFaite']);
Route::get('delete-mission/{id}',          [MissionController::class, 'destroy']);

//Clubs Students Routes
Route::resource('/clubStudents',          ClubStudentController::class);
Route::post('clubStudents',               [ClubStudentController::class, 'store']);
Route::get('show-clubStudent/{id}',       [ClubStudentController::class, 'show']);
Route::get('edit-clubStudent/{id}',       [ClubStudentController::class, 'edit']);
Route::get('list-clubStudent/{id}',       [ClubStudentController::class, 'list']);
Route::get('update-clubStudent/{id}',     [ClubStudentController::class, 'update']);
Route::put('update-logoClubStudent/{id}', [ClubStudentController::class, 'updateLogo']);
Route::get('delete-clubStudent/{id}',     [ClubStudentController::class, 'destroy']);
Route::get('delete-affectStudentClub/{idAffect}/{idDemande}',[ClubStudentController::class, 'destroyAffectStudent']);

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