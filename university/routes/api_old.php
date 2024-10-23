<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\myAPIController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AuthTeacherController;
use App\Http\Controllers\API\AuthPersonnelController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationSystemController;

use App\Http\Controllers\EventController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
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
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MessageServiceController;
use App\Http\Controllers\AgendaController; 
use App\Http\Controllers\AttendanceController; 
use App\Http\Controllers\ConditionController; 
use App\Http\Controllers\ClubStudentController; 
// Teacher
use App\Http\Controllers\Teachers\ProfileTeacherController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Http\Controllers\Teachers\DemandeTeacherController;
use App\Http\Controllers\Teachers\ReclamationTeacherController;
use App\Http\Controllers\Teachers\RattrapageController;
use App\Http\Controllers\Teachers\VoeuController;
use App\Http\Controllers\Teachers\VoeuMatiereController;
use App\Http\Controllers\Teachers\EmploiTeacherController;
use App\Http\Controllers\Teachers\AttendanceTeacherController;
use App\Http\Controllers\Teachers\PostTeacherController;
use App\Http\Controllers\Teachers\SurveillanceController;
use App\Http\Controllers\Teachers\PointageController;
use App\Http\Controllers\Teachers\ConversationController;
use App\Http\Controllers\Teachers\SpecialiteController;
//Personnel 
use App\Http\Controllers\Personnels\AttendancePersonnelController;
use App\Http\Controllers\Personnels\ProfilePersonnelController;
use App\Http\Controllers\Personnels\PersonnelController;
use App\Http\Controllers\Personnels\DemandePersonnelController;
use App\Http\Controllers\Personnels\ReclamationPersonnelController;
use App\Http\Controllers\Personnels\CongeController;
use App\Http\Controllers\Personnels\MissionController;
use App\Http\Controllers\Personnels\FormationController;
use App\Http\Controllers\Personnels\TelechargementPersonnelController;
use App\Http\Controllers\Personnels\NoteProfessionnelController;
use App\Http\Controllers\Personnels\PostePersonnelController;
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
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'APIToken'], function() {
 
//Posts (Forums) Routes 
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
Route::get('alldemandwithstudent/{id}', [DemandeStudentController::class, 'AllDemandesWithStudentFromID']);
Route::get('demandestudent', [DemandeStudentController::class, 'getAllDemandes']);
Route::get('demandefromstudent', [DemandeStudentController::class, 'getAllDemandesFromStudent']);
Route::get('studentfromdemand', [DemandeStudentController::class, 'getAllStudentFromDemandes']);
Route::put('update-demandestudent/{id}', [DemandeStudentController::class, 'update']);
Route::delete('delete-demandestudent/{id}', [DemandeStudentController::class, 'destroy']);

//Reclamations Students Routes 
Route::get('reclamations/{id}', [ReclamationController::class, 'index']);
Route::post('reclamations', [ReclamationController::class, 'store']);
Route::get('reclamations', [ReclamationController::class, 'getAllReclams']);
Route::get('reclamation-studend/{id}', [ReclamationController::class, 'getReclamWithStudent']);
Route::get('reclamation-studend-filter/{id}/{statut}', [ReclamationController::class, 'getReclamWithStudentFilter']);
Route::put('update-reclamation/{id}', [ReclamationController::class, 'update']);
Route::delete('delete-reclamation/{id}', [ReclamationController::class, 'destroy']);

//Profiles Students Routes
Route::get('/profiles/{id}', [ProfileStudentController::class, 'index']);
Route::get('profiles', [ProfileStudentController::class, 'getAllProfileStudents']);
Route::post('profiles', [ProfileStudentController::class, 'store']);

//Bibliotheque Routes 
Route::post('books', [BibliothequeController::class, 'store']);
Route::get('book/{id}', [BibliothequeController::class, 'index']);
Route::get('books', [BibliothequeController::class, 'getAllBooks']);
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
Route::put('update-avis/{id}',        [StageController::class, 'update']);
Route::delete('delete-avis/{id}',     [StageController::class, 'destroy']);

//Emploi(offre de travail) Routes 
Route::post('emplois', [EmploiController::class, 'store']);
Route::get('emplois/{id}', [EmploiController::class, 'index']);
Route::get('all-emplois', [EmploiController::class, 'getAllEmplois']);
Route::get('emplois-pagination/{skip}/{take}', [EmploiController::class, 'getPaginationEmplois']);
Route::put('count-views-emplois/{id}', [EmploiController::class, 'CountViewsEmploi']);
Route::put('update-emplois/{id}', [EmploiController::class, 'update']);
Route::delete('delete-emplois/{id}', [EmploiController::class, 'destroy']);

//Student Routes
Route::get('student/{id}', [StudentController::class, 'index']);
Route::get('students', [StudentController::class, 'getAllStudents']);
Route::get('student-profile', [StudentController::class, 'getAllStudentsWithProfiles']);
Route::get('students-classes', [StudentController::class, 'getAllStudentsWithClasse']);
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
Route::get('delete-student/{id}', [StudentController::class, 'destroy']);
});

