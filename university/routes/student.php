<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\myAPIController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AuthTeacherController;
use App\Http\Controllers\API\AuthPersonnelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationSystemController;

use App\Http\Controllers\EventController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DemandeStudentController;
use App\Http\Controllers\LienController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\BibliothequeController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfileStudentController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MessageServiceController;
use App\Http\Controllers\AttendanceController; 
use App\Http\Controllers\ConditionController; 
use App\Http\Controllers\ClubStudentController; 
// Teacher
use App\Http\Controllers\Teachers\TeacherController;
use App\Http\Controllers\Teachers\RattrapageController;
use App\Http\Controllers\Teachers\EmploiTeacherController;
use App\Http\Controllers\Teachers\AttendanceTeacherController;
use App\Http\Controllers\Teachers\PostTeacherController;
use App\Http\Controllers\Teachers\SurveillanceController;
use App\Http\Controllers\Teachers\ConversationController;
use App\Http\Controllers\Teachers\SpecialiteController;
//Personnel 
use App\Http\Controllers\Personnels\PersonnelController;
//Emploi de temps
use App\Http\Controllers\Emploi\MatiereTeacherController;
use App\Http\Controllers\Emploi\MatiereClasseController;
use App\Http\Controllers\Emploi\EmploiTempsFileController;
use App\Http\Controllers\Emploi\EmploiExamenFileController;
use App\Http\Controllers\Emploi\EmploiTempsFileTeacherController;
use App\Http\Controllers\Emploi\EmploiExamenFileTeacherController;
// Student
use App\Http\Controllers\Students\RoomController;
use App\Http\Controllers\Students\NoteController;
use App\Http\Controllers\Students\TriggerController;
use App\Http\Controllers\Students\NotificationController;
//Stages
use App\Http\Controllers\Stages\PfeController;
use App\Http\Controllers\Stages\ProfessionnelController;
use App\Http\Controllers\Stages\RapportController;
//Activités
use App\Http\Controllers\Activites\ClubController;
use App\Http\Controllers\Activites\SortieController;
use App\Http\Controllers\Activites\MissionDemandeController;


use App\Http\Controllers\StageController;
use App\Http\Controllers\TelechargementController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VariableController;


/*
|--------------------------------------------------------------------------
| API Routes Students ISAM
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'APIToken'], function() {

//Liens utiles Routes 
Route::get('lien/{id}', [LienController::class, 'index']);
Route::post('liens', [LienController::class, 'store']);
Route::get('liens', [LienController::class, 'getAllLien']);
Route::get('liensCategorie/{category}', [LienController::class, 'getAllLinksByCategory']);
Route::put('update-lien/{id}', [LienController::class, 'update']);
Route::delete('delete-lien/{id}', [LienController::class, 'destroy']);

//Cours (Enseignants) Routes 
Route::get('cours/{id}',                 [CoursController::class, 'index']);
Route::get('allClassesByIdTeacher/{id}', [CoursController::class, 'getAllclassesFromIdTeacher']);
Route::get('allMatieresByIdTeacher/{id}',[CoursController::class, 'getAllMatieresFromIdTeacher']);
Route::post('cours',               [CoursController::class, 'store']);
Route::get('all-cours',            [CoursController::class, 'getAllCours']);
Route::get('cours-classe',         [CoursController::class, 'getAllCoursWithClasse']);
Route::get('cours-teacher/{id}',   [CoursController::class, 'getAllCoursWithTeacherId']);
Route::get('level-classe/{level}', [CoursController::class, 'getAllClassesFromLevelId']);
Route::get('all-levels',           [CoursController::class, 'getAllLevels']);
Route::put('update-cours/{id}',    [CoursController::class, 'update']);
Route::delete('delete-cours/{id}', [CoursController::class, 'destroy']);
// Route::get('cours', [CoursController::class, 'getAllCourses']);

//Maps (Vie estudiantine) Routes
Route::get('maps/{id}', [MapController::class, 'index']);
Route::post('maps', [MapController::class, 'store']);
Route::get('maps', [MapController::class, 'getAllLocations']);
Route::put('update-maps/{id}', [MapController::class, 'update']);
Route::delete('delete-maps/{id}', [MapController::class, 'destroy']);

//Courses Routes
Route::get('/courses', [CourseController::class, 'index']);

//Events Routes 
Route::post('events', [EventController::class, 'store']);
Route::get('event/{id}', [EventController::class, 'index']);
Route::get('events', [EventController::class, 'getAllEvents']);
Route::get('events-popular', [EventController::class, 'getTopEvents']);
Route::get('events-lastfive/{nbr}', [EventController::class, 'getLastNbrEvents']);
Route::get('events-pagination/{skip}/{take}', [EventController::class, 'getPaginationEvents']);
Route::put('count-views-event/{id}', [EventController::class, 'CountViewsEvent']);
Route::put('update-event/{id}', [EventController::class, 'update']);
Route::delete('delete-event/{id}', [EventController::class, 'destroy']);

//News Routes 
Route::post('news', [NewsController::class, 'store']);
Route::get('news/{id}', [NewsController::class, 'index']);
Route::get('all-news', [NewsController::class, 'getAllNews']);
Route::get('news-pagination/{skip}/{take}', [NewsController::class, 'getPaginationNews']);
Route::put('count-views-news/{id}', [NewsController::class, 'CountViewsNews']);
Route::put('update-news/{id}', [NewsController::class, 'update']);
Route::delete('delete-news/{id}', [NewsController::class, 'destroy']);

//Emploi de Temps Matieres Prof Salle
Route::get('matieres-teachers',             [MatiereTeacherController::class, 'index']);
Route::post('matiereteacher',               [MatiereTeacherController::class, 'store']);
Route::get('matieres-teacher/{id}',         [MatiereTeacherController::class, 'getAllMatiersFromTeacherWithID']);
Route::put('update-matiereteacher/{id}',    [MatiereTeacherController::class, 'update']);
Route::delete('delete-matiereteacher/{id}', [MatiereTeacherController::class, 'destroy']);
Route::get('matieres-classes',      [MatiereClasseController::class, 'index']);
Route::get('matieres-classe/{id}',  [MatiereClasseController::class, 'getAllMatiersFromClasseWithID']);
Route::delete('delete-matiereClasse/{id}', [MatiereClasseController::class, 'destroy']);

//Departements Routes 
Route::get('departement/{id}', [DepartementController::class, 'index']);
Route::post('departements', [DepartementController::class, 'store']);
Route::get('departements', [DepartementController::class, 'getAllDepartements']);
Route::put('update-departement/{id}', [DepartementController::class, 'update']);
Route::delete('delete-departement/{id}', [DepartementController::class, 'destroy']);

//Sections filieres Routes 
Route::post('section', [SectionController::class, 'store']);
Route::get('section/{id}', [SectionController::class, 'index']);
Route::get('sections', [SectionController::class, 'getAllSections']);
Route::get('sectionselect', [SectionController::class, 'getDepartSelect']);
Route::get('section', [SectionController::class, 'getAllDemandesFromStudent']);
Route::get('section', [SectionController::class, 'getAllStudentFromDemandes']);
Route::put('update-section/{id}', [SectionController::class, 'update']);
Route::delete('delete-section/{id}', [SectionController::class, 'destroy']);

//Levels Routes 
Route::get('level/{id}', [LevelController::class, 'index']);
Route::post('levels', [LevelController::class, 'store']);
Route::get('levels', [LevelController::class, 'getAllLevels']);
Route::put('update-level/{id}', [LevelController::class, 'update']);
Route::delete('delete-level/{id}', [LevelController::class, 'destroy']);

//Classes  Routes 
Route::get('classe/{id}', [ClasseController::class, 'index']);
Route::get('classe-id/{id}', [ClasseController::class, 'getClasseByID']);
Route::post('classes', [ClasseController::class, 'store']);
Route::get('classes', [ClasseController::class, 'getAllClassesWithSection']);
Route::get('all-classes', [ClasseController::class, 'getAllClasses']);
Route::get('classesWithDepartement/{departement}', [ClasseController::class, 'classesWithDepartement']);
Route::get('classesWithStudents/{classe}', [ClasseController::class, 'classesWithStudents']);
Route::get('avis-classes', [AvisController::class, 'avisClasse']);
Route::put('update-classe/{id}', [ClasseController::class, 'update']);
Route::delete('delete-classe/{id}', [ClasseController::class, 'destroy']);

//Salles  Routes 
Route::get('salle/{id}', [SalleController::class, 'index']);
Route::post('salles', [SalleController::class, 'store']);
Route::get('sallesdep', [SalleController::class, 'getAllSallesWithDep']);
Route::put('update-salle/{id}', [SalleController::class, 'update']);
Route::delete('delete-salle/{id}', [SalleController::class, 'destroy']);
//Disponibilité Salles 
Route::get('disponibiliteAllSallesByDay/{day}', [SalleController::class, 'disponibiliteAllSallesByDay']);
Route::get('disponibiliteAllSallesByDayAndIdSalle/{day}/{id}', [SalleController::class, 'disponibiliteAllSallesByDayAndIdSalle']);
Route::get('disponibiliteAllSallesByDayAndIdSalleSemestreOne/{day}/{id}', [SalleController::class, 'disponibiliteAllSallesByDayAndIdSalleSemestreOne']);
Route::get('disponibiliteAllSallesByDayAndIdSalleSemestreTwo/{day}/{id}', [SalleController::class, 'disponibiliteAllSallesByDayAndIdSalleSemestreTwo']);
Route::get('all-salles-emploi', [SalleController::class, 'allSallesFromTableEmploiSalles']);
Route::get('all-salles-statut', [SalleController::class, 'getAllSalleFromDisponible']);
Route::get('all-salles-statut-id/{id}', [SalleController::class, 'getAllSalleFromDisponibleByIdSalle']);
Route::get('all-salles-statut-semestre1/{id}', [SalleController::class, 'getAllSalleFromDisponibleByIdSalleSemestre1']);
Route::get('all-salles-statut-semestre2/{id}', [SalleController::class, 'getAllSalleFromDisponibleByIdSalleSemestre2']);
Route::get('get-seance-salle/{id}', [SalleController::class, 'getSeanceFromSalleIdSeance']);
Route::get('all-salles-disponible/{id}', [SalleController::class, 'getAllSeancesFromDisponibleWithIdSalle']);
Route::get('all-salles-disponible', [SalleController::class, 'getAllSalleFromDisponibleByStatut']);
Route::put('update-seance-salle/{id}', [SalleController::class, 'updateSeanceSalle']);
Route::get('emploi-salle-day/{id}/{jour}', [SalleController::class, 'getAllSeanceFromIdSalleByDay']);
Route::get('emploi-salle-day-semestre/{id}/{jour}/{semestre}', [SalleController::class, 'getAllSeanceFromIdSalleByDayAndSemestre']);
Route::get('get-available-salle/{seance}/{day}', [SalleController::class, 'getSalleDisponibleWithSeanceAndDay']);
Route::get('getAllSeanceSalle', [SalleController::class, 'getAllSeanceSalle']);
Route::get('getAllSeanceSalleDisponible', [SalleController::class, 'getAllSeanceSalleDisponible']);
Route::get('tous-salles-disponible/{debutSeance}/{finSeance}/{day}', [SalleController::class, 'disponibiliteSalle']);
//Disponibilité salle with teacher controller
Route::get('tous-salles-disponible-seances/{debutSeance}/{finSeance}/{day}/{type_seance}', [TeacherController::class, 'disponibiliteSallesSeances']);
Route::get('tous-salles-disponible-seances-semestre/{debutSeance}/{finSeance}/{day}/{type_seance}/{semestre}', [TeacherController::class, 'disponibiliteSallesSeancesFromSemestre']);


//Liens utiles Routes 
Route::get('matiere/{id}', [MatiereController::class, 'index']);
Route::post('matieres', [MatiereController::class, 'store']);
Route::get('matieres', [MatiereController::class, 'getAllMatiere']);
Route::put('update-matiere/{id}', [MatiereController::class, 'update']);
Route::delete('delete-matiere/{id}', [MatiereController::class, 'destroy']);

//Message Students Routes
Route::get('message/{id}', [MessageController::class, 'index']);
Route::post('message', [MessageController::class, 'store']);
Route::get('messages', [MessageController::class, 'getAllMessage']);
Route::get('messages-admin', [MessageController::class, 'getAllMessagesFromAdmin']);
Route::get('messages-admin/{id}', [MessageController::class, 'getAllMessagesFromAdminWithIdAdmin']);
Route::get('messages-student-admin/{id}', [MessageController::class, 'getAllMessagesFromStudentWithIdStudent']);
Route::get('messages-admin-details/{id}', [MessageController::class, 'getMessageFromStudent']);
Route::get('count-msg-view-student', [MessageController::class, 'getMsgNotViewStudent']);
Route::get('count-msg-view-service', [MessageController::class, 'getMsgNotViewService']);
Route::put('update-view-student/{id}', [MessageController::class, 'changeStatutStudent']);
Route::put('update-view-service/{id}', [MessageController::class, 'changeStatutService']);
Route::get('id-user-message/{id}', [MessageController::class, 'getMessageFromStudentWithIdUser']);

//Message Services 
Route::get('messageService/{id}',               [MessageServiceController::class, 'index']);
Route::post('message-service',                  [MessageServiceController::class, 'store']); //MessageServiceController
Route::post('message-multiple-users',           [MessageServiceController::class, 'storeMultipleUsers']);
Route::get('messageService',                    [MessageServiceController::class, 'getAllMessage']);
Route::get('messages-sent-service/{id}',        [MessageServiceController::class, 'getAllMsgRecievedFromService']);
Route::get('messages-recieved-service/{id}',    [MessageServiceController::class, 'getAllMsgSentToService']);
Route::get('messages-service/{id}',             [MessageServiceController::class, 'getAllMessagesFromStudentWithIdStudent']);
Route::get('messages-service-details/{id}',     [MessageServiceController::class, 'getMessageFromService']);
Route::get('message-send-details/{message}/{sender}',    [MessageServiceController::class, 'messageSendDetails']);
Route::get('message-receive-details/{message}/{receiver}', [MessageServiceController::class, 'messageReceiveDetails']);
Route::delete('delete-messages-service/{id}',   [MessageServiceController::class, 'destroy']);
Route::get('coutAllMessagesSend/{id}',          [MessageServiceController::class, 'coutAllMessagesSend']);
Route::get('coutAllMessagesReceive/{id}',       [MessageServiceController::class, 'coutAllMessagesReceive']);
Route::get('coutAllMessagesReceiveNotView/{id}',[MessageServiceController::class, 'coutAllMessagesReceiveNotView']);
Route::put('update-view-service/{id}',          [MessageServiceController::class, 'changeStatutService']);
Route::put('corbeil-message/{id}',              [MessageServiceController::class, 'corbeilMessage']);
Route::put('restaurer-message/{id}',            [MessageServiceController::class, 'restaurerMessage']);
Route::delete('delete-message-service/{id}',    [MessageServiceController::class, 'deleteMessageService']);
Route::get('getAllCorbeilMessage/{id}',         [MessageServiceController::class, 'getAllCorbeilMessage']);
Route::get('getMessagesWithUsersByIdMessage/{id}', [MessageServiceController::class, 'getMessagesWithUsersByIdMessage']);

//Téléchargements Routes 
Route::get('downloads', [TelechargementController::class, 'index']);
Route::get('download/{id}', [TelechargementController::class, 'getFileById']);
Route::get('downloadCategory/{category}', [TelechargementController::class, 'getFileByCategory']);
Route::post('download', [TelechargementController::class, 'store']);
Route::put('update-download-stage/{id}', [TelechargementController::class, 'update']);
//Route::delete('delete-download/{id}', [TelechargementController::class, 'destroy']);
Route::delete('delete-downloadFichier/{id}', [TelechargementController::class, 'destroy']);

/**************************************     Notifications         ***************************************/
Route::get('notification', [NotificationSystemController::class, 'index']);
Route::get('notifsystem-model/{id}', [NotificationSystemController::class, 'getNotifWithModelAndEventByID']);
Route::get('notifsystem-model', [NotificationSystemController::class, 'getNotifWithModelAndEvent']);
Route::post('notifsystem-admins', [NotificationSystemController::class, 'store']);
Route::get('notifsystem-admins', [NotificationSystemController::class, 'getAllAdmins']);
Route::put('update-notifsystem/{id}', [NotificationSystemController::class, 'update']);
Route::delete('delete-notifsystem/{id}', [NotificationSystemController::class, 'destroy']);