Route::group(['middleware' => 'APITokenTeacher'], function() {

/*                                                         Teachers                               */

//Teachers Routes
Route::get('teacher/{id}', [TeacherController::class, 'index']);
Route::get('teachers', [TeacherController::class, 'getAllTeachers']);
Route::get('teacher-profile', [TeacherController::class, 'getAllTeachersWithProfiles']);
Route::get('teacher-profile/{id}', [TeacherController::class, 'getTeacherWithProfileFromId']);
Route::get('attendance-teacher/{id}', [TeacherController::class, 'getAllAttendanceWithTeacherFromId']);
Route::get('teachersWithDepartement/{departement}', [TeacherController::class, 'teachersWithDepartement']);
Route::post('teachers', [TeacherController::class, 'store']);
Route::get('edit-teacher/{id}', [TeacherController::class, 'edit']);
Route::put('update-teacher/{id}', [TeacherController::class, 'update']);
Route::put('update-profileTeacher/{id}', [TeacherController::class, 'updateProfile']);
Route::delete('delete-teacher/{id}', [TeacherController::class, 'destroy']);

//Demandes Teachers Routes 
Route::post('demandeteacher', [DemandeTeacherController::class, 'store']);
Route::get('demandeteacher/{id}', [DemandeTeacherController::class, 'index']);
Route::get('demandefromteacher/{id}', [DemandeTeacherController::class, 'demandefromteacher']);
Route::get('alldemandwithteacher/{id}', [DemandeTeacherController::class, 'AllDemandesWithTeacherFromID']);
Route::get('demandeteacher', [DemandeTeacherController::class, 'getAllDemandes']);
Route::get('demandefromteacher', [DemandeTeacherController::class, 'getAllDemandesFromTeacher']);
Route::get('teacherfromdemand', [DemandeTeacherController::class, 'getAllTeachersFromDemandes']);
Route::put('update-demandeteacher/{id}', [DemandeTeacherController::class, 'update']);
Route::delete('delete-demandeteacher/{id}', [DemandeTeacherController::class, 'destroy']);

//Reclamations Students Routes 
Route::get('reclamationsTeacher/{id}', [ReclamationTeacherController::class, 'index']);
Route::post('reclamationsTeacher', [ReclamationTeacherController::class, 'store']);
Route::get('reclamationsTeacher', [ReclamationTeacherController::class, 'getAllReclams']);
Route::get('reclamation-teacher/{id}', [ReclamationTeacherController::class, 'getReclamWithTeacher']);
Route::get('reclamationsTeacherFiltrer/{id}/{statut}', [ReclamationTeacherController::class, 'getReclamWithTeacherFilter']);
Route::put('update-reclamation-teacher/{id}', [ReclamationTeacherController::class, 'update']);
Route::delete('delete-reclamation-teacher/{id}', [ReclamationTeacherController::class, 'destroy']);

//Rattrapages Teachers Routes 
Route::post('rattrapages', [RattrapageController::class, 'store']);
Route::get('rattrapage/{id}', [RattrapageController::class, 'index']);
Route::get('all-rattrapages', [RattrapageController::class, 'getAllRattrapages']);
Route::get('all-rattrapages-teachers', [RattrapageController::class, 'getAllRattrapagesWithTeacher']);
Route::get('all-rattrapages-teacher/{id}', [RattrapageController::class, 'getAllRattrapagesWithTeacherFromIdTeacher']);
Route::get('all-rattrapages-classe/{id}', [RattrapageController::class, 'getAllRattrapagesWithTeacherFromIdClasse']);
Route::put('update-rattrapage/{id}', [RattrapageController::class, 'update']);
Route::delete('delete-rattrapage/{id}', [RattrapageController::class, 'destroy']);

//Voeux Teachers Routes 
Route::post('voeux', [VoeuController::class, 'store']);
Route::post('voeuxmatiere', [VoeuMatiereController::class, 'store']);
Route::get('voeux/{id}', [VoeuController::class, 'index']);
Route::get('all-voeux', [VoeuController::class, 'getAllVoeux']);
Route::get('all-voeux-teachers', [VoeuController::class, 'getAllVoeuxWithTeacher']);
Route::get('all-voeux-teacher/{id}', [VoeuController::class, 'getAllVoeuxWithTeacherFromIdTeacher']);
Route::get('all-voeux-byid/{id}', [VoeuController::class, 'getAllVoeuxWithTeacherFromIdVoeu']);
Route::put('update-voeu/{id}', [VoeuController::class, 'update']);
Route::delete('delete-voeu/{id}', [VoeuController::class, 'destroy']);

});  

Route::group(['middleware' => 'APITokenTeacher'], function() {

/*                                                         Personnels                               */

//Personnels Routes
Route::get('personnel/{id}', [PersonnelController::class, 'index']);
Route::get('personnels', [PersonnelController::class, 'getAllPersonnels']);
Route::get('personnel-profile', [PersonnelController::class, 'getAllPersonnelsWithProfiles']);
Route::get('personnel-profile/{id}', [PersonnelController::class, 'getPersonnelWithProfileFromId']);
Route::get('attendance-personnel/{id}', [PersonnelController::class, 'getAllAttendanceWithPersonnelFromId']);
Route::post('personnels', [PersonnelController::class, 'store']);
Route::get('edit-personnel/{id}', [PersonnelController::class, 'edit']);
Route::put('update-personnel/{id}', [PersonnelController::class, 'update']);
Route::put('update-profilepersonnel/{id}', [ProfilePersonnelController::class, 'updateProfile']);
Route::delete('delete-personnel/{id}', [PersonnelController::class, 'destroy']);

//Demandes Personnels Routes 
Route::post('demandepersonnel', [DemandePersonnelController::class, 'store']);
Route::get('demandepersonnel/{id}', [DemandePersonnelController::class, 'index']);
Route::get('demandefrompersonnel/{id}', [DemandePersonnelController::class, 'demandefrompersonnel']);
Route::get('alldemandwithpersonnel/{id}', [DemandePersonnelController::class, 'AllDemandesWithPersonnelFromID']);
Route::get('demandepersonnel', [DemandePersonnelController::class, 'getAllDemandes']);
Route::get('demandefrompersonnel', [DemandePersonnelController::class, 'getAllDemandesFromPersonnel']);
Route::get('personnelsfromdemand', [DemandePersonnelController::class, 'getAllPersonnelsFromDemandes']);
Route::get('count-demande-personnel', [DemandePersonnelController::class, 'getCountDemandeInvalide']);
Route::get('count-all-demande-personnel', [DemandePersonnelController::class, 'getCountAllDemandes']);
Route::put('update-demandepersonnel/{id}', [DemandePersonnelController::class, 'update']);
Route::delete('delete-demandepersonnel/{id}', [DemandePersonnelController::class, 'destroy']);

//Reclamations Personnels Routes 
Route::get('reclamationsPersonnel/{id}', [ReclamationPersonnelController::class, 'index']);
Route::post('reclamationsPersonnel', [ReclamationPersonnelController::class, 'store']);
Route::get('reclamationsPersonnel', [ReclamationPersonnelController::class, 'getAllReclams']);
Route::get('reclamation-personnel/{id}', [ReclamationPersonnelController::class, 'getReclamWithPersonnel']);
Route::get('reclamation-personnel-filter/{id}/{statut}', [ReclamationPersonnelController::class, 'getReclamWithPersonnelFilter']);
Route::get('count-reclamation-personnel', [ReclamationPersonnelController::class, 'getCountReclamationInvalide']);
Route::get('count-all-reclamation-personnel', [ReclamationPersonnelController::class, 'getCountAllReclamations']);
Route::put('update-reclamation-personnel/{id}', [ReclamationPersonnelController::class, 'update']);
Route::delete('delete-reclamation-personnel/{id}', [ReclamationPersonnelController::class, 'destroy']);

//Congés Teachers Routes 
Route::post('conges', [CongeController::class, 'store']);
Route::get('conges/{id}', [CongeController::class, 'index']);
Route::get('all-conges', [CongeController::class, 'getAllConges']);
Route::get('all-conges-personnels', [CongeController::class, 'getAllCongesWithPersonnels']);
Route::get('all-conges-personnel/{id}', [CongeController::class, 'getAllCongesFromIdPersonnel']);
Route::get('all-categories-conge', [CongeController::class, 'getAllCategoriesOfConge']);
Route::put('update-conge/{id}', [CongeController::class, 'update']);
Route::delete('delete-conge/{id}', [CongeController::class, 'destroy']);
//Count Congés Personnels
Route::get('all-conges-maternite/{id}',        [CongeController::class, 'getAllCongesOfMaternite']);
Route::get('all-conges-annuel/{id}',           [CongeController::class, 'getAllCongesOfAnnuel']);
Route::get('all-conges-naissance-enfant/{id}', [CongeController::class, 'getAllCongesOfNaissanceEnfant']);
Route::get('all-conges-deces-conjoint/{id}',   [CongeController::class, 'getAllCongesOfDecesConjoint']);
Route::get('all-conges-deces-pmf/{id}',        [CongeController::class, 'getAllCongesOfDecesPMF']);
Route::get('all-conges-deces-fspg/{id}',       [CongeController::class, 'getAllCongesOfDecesFSPG']);
Route::get('all-conges-mariage-trav/{id}',     [CongeController::class, 'getAllCongesOfMariageTravailleur']);
Route::get('all-conges-mariange-enf/{id}',     [CongeController::class, 'getAllCongesOfMariageEnfant']);
Route::get('all-conges-circoncision/{id}',     [CongeController::class, 'getAllCongesOfCirconcision']);
//Reste Congés Personnels
Route::get('reste-conges-maternite/{id}',        [CongeController::class, 'resteCongesOfMaternite']);
Route::get('reste-conges-annuel/{id}',           [CongeController::class, 'resteCongesOfAnnuel']);
Route::get('reste-conges-naissance-enfant/{id}', [CongeController::class, 'resteCongesOfNaissanceEnfant']);
Route::get('reste-conges-deces-conjoint/{id}',   [CongeController::class, 'resteCongesOfDecesConjoint']);
Route::get('reste-conges-deces-pmf/{id}',        [CongeController::class, 'resteCongesOfDecesPMF']);
Route::get('reste-conges-deces-fspg/{id}',       [CongeController::class, 'resteCongesOfDecesFSPG']);
Route::get('reste-conges-mariage-trav/{id}',     [CongeController::class, 'resteCongesOfMariageTravailleur']);
Route::get('reste-conges-mariange-enf/{id}',     [CongeController::class, 'resteCongesOfMariageEnfant']);
Route::get('reste-conges-circoncision/{id}',     [CongeController::class, 'resteCongesOfCirconcision']);

//Ordres & missions Personnels Routes 
Route::post('missions', [MissionController::class, 'store']);
Route::get('missions/{id}', [MissionController::class, 'index']);
Route::get('all-missions', [MissionController::class, 'getAllMissions']);
Route::get('all-missions-personnels', [MissionController::class, 'getAllMissionsWithPersonnels']);
Route::get('all-missions-personnel/{id}', [MissionController::class, 'getAllMissionsFromIdPersonnel']);
Route::get('mission-personnel/{id}', [MissionController::class, 'getAllMissionsFromIdMission']);
Route::put('update-mission/{id}', [MissionController::class, 'update']);
Route::delete('delete-mission/{id}', [MissionController::class, 'destroy']);

});  
// cd /domains/smartschools.tn/public_html/university schedule:run >> /dev/null 2>&1
// php /domains/smartschools.tn/public_html/university/artisan schedule:run >> /dev/null 2>&1
// /user/local/bin/php /domains/smartschools.tn/public_html/university/artisan schedule:run >> /dev/null 2>&1

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