Route::prefix('v1')->namespace('API')->group(function () {
  
  /*****************************  Student  **************************************/
  // Login Student
  Route::post('/login', [AuthController::class, 'postLogin']);
  // Register Student
  Route::post('/register', [AuthController::class, 'postRegister']);
  // Protected with APIToken Middleware
  Route::middleware('APIToken')->group(function () {
    // Logout Student
    Route::post('/logout', [AuthController::class, 'postLogout']);
  });

  /*****************************  Teacher  **************************************/
  // Login Student
  Route::post('/login-teacher', [AuthTeacherController::class, 'postLogin']);
  // Register Student
  Route::post('/register-teacher', [AuthTeacherController::class, 'postRegister']);
  // Protected with APIToken Middleware
  Route::middleware('APITokenTeacher')->group(function () {
    // Logout Student
  Route::post('/logout-teacher', [AuthTeacherController::class, 'postLogout']);
  });

    /*****************************  Personnel  **************************************/
  // Login Student
  Route::post('/login-personnel', [AuthPersonnelController::class, 'postLogin']);
  // Register Student
  Route::post('/register-personnel', [AuthPersonnelController::class, 'postRegister']);
  // Protected with APIToken Middleware
  Route::middleware('APITokenPersonnel')->group(function () {
    // Logout Student
  Route::post('/logout-personnel', [AuthPersonnelController::class, 'postLogout']);
  });
});

Route::post('/login', [ApiController::class, 'login']);
Route::get('getMyurl', [ApiController::class, 'myUrl']);
Route::post('/auth/token', [ApiController::class, 'store']);
Route::post('/auth/token/student', [ApiController::class, 'storeStudentToken']);
Route::get('getData', [EventController::class, 'getData']);

/****************************************   Auth API   ************************************** */

Route::put('update-imageEvent/{id}', [EventController::class, 'updateImageBack']);
Route::put('update-imageNews/{id}', [NewsController::class, 'updateImageBackNews']);
Route::put('update-imageMap/{id}', [MapController::class, 'updateImageMap']);
Route::put('update-imageCover/{id}', [BibliothequeController::class, 'updateImageCover']);
Route::put('update-fileBook/{id}',  [BibliothequeController::class, 'updateFileBook']);
Route::put('update-fileDownload-stage/{id}',  [TelechargementController::class, 'updateFileDownload']);
//Posts (Forums) Routes Students
Route::get('posts/{id}', [PostController::class, 'index']);
Route::post('posts', [PostController::class, 'store']);
Route::get('posts', [PostController::class, 'getAllPosts']);
Route::get('posts-student', [PostController::class, 'getAllPostsWithStudent']);
Route::get('posts-student/{id}', [PostController::class, 'getAllPostsWithStudentFromId']);
Route::get('posts/{id}', [PostController::class, 'getAllPostsWithIdStudent']);
Route::get('post-categorie/{cat}', [PostController::class, 'getAllPostsWithCategory']);

Route::get('posts-pagination-id/{skip}/{take}/{id}', [PostController::class, 'getPaginationPostsFromStudent']);
Route::get('posts-pagination/{skip}/{take}', [PostController::class, 'getPaginationPosts']);
Route::put('count-views-posts/{id}', [PostController::class, 'CountViewsPosts']);

Route::get('edit-post/{id}', [PostController::class, 'edit']);
Route::put('update-post/{id}', [PostController::class, 'update']);
Route::delete('delete-post/{id}', [PostController::class, 'destroy']);

//Commentaires Posts (Forum) Routes
Route::get('/comments', [CommentController::class, 'index']);

//Demandes Students Routes 
Route::post('demandestudent', [DemandeStudentController::class, 'store']);
Route::get('demandestudent/{id}', [DemandeStudentController::class, 'index']);
Route::get('demandefromstudent/{id}', [DemandeStudentController::class, 'demandefromstudent']);
Route::get('getDemandeById/{id}', [DemandeStudentController::class, 'getDemandeById']);
Route::get('alldemandwithstudent/{id}', [DemandeStudentController::class, 'AllDemandesWithStudentFromID']);
Route::get('demandestudent', [DemandeStudentController::class, 'getAllDemandes']);
Route::get('demandefromstudent', [DemandeStudentController::class, 'getAllDemandesFromStudent']);
Route::get('demandeFromStudentByCategory/{cat}', [DemandeStudentController::class, 'getAllDemandesFromStudentByCategory']);
Route::get('getAllDemandesFromStudentByCategoryStage/{cat1}/{cat2}', [DemandeStudentController::class, 'getAllDemandesFromStudentByCategoryStage']);
Route::get('demandeFromStudentByServiceScolarite', [DemandeStudentController::class, 'getAllDemandesFromStudentByServiceScolarite']);
Route::get('demandeFromStudentByServiceExamens', [DemandeStudentController::class, 'getAllDemandesFromStudentByServiceExamens']);
Route::get('studentfromdemand', [DemandeStudentController::class, 'getAllStudentFromDemandes']);
Route::put('update-demandestudent/{id}', [DemandeStudentController::class, 'update']);
Route::delete('delete-demandestudent/{id}', [DemandeStudentController::class, 'destroy']);
Route::get('countAllDemandesStudents', [DemandeStudentController::class, 'countAllDemandesStudents']);
Route::get('getCountDemandesStudentsByStatut/{statut}', [DemandeStudentController::class, 'getCountDemandesStudentsByStatut']);
Route::get('getCountDemandesStageStudents/{sous_type}/{accepter}', [DemandeStudentController::class, 'getCountDemandesStageStudents']);
Route::get('getCountDemandesStageStudents2/{sous_type}/{recuperer}', [DemandeStudentController::class, 'getCountDemandesStageStudents2']);
Route::get('getCountDemandesStudentsByTypeAndStatut/{type}/{statut}', [DemandeStudentController::class, 'getCountDemandesStudentsByTypeAndStatut']);
Route::get('getCountDemandesStudentsByType/{type}', [DemandeStudentController::class, 'getCountDemandesStudentsByType']);

//Reclamations Students Routes 
Route::get('reclamations/{id}', [ReclamationController::class, 'index']);
Route::post('reclamations', [ReclamationController::class, 'store']);
Route::get('reclamations', [ReclamationController::class, 'getAllReclams']);
Route::get('reclamationsFromSql', [ReclamationController::class, 'getAllReclamsFromSqlDB']);
Route::get('reclamation-studend/{id}', [ReclamationController::class, 'getReclamWithStudent']);
Route::get('reclamation-student-sql/{id}', [ReclamationController::class, 'getReclamWithStudentFromSqlD']);
Route::get('reclamation-studend-filter/{id}/{statut}', [ReclamationController::class, 'getReclamWithStudentFilter']);
Route::put('update-reclamation/{id}', [ReclamationController::class, 'update']);
Route::delete('delete-reclamation/{id}', [ReclamationController::class, 'destroy']);
Route::get('countAllReclamationsStudents', [ReclamationController::class, 'countAllReclamationsStudents']);
Route::get('getCountReclamationsStudentsByStatut/{statut}', [ReclamationController::class, 'getCountReclamationsStudentsByStatut']);

//Profiles Students Routes
Route::get('/profiles/{id}', [ProfileStudentController::class, 'index']);
Route::get('profiles', [ProfileStudentController::class, 'getAllProfileStudents']);
Route::post('profiles', [ProfileStudentController::class, 'store']);

//Bibliotheque Routes 
Route::post('books', [BibliothequeController::class, 'store']);
Route::get('book/{id}', [BibliothequeController::class, 'index']);
Route::get('books', [BibliothequeController::class, 'getAllBooks']);
Route::get('getCountBooksLibrary', [BibliothequeController::class, 'getCountBooksLibrary']);
Route::get('book-count/{id}', [BibliothequeController::class, 'CountViewsPosts']);
Route::get('books-filtre/{cat}', [BibliothequeController::class, 'bookWithCategorie']);
Route::get('books-views/{id}', [BibliothequeController::class, 'addViews']);
Route::put('update-bibliotheque/{id}', [BibliothequeController::class, 'update']);
Route::delete('delete-book/{id}', [BibliothequeController::class, 'destroy']);

//Stage Routes 
Route::post('stages',                 [StageController::class, 'store']);
Route::get('stages/{id}',             [StageController::class, 'index']);
Route::get('all-stages',              [StageController::class, 'getAllStages']);
Route::get('all-stages-student',      [StageController::class, 'getAllStageWithStudent']);
Route::get('all-stages-student/{id}', [StageController::class, 'getAllStageWithStudentFromIdStage']);
Route::get('stage-student/{id}',      [StageController::class, 'getStageWithStudent']);
Route::put('update-stage/{id}',        [StageController::class, 'update']);
Route::delete('delete-stage/{id}',     [StageController::class, 'destroy']);

//Emploi(offre de travail) Routes 
Route::post('emplois', [EmploiController::class, 'store']);
Route::get('emplois/{id}', [EmploiController::class, 'index']);
Route::get('all-emplois', [EmploiController::class, 'getAllEmplois']);
Route::get('emplois-pagination/{skip}/{take}', [EmploiController::class, 'getPaginationEmplois']);
Route::put('count-views-emplois/{id}', [EmploiController::class, 'CountViewsEmploi']);
Route::put('update-emplois/{id}', [EmploiController::class, 'update']);
Route::put('update-fileOffre/{id}', [EmploiController::class, 'updatefileOffre']);
Route::delete('delete-emplois/{id}', [EmploiController::class, 'destroy']);