//Profiles Teachers Routes
Route::get('/profiles/{id}', [ProfileTeacherController::class, 'index']);
Route::get('profiles', [ProfileTeacherController::class, 'getAllProfileStudents']);
Route::post('profiles-teachers', [ProfileTeacherController::class, 'store']);
Route::get('/profiles-teacher/{id}', [ProfileTeacherController::class, 'index']);
Route::get('profiles-teacher', [ProfileTeacherController::class, 'getAllProfileTeachers']);

//Profiles Personnels Routes
Route::get('/profiles/{id}', [ProfilePersonnelController::class, 'index']);
Route::get('profiles-teachers', [ProfilePersonnelController::class, 'getAllProfilePersonnels']);
Route::post('profiles-personnels', [ProfilePersonnelController::class, 'store']);
Route::get('/profiles-personnel/{id}', [ProfilePersonnelController::class, 'index']);
Route::get('profiles-personnel', [ProfilePersonnelController::class, 'getAllProfilePersonnels']);

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

//Avis Routes 
Route::middleware(['cors'])->group(function () {
Route::post('avis', [AvisController::class, 'store']);
Route::post('avis-classe', [AvisController::class, 'storeScolarite']);
Route::get('avis/{id}', [AvisController::class, 'index']);
Route::get('all-avis', [AvisController::class, 'getAllAvis']);
Route::get('avis-pagination/{skip}/{take}/{type}', [AvisController::class, 'getPaginationAvis']);
Route::put('count-views-avis/{id}', [AvisController::class, 'CountViewsAvis']);
Route::get('avis-type/{type}', [AvisController::class, 'getAllAvisWithType']);
Route::get('all-avis-teacher', [AvisController::class, 'avisTeacher']);
Route::get('all-avis-personnel', [AvisController::class, 'avisPersonnel']);
Route::put('update-avis/{id}', [AvisController::class, 'update']);
Route::delete('delete-avis/{id}', [AvisController::class, 'destroy']);
//Avis Teacher

Route::put('update-imageAvis/{id}', [AvisController::class, 'updateImageAvis']);
Route::put('update-fileAvis/{id}',  [AvisController::class, 'updateFileAvis']);
//Avis scolarité
Route::get('avis-classes/{id}', [AvisController::class, 'avisScolariteClasseWithIdAvis']);
Route::get('all-avis-scolarite', [AvisController::class, 'avisScolarite']);
Route::get('all-avis-scolarite-classe', [AvisController::class, 'avisScolariteWithClasses']);
Route::get('all-avis-scolarite-classe/{id}', [AvisController::class, 'allAvisScolariteByIdClasse']);

});


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

//Agenda Routes 
Route::get('agenda/{id}', [AgendaController::class, 'index']);
Route::post('agenda', [AgendaController::class, 'store']);
Route::get('all-agenda', [AgendaController::class, 'getAllAgenda']);
Route::get('all-agenda-users', [AgendaController::class, 'getAgendaWithUser']);
Route::get('all-agenda-users/{id}', [AgendaController::class, 'getAgendaWithIDUserAndLimit']);
Route::get('all-agenda-user/{id}', [AgendaController::class, 'getAgendaWithIDUser']);
Route::get('getAllNotesByIdAdmin/{id}', [AgendaController::class, 'getAllNotesByIdAdmin']);
Route::put('update-agenda/{id}', [AgendaController::class, 'update']);
Route::put('update-fileAgenda/{id}', [AgendaController::class, 'updateFileAgenda']);
Route::delete('delete-agenda/{id}', [AgendaController::class, 'destroy']);