//Student Routes
Route::get('student/{id}', [StudentController::class, 'index']);
Route::get('students', [StudentController::class, 'getAllStudents']);
Route::get('student-profile', [StudentController::class, 'getAllStudentsWithProfiles']);
Route::get('students-classes', [StudentController::class, 'getAllStudentsWithClasse']);
Route::get('attendance-details', [AttendanceController::class, 'getAllStudentsWithClasseDetails']); // AttendanceController
Route::get('attendance-details/{id}', [AttendanceController::class, 'getAllStudentsWithClasseDetailsByIDattendance']); // AttendanceController
Route::put('attendance/{id}', [AttendanceController::class, 'update']); // AttendanceController   
Route::get('attendance-details-filtre/{teacher}', [AttendanceController::class, 'getAllAttendancesTeacherFromLastMonth']); // AttendanceController
Route::get('attendance-teacher-byClass/{teacher}/{classe}', [AttendanceController::class, 'getAllAttendancesTeacherFromClassId']); // AttendanceController
Route::get('attendance-teacher-byClass-date/{teacher}/{classe}/{dateMin}/{dateMax}', [AttendanceController::class, 'getAllAttendancesTeacherFromLastMonthByIdClass']); // AttendanceController
Route::get('attendance-details-classe/{classe}', [AttendanceController::class, 'getAllStudentsWithClasseDetailsClasse']); // AttendanceController
Route::get('attendance-date/{teacher}/{dateMin}/{dateMax}', [AttendanceController::class, 'getAllAttendancesTeacherFromAllGroupWithDate']); // AttendanceController
Route::get('getCountAbsenceTodayStudent', [AttendanceController::class, 'getCountAbsenceTodayStudent']);
Route::delete('delete-attendance-student/{id}', [AttendanceController::class, 'destroy']);
Route::get('students-classes/{id}', [StudentController::class, 'getAllStudentsWithClasseFromIdClasse']);
Route::get('studentsByclasse/{id}', [StudentController::class, 'getAllStudentsFromIdClasse']);
Route::get('student-profile/{id}', [StudentController::class, 'getStudentWithProfileFromId']);
Route::get('student-classe/{id}', [StudentController::class, 'getStudentWithClasseFromId']);
Route::get('classe-student/{id}', [StudentController::class, 'getClasseWithStudentFromId']);
Route::get('classes-students/{id}', [StudentController::class, 'getClasseWithAllStudentsFromId']);
Route::get('attendance-student/{id}', [StudentController::class, 'getAllAttendanceWithStudentFromId']);
//Route::post('students', [StudentController::class, 'store']);
Route::get('getClasse',[StudentController::class, 'getClasse'])->name('getClasse');
Route::get('edit-student/{id}', [StudentController::class, 'edit']);
Route::put('update-student/{id}', [StudentController::class, 'update']);
Route::put('update-profilestudent/{id}', [ProfileStudentController::class, 'updateProfile']);
Route::put('update-accountstudent/{id}', [StudentController::class, 'updateAccount']);
Route::get('delete-student/{id}', [StudentController::class, 'destroy']);
Route::get('name-classe/{id}', [StudentController::class, 'getNameOfclass']);
Route::get('countAllStudents', [StudentController::class, 'countAllStudents']);
Route::get('getCountRAllStudentsByStatut/{statut}', [StudentController::class, 'getCountRAllStudentsByStatut']);
//Inscription formulaire
Route::post('inscription', [StudentController::class, 'store']);
Route::post('inscription-new', [StudentController::class, 'storeNew']);
//Teacher
Route::put('update-accountteacher/{id}', [TeacherController::class, 'updateAccount']);
//Teacher
Route::get('getHeure-salle/{id_salle}/{nom_jour}', [SalleController::class, 'getHeureByDay']);
// Update CIN(face1&face2) + PhotoProfil+Inscription Student
Route::put('update-cinFace1/{id}', [StudentController::class, 'updateCin1']);
Route::put('update-cinFace2/{id}', [StudentController::class, 'updateCin2']);
Route::put('update-filePay/{id}',  [StudentController::class, 'updateFilePay']);
Route::put('update-profile/{id}',  [StudentController::class, 'updateProfile']);
// update image de profile Personnel
Route::put('update-profilePersonnel/{id}',  [PersonnelController::class, 'updateProfilePersonnel']);

//Rooms Students Routes 
Route::get('index', [RoomController::class, 'index']);
//Route::post('createRoom', [RoomController::class, 'storeRoom']);
Route::post('createMessage', [RoomController::class, 'storeMessage']);
Route::get('createMessageRecherche/{sender}/{reciever}', [RoomController::class, 'storeMessageRecherche']);
Route::get('getRoomsByIdStudent-old', [RoomController::class, 'allRoomsWithStudents']);
Route::get('getRoomsByIdStudent/{idStudent}', [RoomController::class, 'getRoomsByIdStudent']);
Route::get('getMessagesByRoomId/{idRoom}', [RoomController::class, 'getMessagesByRoomId']);
Route::get('getMaxMessageFromRoom/{idStudent}', [RoomController::class, 'getMaxIdMessageFromRoom']);
Route::delete('delete-room/{id}', [RoomController::class, 'destroy']);

//Conversation Teachers Routes 
Route::get('index', [ConversationController::class, 'index']);
//Route::post('createRoom', [ConversationController::class, 'storeRoom']);
Route::post('createMessageTeacher', [ConversationController::class, 'storeMessageTeacher']);
Route::get('createMessageRechercheTeacher/{sender}/{reciever}', [ConversationController::class, 'storeMessageRechercheTeacher']);
Route::get('getRoomsByIdTeacher-old', [ConversationController::class, 'allRoomsWithTeachers']);
Route::get('getRoomsByIdTeacher/{idTeacher}', [ConversationController::class, 'getRoomsByIdTeacher']);
Route::get('getMessagesByRoomIdFromTeacher/{idConversation}', [ConversationController::class, 'getMessagesByRoomIdFromTeacher']);
Route::get('getMaxMessageFromRoomWithTeacher/{idTeacher}', [ConversationController::class, 'getMaxIdMessageFromRoomWithTeacher']);
Route::delete('delete-room/{id}', [ConversationController::class, 'destroy']);

//Surveillance Routes Teachers
Route::get('posts/{id}', [SurveillanceController::class, 'index']);
Route::post('surveillanceTeacher', [SurveillanceController::class, 'store']);
Route::get('surveillancesTeachers', [SurveillanceController::class, 'getAllSurveillancesWithTeachers']);
Route::get('surveillances-teacher/{id}', [SurveillanceController::class, 'getSurveillanceByIdTeacher']);
Route::get('surveillance-teacher-session/{id}/{session}', [SurveillanceController::class, 'getSurveillanceByIdTeacherAndSession']);
Route::get('post-categorie-teacher/{cat}', [SurveillanceController::class, 'getAllPostsWithCategoryFromTeacher']);
Route::get('edit-surveillance/{id}', [SurveillanceController::class, 'edit']);
Route::put('update-surveillance/{id}', [SurveillanceController::class, 'update']);
Route::delete('delete-surveillance/{id}', [SurveillanceController::class, 'destroy']);

//Posts (Forums) Routes Teachers
Route::get('posts/{id}', [PostTeacherController::class, 'index']);
Route::post('postTeacher', [PostTeacherController::class, 'store']);
Route::get('postsTeachers', [PostTeacherController::class, 'getAllPostsTeachers']);
Route::get('posts-teacher', [PostTeacherController::class, 'getAllPostsWithTeacher']);
Route::get('posts-teacher/{id}', [PostTeacherController::class, 'getAllPostsWithTeacherFromId']);
Route::get('postsByIdTeacher/{id}', [PostTeacherController::class, 'getAllPostsWithIdTeacher']);
Route::get('post-categorie-teacher/{cat}', [PostTeacherController::class, 'getAllPostsWithCategoryFromTeacher']);
Route::get('posts-pagination-id-teacher/{skip}/{take}/{id}', [PostTeacherController::class, 'getPaginationPostsFromTeacher']);
Route::get('posts-pagination-teacher/{skip}/{take}', [PostTeacherController::class, 'getPaginationPostsTeachers']);
Route::put('count-views-posts-teacher/{id}', [PostTeacherController::class, 'CountViewsPostsTeachers']);
Route::get('edit-post-teacher/{id}', [PostTeacherController::class, 'edit']);
Route::put('update-post-teacher/{id}', [PostTeacherController::class, 'update']);
Route::delete('delete-post-teacher/{id}', [PostTeacherController::class, 'destroy']);

//Teachers Routes
Route::get('teacher/{id}', [TeacherController::class, 'index']);
Route::get('teachers', [TeacherController::class, 'getAllTeachers']);
Route::get('teacher-profile', [TeacherController::class, 'getAllTeachersWithProfiles']);
Route::get('teacher-profile/{id}', [TeacherController::class, 'getTeacherWithProfileFromId']);
Route::get('teachersWithDepartement/{departement}', [TeacherController::class, 'teachersWithDepartement']);
Route::get('attendances-teachers', [AttendanceTeacherController::class, 'getAllAttendanceWithTeachers']);
Route::get('attendances-teacher/{teacher}/{day}/{date}', [AttendanceTeacherController::class, 'getAllAttendanceWithTeacherByIdAndDateAndDay']);
Route::get('attendance-teacher/{id}', [TeacherController::class, 'getAllAttendanceWithTeacherFromId']);
Route::get('attendance-teacher-new/{id}', [AttendanceTeacherController::class, 'getAllAttendanceWithTeacherFromId']);
Route::post('add-attendance-teacher', [AttendanceTeacherController::class, 'store']);
Route::put('update-attendance-teacher/{id}', [AttendanceTeacherController::class, 'update']);
Route::get('attendance-details-teacher/{id}', [AttendanceTeacherController::class, 'getAttendanceTeacherByIdAtt']);
Route::get('getCountAttendancesTeachersToday', [AttendanceTeacherController::class, 'getCountAttendancesTeachersToday']);
Route::delete('delete-attendance-teacher/{id}', [AttendanceTeacherController::class, 'destroy']);
Route::get('countTeachersByStatut/{statut}', [TeacherController::class, 'countTeachersByStatut']);
Route::get('countAllNombreTeachers', [TeacherController::class, 'countAllNombreTeachers']);
Route::get('emploi-teacher-day/{id}/{jour}', [TeacherController::class, 'getAllSeanceFromIdTeacherByDay']);
Route::get('emploi-teacher-day-semestre/{id}/{jour}/{semestre}', [TeacherController::class, 'getAllSeanceFromIdTeacherByDayAndSemestre']);
Route::post('teachers', [TeacherController::class, 'store']);
Route::get('edit-teacher/{id}', [TeacherController::class, 'edit']);
Route::put('update-teacher/{id}', [TeacherController::class, 'update']);
Route::put('update-profileTeacher/{id}', [TeacherController::class, 'updateProfile']);
Route::delete('delete-teacher/{id}', [TeacherController::class, 'destroy']);

//Rattrapages Teachers Routes 
Route::post('rattrapages', [RattrapageController::class, 'store']);
Route::get('rattrapage/{id}', [RattrapageController::class, 'index']);
Route::get('all-rattrapages', [RattrapageController::class, 'getAllRattrapages']);
Route::get('rattrapageById/{id}', [RattrapageController::class, 'getRattrapageByIdRattrapage']);
Route::get('all-rattrapages-teachers', [RattrapageController::class, 'getAllRattrapagesWithTeacher']);
Route::get('all-rattrapages-teacher/{id}', [RattrapageController::class, 'getAllRattrapagesWithTeacherFromIdTeacher']);
Route::get('all-rattrapages-classe/{id}', [RattrapageController::class, 'getAllRattrapagesWithTeacherFromIdClasseE1']);
Route::put('update-rattrapage/{id}', [RattrapageController::class, 'update']);
Route::delete('delete-rattrapage/{id}', [RattrapageController::class, 'destroy']);

//Emploi Teacher
Route::get('emploi-teacher/{id}', [EmploiTeacherController::class, 'getAllSeanceFromIdTeacher']);
Route::get('emploi-teacher-semestre/{id}/{semestre}', [EmploiTeacherController::class, 'getAllSeanceFromIdTeacherBySemestre']);
Route::post('seance-teacher', [EmploiTeacherController::class, 'store']);
Route::delete('delete-seance-teacher/{id}', [EmploiTeacherController::class, 'destroy']);
Route::delete('delete-seance-teacher-semestre/{id}', [EmploiTeacherController::class, 'destroySeanceFromSemestre']);

//Emploi Classe
Route::get('emploi-classe/{id}', [ClasseController::class, 'getAllSeanceFromIdClasse']);
Route::get('emploi-classe-semestre/{id}/{semestre}', [ClasseController::class, 'getAllSeanceFromIdClasseBySemestre']);
Route::get('emploi-classe-day/{id}/{jour}', [ClasseController::class, 'getAllSeanceFromIdClasseByDay']);
Route::get('emploi-classe-day-semestre/{id}/{jour}/{semestre}', [ClasseController::class, 'getAllSeanceFromIdClasseByDayAndSemestre']);

//Disponibilité salle
Route::get('getAllDataFromSalleEmplois',  [SalleController::class, 'getAllDataFromSalleEmplois']);
Route::get('getAllDataFromSalleEmploiS2', [SalleController::class, 'getAllDataFromSalleEmploiS2']);
//Rattrapage
Route::get('rattrapageclass/{id}', [RattrapageController::class, 'getAllRattrapagesWithTeacherFromIdClasseE2']);
Route::get('getAllRattrapagesWithTeacherFromDate/{date}', [RattrapageController::class, 'getAllRattrapagesWithTeacherFromDate']);
Route::get('getCountRattrapagesTeachersByStatut', [RattrapageController::class, 'getCountRattrapagesTeachersByStatut']);
Route::get('countAllRattrapagesTeachers', [RattrapageController::class, 'countAllRattrapagesTeachers']);
//get Présence par id étudiant
Route::get('absenceEtudiant/{id}', [AttendanceController::class, 'getPresenceParIdEtudiant']);
//get API Cours par id classe
Route::get('Coursbyclasse/{id}', [CoursController::class, 'getCoursbyclasse']);
//get Avis par id classe
Route::get('avisByClasse/{id}', [AvisController::class, 'getAvisByClasse']);
//get API Emploi par id classe 
Route::get('emploiByClass/{jour}/{id}', [EmploiController::class, 'getEmploiByClass']);
Route::get('emploiByClassFromSemestre/{jour}/{id}/{semestre}', [EmploiController::class, 'getEmploiByClassFromSemestre']);
//get API Emploi par id teacher 
Route::get('emploiByTeacher/{jour}/{id}', [EmploiController::class, 'getEmploiByTeacher']);
Route::get('emploiByTeacherFromSemestre/{jour}/{id}/{semestre}', [EmploiController::class, 'getEmploiByTeacherFromSemestre']);
//add attendance from students by teacher
Route::post('attendances-students', [AttendanceController::class, 'store']);
// get date now
Route::get('date-now', [myAPIController::class, 'dateNowApi']);