//Téléchargements Routes 
Route::get('downloads', [TelechargementController::class, 'index']);
Route::get('download/{id}', [TelechargementController::class, 'getFileById']);
Route::get('downloadCategory/{category}', [TelechargementController::class, 'getFileByCategory']);
Route::post('download', [TelechargementController::class, 'store']);
Route::put('update-download-stage/{id}', [TelechargementController::class, 'update']);
//Route::delete('delete-download/{id}', [TelechargementController::class, 'destroy']);
Route::delete('delete-downloadFichier/{id}', [TelechargementController::class, 'destroy']);





/*                          Admins                         */
//Admins (users)  Routes 
Route::get('admin/{id}', [AdminController::class, 'index']);
Route::post('admins', [AdminController::class, 'store']);
Route::get('admins', [AdminController::class, 'getAllAdmins']);
Route::put('update-admin/{id}', [AdminController::class, 'update']);
Route::delete('delete-admin/{id}', [AdminController::class, 'destroy']);

/**************************************     Notifications         ***************************************/
Route::get('notification', [NotificationSystemController::class, 'index']);
Route::get('notifsystem-model/{id}', [NotificationSystemController::class, 'getNotifWithModelAndEventByID']);
Route::get('notifsystem-model', [NotificationSystemController::class, 'getNotifWithModelAndEvent']);
Route::post('notifsystem-admins', [NotificationSystemController::class, 'store']);
Route::get('notifsystem-admins', [NotificationSystemController::class, 'getAllAdmins']);
Route::put('update-notifsystem/{id}', [NotificationSystemController::class, 'update']);
Route::delete('delete-notifsystem/{id}', [NotificationSystemController::class, 'destroy']);

// Route::get('posts', function () {
//     $response = Http::get('http://127.0.0.1:8080/posts'); 
//     return ($response);
// });->middleware('auth')->name('profiles')

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});
Route::post('/auth/token', [ApiController::class, 'store']);
Route::post('/auth/token/student', [ApiController::class, 'storeStudentToken']);
Route::get('getData', [EventController::class, 'getData']);




































/****************************************    No Auth API   ************************************** */

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

//Demandes Teachers Routes 
Route::post('demandeteacher', [DemandeTeacherController::class, 'store']);
Route::get('demandeteacher/{id}', [DemandeTeacherController::class, 'index']);
Route::get('demandefromteacher/{id}', [DemandeTeacherController::class, 'demandefromteacher']);
Route::get('alldemandwithteacher/{id}', [DemandeTeacherController::class, 'AllDemandesWithTeacherFromID']);
Route::get('demandeteacher', [DemandeTeacherController::class, 'getAllDemandes']);
Route::get('demandefromteacher', [DemandeTeacherController::class, 'getAllDemandesFromTeacher']);
Route::get('teacherfromdemand', [DemandeTeacherController::class, 'getAllTeachersFromDemandes']);
Route::put('update-demandeteacher/{id}', [DemandeTeacherController::class, 'update']);
Route::delete('delete-demandeteacher/{id}', [DemandeTeacherController::class, 'destroy']);
Route::get('getCountDemandesTeachers/{statut}', [DemandeTeacherController::class, 'getCountDemandesTeachers']);
Route::get('countAlldemandsTeachers', [DemandeTeacherController::class, 'countAlldemandsTeachers']);


//Reclamations Teachers Routes 
Route::get('reclamationsTeacher/{id}', [ReclamationTeacherController::class, 'index']);
Route::post('reclamationsTeacher', [ReclamationTeacherController::class, 'store']);
Route::get('reclamationsTeacher', [ReclamationTeacherController::class, 'getAllReclams']);
Route::get('reclamation-teacher/{id}', [ReclamationTeacherController::class, 'getReclamWithTeacher']);
Route::get('reclamationsTeacherFiltrer/{id}/{statut}', [ReclamationTeacherController::class, 'getReclamWithTeacherFilter']);
Route::put('update-reclamation-teacher/{id}', [ReclamationTeacherController::class, 'update']);
Route::delete('delete-reclamation-teacher/{id}', [ReclamationTeacherController::class, 'destroy']);
Route::get('getCountReclamationsTeachers/{statut}', [ReclamationTeacherController::class, 'getCountReclamationsTeachers']);
Route::get('countAllReclamationsTeachers', [ReclamationTeacherController::class, 'countAllReclamationsTeachers']);


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

//Voeux Teachers Routes 
Route::post('voeux', [VoeuController::class, 'store']);
Route::post('voeuxmatiere', [VoeuMatiereController::class, 'store']);
Route::get('voeux/{id}', [VoeuController::class, 'index']);
Route::get('all-voeux', [VoeuController::class, 'getAllVoeux']);
Route::get('all-voeux-teachers', [VoeuController::class, 'getAllVoeuxWithTeacher']);
Route::get('all-teachers-voeux', [VoeuController::class, 'getAllTeachersWithVoeux']);
Route::get('getVoeuxByIdTeacher/{id}', [VoeuController::class, 'getAllVoeuxWithTeacherByIdTeacher']);
Route::get('getVoeuxByIdTeacherAndSemestre/{id}/{semestre}', [VoeuController::class, 'getAllVoeuxWithTeacherByIdTeacherAndSemestre']);
Route::get('all-voeux-teacher/{id}', [VoeuController::class, 'getAllVoeuxWithTeacherFromIdTeacher']);

Route::get('teacher-voeu/{id}', [VoeuController::class, 'getVoeuFromIdTeacher']);

Route::get('all-voeux-byid/{id}', [VoeuController::class, 'getAllVoeuxWithTeacherFromIdVoeu']);
Route::put('update-voeu/{id}', [VoeuController::class, 'update']);
Route::delete('delete-voeu/{id}', [VoeuController::class, 'destroy']);

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






//API Ahmed 10/09/2022

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

//Pointages Teachers
Route::post('pointage', [PointageController::class, 'store']);
Route::get('all-pointages', [PointageController::class, 'getAllPointages']);
Route::get('all-pointages-s2', [PointageController::class, 'getAllPointageS2']);
Route::get('pointagesByTeacher/{id}', [PointageController::class, 'getAllPointagesFromTeacher']);
Route::get('HistoriquePointageByDay/{teacher}/{day}', [PointageController::class, 'getHistoriquePointageByDay']);
Route::get('HistoriquePointageByDayAndDate/{teacher}/{day}/{date}', [PointageController::class, 'getHistoriquePointageByDayAndDate']);
Route::get('HistoriquePointageByDates/{teacher}/{date1}/{date2}', [PointageController::class, 'getHistoriquePointageByDates']);
Route::get('getCountPointagesToday', [PointageController::class, 'getCountPointagesToday']);
Route::get('pointageById/{id}', [PointageController::class, 'getPointageById']);
Route::put('update-pointage/{id}', [PointageController::class, 'update']);
Route::delete('delete-pointage/{id}', [PointageController::class, 'destroy']);

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
Route::put('update-updateClubAccepter/{id}', [ClubController::class, 'updateClubAccepter']);
Route::put('update-updateClubActiver/{id}',  [ClubController::class, 'updateClubActiver']);
Route::delete('delete-club/{id}',            [ClubController::class, 'destroy']);

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




//Personnels Routes
Route::get('personnel/{id}', [PersonnelController::class, 'index']);
Route::get('personnels', [PersonnelController::class, 'getAllPersonnels']);
Route::get('personnel-profile', [PersonnelController::class, 'getAllPersonnelsWithProfiles']);
Route::get('personnel-profile/{id}', [PersonnelController::class, 'getPersonnelWithProfileFromId']);
Route::get('attendance-personnel/{id}', [PersonnelController::class, 'getAllAttendanceWithPersonnelFromId']);
Route::get('attendancePersonnel/{id}', [AttendancePersonnelController::class, 'attendancePersonnel']);
Route::get('attendancePersonnels', [AttendancePersonnelController::class, 'attendancePersonnels']);
Route::delete('delete-attendance-personnel/{id}', [AttendancePersonnelController::class, 'destroy']);
Route::get('attendancePersonnelWithDayAndDate/{day}/{date}', [AttendancePersonnelController::class, 'attendancePersonnelWithDayAndDate']);
Route::post('personnels', [PersonnelController::class, 'store']);
Route::get('edit-personnel/{id}', [PersonnelController::class, 'edit']);
Route::put('update-personnel/{id}', [PersonnelController::class, 'update']);
Route::put('update-profilepersonnel/{id}', [ProfilePersonnelController::class, 'updateProfile']);
Route::delete('delete-personnel/{id}', [PersonnelController::class, 'destroy']);
Route::get('countAllNombrePersonnels', [PersonnelController::class, 'countAllNombrePersonnels']);
Route::get('countAllNombreAdmins', [PersonnelController::class, 'countAllNombreAdmins']);
Route::get('countAllAttendancesPersonnels', [AttendancePersonnelController::class, 'countAllAttendancesPersonnels']);

//Demandes Personnels Routes 
Route::post('demandepersonnel', [DemandePersonnelController::class, 'store']);
Route::get('demandepersonnel/{id}', [DemandePersonnelController::class, 'index']);
Route::get('demandefrompersonnel/{id}', [DemandePersonnelController::class, 'demandefrompersonnel']);
Route::get('alldemandwithpersonnel/{id}', [DemandePersonnelController::class, 'AllDemandesWithPersonnelFromID']);
Route::get('demandepersonnel', [DemandePersonnelController::class, 'getAllDemandes']);
Route::get('demandefrompersonnel', [DemandePersonnelController::class, 'getAllDemandesFromPersonnel']);
Route::get('personnelsfromdemand', [DemandePersonnelController::class, 'getAllPersonnelsFromDemandes']);
Route::get('count-demande-personnel', [DemandePersonnelController::class, 'getCountDemandeInvalide']);
Route::get('count-all-demande-personnel', [DemandePersonnelController::class, 'getCountAllDemandes']);
Route::put('update-demandepersonnel/{id}', [DemandePersonnelController::class, 'update']);
Route::delete('delete-demandepersonnel/{id}', [DemandePersonnelController::class, 'destroy']);
Route::get('countAlldemandsPersonnels', [DemandePersonnelController::class, 'countAlldemandsPersonnels']);
Route::get('getCountDemandesPersonnelsWithStatut/{statut}', [DemandePersonnelController::class, 'getCountDemandesPersonnelsWithStatut']);