//Emploi de temps student Type file
Route::get('getAllEmploiTempsStudent', [EmploiTempsFileController::class, 'index']);
Route::get('getEmploiTempsStudent/{id}', [EmploiTempsFileController::class, 'getAllEmploiTempsStudentByIdClasse']);
Route::get('getEmploiTempsStudentByIdEmploi/{id}', [EmploiTempsFileController::class, 'getAllEmploiTempsStudentByIdEmploi']);
Route::get('getEmploiTempsStudentSemestre/{id}/{semestre}', [EmploiTempsFileController::class, 'getAllEmploiTempsStudentByIdClasseAndSemestre']);
Route::post('emploi-student-file', [EmploiTempsFileController::class, 'store']);
Route::put('update-emploiTempsFile/{id}', [EmploiTempsFileController::class, 'update']);
//update image d'emploi de temps Teacher
Route::put('update-emploiTempsPhotoStudent/{id}', [EmploiTempsFileController::class, 'updatePhotoEmploi']);
Route::delete('delete-emploiTempsFile/{id}', [EmploiTempsFileController::class, 'destroy']);
//Emploi des examens student Type file
Route::get('getAllEmploiExamenStudent', [EmploiExamenFileController::class, 'index']);
Route::get('getEmploiExamenStudent/{id}', [EmploiExamenFileController::class, 'getAllEmploiExamenStudentByIdClasse']);
Route::get('getEmploiExamenStudentByIdEmploi/{id}', [EmploiExamenFileController::class, 'getAllEmploiExamenStudentByIdEmploi']);
Route::post('emploi-examen-student', [EmploiExamenFileController::class, 'store']);
Route::put('update-emploiExamenStudent/{id}', [EmploiExamenFileController::class, 'update']);
//update image d'emploi des examens Student
Route::put('update-emploiExamenPhotoStudent/{id}', [EmploiExamenFileController::class, 'updatePhotoEmploiExamen']);
Route::delete('delete-emploiExamenStudent/{id}', [EmploiExamenFileController::class, 'destroy']);

//Emploi de temps teacher Type file
Route::get('getAllEmploiTempsTeacher', [EmploiTempsFileTeacherController::class, 'index']);
Route::get('getEmploiTempsTeacher/{id}', [EmploiTempsFileTeacherController::class, 'getEmploiTempsTeacherByIdteacher']);
Route::get('getEmploiTempsTeacherBySemestre/{id}/{semestre}', [EmploiTempsFileTeacherController::class, 'getEmploiTempsTeacherBySemestre']);
Route::get('getEmploiTempsTeacherByIdEmploi/{id}', [EmploiTempsFileTeacherController::class, 'getEmploiTempsTeacherByIdEmploi']);
//update image d'emploi de temps Teacher
Route::put('update-emploiTempsPhotoTeacher/{id}', [EmploiTempsFileTeacherController::class, 'updatePhotoEmploi']);
Route::post('emploi-teacher-file', [EmploiTempsFileTeacherController::class, 'store']);
Route::put('update-emploiTempsFileTeacher/{id}', [EmploiTempsFileTeacherController::class, 'update']);
Route::delete('delete-emploiTempsFileTeacher/{id}', [EmploiTempsFileTeacherController::class, 'destroy']);
//Emploi des examens teacher Type file
Route::get('getAllEmploiExamenTeacher', [EmploiExamenFileTeacherController::class, 'index']);
Route::get('getEmploiExamenTeacher/{id}', [EmploiExamenFileTeacherController::class, 'getEmploiExamenTeacherByIdTeacher']);
Route::get('getEmploiExamenTeacherByIdEmploi/{id}', [EmploiExamenFileTeacherController::class, 'getEmploiExamenTeacherByIdEmploi']);
Route::get('getCountEmploiExamenTeacher', [EmploiExamenFileTeacherController::class, 'getCountEmploiExamenTeacher']);
Route::get('getCountEmploiExamenStudent', [EmploiExamenFileController::class, 'getCountEmploiExamenStudent']);

//update image d'emploi de temps Teacher
Route::put('update-emploiSurveillancePhoto/{id}', [EmploiExamenFileTeacherController::class, 'updatePhotoEmploiExamen']);
Route::post('emploi-examen-teacher', [EmploiExamenFileTeacherController::class, 'store']);
Route::put('update-emploiExamenTeacher/{id}', [EmploiExamenFileTeacherController::class, 'update']);
Route::delete('delete-emploiExamenTeacher/{id}', [EmploiExamenFileTeacherController::class, 'destroy']);

//Notes Etudiants Par Classe
Route::post('notes', [NoteController::class, 'store']);
Route::get('all-notes', [NoteController::class, 'getAllNotes']);
Route::get('noteByClasse/{id}', [NoteController::class, 'getAllNotesByClasse']);
Route::get('noteByIdNote/{id}', [NoteController::class, 'getNoteById']);
Route::put('update-note/{id}', [NoteController::class, 'update']);
Route::put('update-notesFile/{id}', [NoteController::class, 'updatePDFnotes']);
Route::delete('delete-note/{id}', [NoteController::class, 'destroy']);

//Change password Student
Route::put('changePasswordStudent/{id}',  [StudentController::class, 'updatePasswordFromStudent']);
Route::put('changePasswordTeacher/{id}',  [TeacherController::class, 'updatePasswordFromTeacher']);
Route::put('changePasswordPersonnel/{id}',[PersonnelController::class, 'updatePasswordFromPersonnel']);

//Like post(forum) Student
Route::post('newLikeStudent', [ApiController::class, 'createNewLikeStudent']);
Route::get('allLikesFromPostStudent', [ApiController::class, 'getAllLikeFromAllPostStudent']);
Route::get('allLikesByIdStudent/{id}', [ApiController::class, 'getAllLikeFromAllPostByIdStudent']);
Route::get('allLikesByIdPost/{id}', [ApiController::class, 'getAllLikeFromAllPostByIdPost']);
Route::get('testLikeOfPost/{idPost}/{idstudent}', [ApiController::class, 'testLikeOfPostFromStudent']);
Route::delete('delete-likePostStudent/{id}', [ApiController::class, 'deleteLikePostStudent']);