//Reclamations Personnels Routes 
Route::get('reclamationsPersonnel/{id}', [ReclamationPersonnelController::class, 'index']);
Route::post('reclamationsPersonnel', [ReclamationPersonnelController::class, 'store']);
Route::get('reclamationsPersonnel', [ReclamationPersonnelController::class, 'getAllReclams']);
Route::get('reclamation-personnel/{id}', [ReclamationPersonnelController::class, 'getReclamWithPersonnel']);
Route::get('reclamation-personnel-filter/{id}/{statut}', [ReclamationPersonnelController::class, 'getReclamWithPersonnelFilter']);
Route::get('count-reclamation-personnel', [ReclamationPersonnelController::class, 'getCountReclamationInvalide']);
Route::get('count-all-reclamation-personnel', [ReclamationPersonnelController::class, 'getCountAllReclamations']);
Route::put('update-reclamation-personnel/{id}', [ReclamationPersonnelController::class, 'update']);
Route::delete('delete-reclamation-personnel/{id}', [ReclamationPersonnelController::class, 'destroy']);
Route::get('countAllReclamationsPersonnels', [ReclamationPersonnelController::class, 'countAllReclamationsPersonnels']);
Route::get('getCountReclamationsPersonnelsWithStatut/{id}', [ReclamationPersonnelController::class, 'getCountReclamationsPersonnelsWithStatut']);


//Congés Personnels Routes 
Route::post('conges', [CongeController::class, 'store']);
Route::get('conges/{id}', [CongeController::class, 'index']);
Route::get('all-conges', [CongeController::class, 'getAllConges']);
Route::get('all-conges-personnels', [CongeController::class, 'getAllCongesWithPersonnels']);
Route::get('all-conges-personnel/{id}', [CongeController::class, 'getAllCongesFromIdPersonnel']);
Route::get('all-categories-conge', [CongeController::class, 'getAllCategoriesOfConge']);
Route::put('update-conge/{id}', [CongeController::class, 'update']);
Route::put('update-fileConge/{id}', [CongeController::class, 'updateFileConge']);
Route::delete('delete-conge/{id}', [CongeController::class, 'destroy']);
//Count Congés Personnels
Route::get('all-conges-maternite/{id}',        [CongeController::class, 'getAllCongesOfMaternite']);
Route::get('all-conges-annuel/{id}',           [CongeController::class, 'getAllCongesOfAnnuel']);
Route::get('all-conges-naissance-enfant/{id}', [CongeController::class, 'getAllCongesOfNaissanceEnfant']);
Route::get('all-conges-deces-conjoint/{id}',   [CongeController::class, 'getAllCongesOfDecesConjoint']);
Route::get('all-conges-deces-pmf/{id}',        [CongeController::class, 'getAllCongesOfDecesPMF']);
Route::get('all-conges-deces-fspg/{id}',       [CongeController::class, 'getAllCongesOfDecesFSPG']);
Route::get('all-conges-mariage-trav/{id}',     [CongeController::class, 'getAllCongesOfMariageTravailleur']);
Route::get('all-conges-mariange-enf/{id}',     [CongeController::class, 'getAllCongesOfMariageEnfant']);
Route::get('all-conges-circoncision/{id}',     [CongeController::class, 'getAllCongesOfCirconcision']);
//Reste Congés Personnels
Route::get('reste-conges-maternite/{id}',        [CongeController::class, 'resteCongesOfMaternite']);
Route::get('reste-conges-annuel/{id}',           [CongeController::class, 'resteCongesOfAnnuel']);
Route::get('reste-conges-naissance-enfant/{id}', [CongeController::class, 'resteCongesOfNaissanceEnfant']);
Route::get('reste-conges-deces-conjoint/{id}',   [CongeController::class, 'resteCongesOfDecesConjoint']);
Route::get('reste-conges-deces-pmf/{id}',        [CongeController::class, 'resteCongesOfDecesPMF']);
Route::get('reste-conges-deces-fspg/{id}',       [CongeController::class, 'resteCongesOfDecesFSPG']);
Route::get('reste-conges-mariage-trav/{id}',     [CongeController::class, 'resteCongesOfMariageTravailleur']);
Route::get('reste-conges-mariange-enf/{id}',     [CongeController::class, 'resteCongesOfMariageEnfant']);
Route::get('reste-conges-circoncision/{id}',     [CongeController::class, 'resteCongesOfCirconcision']);
Route::get('getAllYears',                        [CongeController::class, 'getAllYears']);
//Soldes Congés Personnels Routes 
Route::post('soldes',    [CongeController::class, 'storeSoldePersonnels']);
Route::get('getSoldePersonnelByIdSolde/{id}', [CongeController::class, 'getSoldePersonnelByIdSolde']);
Route::get('getAllSoldesByIdPersonnel/{id}', [CongeController::class, 'getAllSoldesByIdPersonnel']);
Route::get('getAllSoldesFromPersonnels', [CongeController::class, 'getAllSoldesFromPersonnels']);
Route::get('getAllSoldesFromPersonnelByIdPersonnel/{id}', [CongeController::class, 'getAllSoldesFromPersonnelByIdPersonnel']);
Route::post('saveSoldePersonnel', [CongeController::class, 'saveSoldePersonnel']);
Route::put('update-solde/{id}', [CongeController::class, 'updateSoldePersonnel']);
Route::delete('delete-elementSolde/{id}', [CongeController::class, 'destroySoldePersonnel']);