//Like post(forum) Teacher
Route::post('newLikeTeacher', [ApiController::class, 'createNewLikeTeacher']);
Route::get('allLikesFromPostTeacher', [ApiController::class, 'getAllLikeFromAllPostTeacher']);
Route::get('allLikesByIdTeacher/{id}', [ApiController::class, 'getAllLikeFromAllPostByIdTeacher']);
Route::get('allLikesByIdPostTeacher/{id}', [ApiController::class, 'getAllLikeFromAllPostByIdPostTeacher']);
Route::get('testLikeOfPostTeacher/{idPost}/{idTeacher}', [ApiController::class, 'testLikeOfPostFromTeacher']);
Route::delete('delete-likePostTeacher/{id}', [ApiController::class, 'deleteLikePostTeacher']);

//Notification Student Socket.io + Trigger
Route::post('notification', [NotificationController::class, 'store']);
Route::get('all-notifications-attendances', [NotificationController::class, 'getAllNotifications']);
Route::get('notificationsAttendancesViews/{view}', [NotificationController::class, 'getAllNotificationsViewsFromAttendances']);
Route::get('getAllNotificationsByIdStudent/{id}', [NotificationController::class, 'getAllNotificationsByIdStudent']);
Route::put('update-views-notification-attendances/{id}', [NotificationController::class, 'updateViewsNotificationAttendances']);
Route::put('update-notification/{id}', [NotificationController::class, 'update']);
Route::delete('delete-notification/{id}', [NotificationController::class, 'destroy']);

//Conditions d'utilisation
Route::get('conditions', [ConditionController::class, 'index']);
Route::get('conditionByType/{type}', [ConditionController::class, 'getConditionByType']);
Route::post('add-condition', [ConditionController::class, 'store']);
Route::put('update-condition/{id}', [ConditionController::class, 'update']);
Route::delete('delete-condition/{id}', [ConditionController::class, 'destroy']);

//Stage PFE API 
Route::put('update-pfeDirection/{id}',   [PfeController::class, 'update']);
Route::put('update-propositionPFE/{id}', [PfeController::class, 'updatePropositionPFE']);
Route::put('update-attestationPFE/{id}', [PfeController::class, 'updateAttestationPFE']);
Route::put('update-rapportPFE/{id}',     [PfeController::class, 'updateRapportPFE']);
Route::delete('delete-pfeDirection/{id}',[PfeController::class, 'destroy']);

//Stage Professionnel API
Route::post('professionnel', [ProfessionnelController::class, 'store']);
Route::get('all-professionnels', [ProfessionnelController::class, 'getAllPointages']);

Route::put('update-proDirection/{id}',   [ProfessionnelController::class, 'proDirection']);
Route::put('update-propositionStagePro/{id}', [ProfessionnelController::class, 'updatePropositionStagePro']);
Route::put('update-attestationStagePro/{id}', [ProfessionnelController::class, 'updateAttestationStagePro']);
Route::put('update-rapportStagePro/{id}',     [ProfessionnelController::class, 'updateRapportStagePro']);

Route::put('update-professionnel/{id}', [ProfessionnelController::class, 'update']);
Route::put('update-updateStagePro/{id}', [ProfessionnelController::class, 'updateStagePro']);
Route::delete('delete-professionnel/{id}', [ProfessionnelController::class, 'destroy']);

//Rapports Students API 
Route::post('rapport', [RapportController::class, 'store']);
Route::get('all-rapports', [RapportController::class, 'getAllPointages']);
Route::put('update-rapport/{id}', [RapportController::class, 'update']);
Route::put('update-updateStageRapport/{id}', [RapportController::class, 'updateStageRapport']);
Route::delete('delete-rapport/{id}', [RapportController::class, 'destroy']);

//Activité Clubs API 
Route::get('getStudentsByIdClub/{idClub}',   [ClubController::class, 'getStudentsByIdClub']);
Route::put('update-updateClubAccepter/{id}', [ClubController::class, 'updateClubAccepter']);
Route::put('update-updateClubActiver/{id}',  [ClubController::class, 'updateClubActiver']);
Route::delete('delete-club/{id}',            [ClubController::class, 'destroy']);
Route::delete('delete-affectStudent/{idAffect}/{idDemande}', [ClubController::class, 'destroyAffectStudent']);

//Activité Sortie API 
Route::put('update-updateSortieAccepter/{id}', [SortieController::class, 'updateSortieAccepter']);
Route::put('update-updateSortieFaite/{id}',    [SortieController::class, 'updateSortieFaite']);
Route::delete('delete-sortie/{id}',            [SortieController::class, 'destroy']);

//Activité Mission API 
Route::put('update-updateMissionAccepter/{id}', [MissionDemandeController::class, 'updateMissionAccepter']);
Route::put('update-updateMissionFaite/{id}',    [MissionDemandeController::class, 'updateMissionFaite']);
Route::delete('delete-sortie/{id}',             [MissionDemandeController::class, 'destroy']);

//Clubs API
Route::get('getClubById/{id}',           [ClubStudentController::class, 'index']);
Route::post('clubStudents',              [ClubStudentController::class, 'store']);
Route::get('all-clubs-students',         [ClubStudentController::class, 'getAllClubs']);
Route::put('update-clubStudent/{id}',    [ClubStudentController::class, 'update']);
Route::put('update-logoClub/{id}',       [ClubStudentController::class, 'updateLogoClub']);
Route::delete('delete-clubStudent/{id}', [ClubStudentController::class, 'destroy']);

//Spécialités Enseignants Routes 
Route::get('specialite/{id}', [SpecialiteController::class, 'index']);
Route::post('specialites', [SpecialiteController::class, 'store']);
Route::get('specialites', [SpecialiteController::class, 'getAllSpecialites']);
Route::put('update-specialite/{id}', [SpecialiteController::class, 'update']);
Route::delete('delete-specialite/{id}', [SpecialiteController::class, 'destroy']);

//Variables API
Route::get('variable',                  [VariableController::class, 'index']);
Route::put('update-variable',           [VariableController::class, 'update']);
Route::put('updateSignatureDirecteur',  [VariableController::class, 'updateSignatureDirecteur']);
Route::put('updateSignatureSecretaire', [VariableController::class, 'updateSignatureSecretaire']);
Route::put('updateLogoVariable',        [VariableController::class, 'updateLogoVariable']);

//surface map
Route::get('getSurfaceMap', [AttendanceTeacherController::class, 'getSurfaceMap']);
//Trigger Event&Listener  
Route::get('youtube', [TriggerController::class, 'getVideo']);
Route::put('addOneSignalKeyStudent/{id}', [AdminController::class, 'addOneSignalKeyStudent']);
Route::post('saveIdOneSignalStudent', [AdminController::class, 'storeOneSignal']);
Route::get('getAllModelsNotification', [AdminController::class, 'getAllModelsNotification']);
Route::get('getStudentOneSignalById/{id}', [AdminController::class, 'getStudentOneSignalById']);

Route::get('classe', [testController::class, 'index']);
Route::post('sendPush', [testController::class, 'sendPush']);
Route::get('testDatabaseSql', [DemandeStudentController::class, 'testDatabaseSql']);

});