//Ordres & missions Personnels Routes 
Route::post('missions', [MissionController::class, 'store']);
Route::get('missions/{id}', [MissionController::class, 'index']);
Route::get('all-missions', [MissionController::class, 'getAllMissions']);
Route::get('all-missions-personnels', [MissionController::class, 'getAllMissionsWithPersonnels']);
Route::get('all-missions-personnel/{id}', [MissionController::class, 'getAllMissionsFromIdPersonnel']);
Route::get('mission-personnel/{id}', [MissionController::class, 'getAllMissionsFromIdMission']);
Route::put('update-mission/{id}', [MissionController::class, 'update']);
Route::put('update-fileMission/{id}', [MissionController::class, 'updateFileMission']);
Route::delete('delete-mission/{id}', [MissionController::class, 'destroy']);

//Formations Personnels Routes 
Route::get('formations/{id}', [FormationController::class, 'index']);
Route::post('formations', [FormationController::class, 'store']);
Route::get('getAllFormations', [FormationController::class, 'getAllFormations']);
Route::get('getAllFormationsWithPersonnels', [FormationController::class, 'getAllFormationsWithPersonnels']);
Route::get('getAllFormationsWithPersonnelByIdPersonnel/{id}', [FormationController::class, 'getAllFormationsWithPersonnelByIdPersonnel']);
Route::get('getFormationWithPersonnelByIdFormation/{id}', [FormationController::class, 'getFormationWithPersonnelByIdFormation']);
Route::put('update-formation/{id}', [FormationController::class, 'update']);
Route::put('update-fileFormation/{id}', [FormationController::class, 'updateFileFormation']);
Route::delete('delete-formation/{id}', [FormationController::class, 'destroy']);

//Téléchargement Personnels Routes 
Route::get('downloads/{id}', [TelechargementPersonnelController::class, 'index']);
Route::post('downloads-personnel', [TelechargementPersonnelController::class, 'store']);
Route::get('getAllDownloadsPersonnels', [TelechargementPersonnelController::class, 'getAllDownloadsPersonnels']);
Route::get('getAllDownloadsWithPersonnels', [TelechargementPersonnelController::class, 'getAllDownloadsWithPersonnels']);
Route::get('getAllDownloadsWithPersonnelByIdPersonnel/{id}', [TelechargementPersonnelController::class, 'getAllDownloadsWithPersonnelByIdPersonnel']);
Route::get('getDownloadWithPersonnelByIdDownload/{id}', [TelechargementPersonnelController::class, 'getDownloadWithPersonnelByIdDownload']);
Route::put('update-download/{id}', [TelechargementPersonnelController::class, 'update']);
Route::put('update-fileDownload/{id}', [TelechargementPersonnelController::class, 'updateFileDownload']);
Route::delete('delete-download/{id}', [TelechargementPersonnelController::class, 'destroy']);
Route::delete('delete-download-stage/{id}', [TelechargementPersonnelController::class, 'destroyServiceStage']);

//Notes Professionnelles Personnels Routes 
Route::get('notePro/{id}', [NoteProfessionnelController::class, 'index']);
Route::post('notes-professionnelles', [NoteProfessionnelController::class, 'store']);
Route::get('getAllNotesProfessionnelles', [NoteProfessionnelController::class, 'getAllNotesProfessionnelles']);
Route::get('getAllNotesWithPersonnels', [NoteProfessionnelController::class, 'getAllNotesWithPersonnels']);
Route::get('getAllNotesWithPersonnelByIdPersonnel/{id}', [NoteProfessionnelController::class, 'getAllNotesWithPersonnelByIdPersonnel']);
Route::get('getNoteWithPersonnelByIdNote/{id}', [NoteProfessionnelController::class, 'getNoteWithPersonnelByIdNote']);
Route::put('update-notePro/{id}', [NoteProfessionnelController::class, 'update']);
Route::put('update-fileNote/{id}', [NoteProfessionnelController::class, 'updateFileNote']);
Route::delete('delete-notePro/{id}', [NoteProfessionnelController::class, 'destroy']);

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

//Postes Personnels (Fonction, Grade, Categorie) Routes
Route::get('postePersonnel/{id}',         [PostePersonnelController::class, 'index']);
Route::get('AllPostePersonnelsFonction',  [PostePersonnelController::class, 'getAllPostePersonnelsFonction']);
Route::get('AllPostePersonnelsCategorie', [PostePersonnelController::class, 'getAllPostePersonnelsCategorie']);
Route::get('AllPostePersonnelsGrade',     [PostePersonnelController::class, 'getAllPostePersonnelsGrade']);
Route::post('postePersonnels',            [PostePersonnelController::class, 'store']);
Route::put('update-poste/{id}',           [PostePersonnelController::class, 'update']);
Route::delete('delete-poste/{id}',        [PostePersonnelController::class, 'destroy']);

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





