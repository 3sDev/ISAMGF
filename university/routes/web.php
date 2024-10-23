<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\BibliothequeController;
use App\Http\Controllers\EtudiantController;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;


Route::get('test', function () {
    return ('Hello');
});

Route::get('empty', function () {
    return view('empty');
});

Route::get('dashboard', function () {
    return view('dashboard');
});

Route::resource('/students', StudentController::class);

//Events Routes
Route::resource('/events', EventController::class);
Route::get('edit-event/{id}', [EventController::class, 'edit']);
Route::put('update-event/{id}', [EventController::class, 'update']);

//Maps Routes
Route::resource('/maps', MapController::class);
Route::get('edit-map/{id}', [MapController::class, 'edit']);
Route::put('update-map/{id}', [MapController::class, 'update']);

//News Routes
Route::resource('/news', NewsController::class);
Route::get('edit-news/{id}', [NewsController::class, 'edit']);
Route::put('update-news/{id}', [NewsController::class, 'update']);

//Departmemnts Routes
Route::resource('/departements', DepartementController::class);
Route::get('edit-departements/{id}', [DepartementController::class, 'edit']);
Route::put('update-departements/{id}', [DepartementController::class, 'update']);

//Section Routes
Route::resource('/sections', SectionController::class);
Route::get('edit-section/{id}', [SectionController::class, 'edit']);
Route::put('update-section/{id}', [SectionController::class, 'update']);

//Levels Routes
Route::resource('/levels', LevelController::class);
Route::get('edit-level/{id}', [LevelController::class, 'edit']);
Route::put('update-level/{id}', [LevelController::class, 'update']);

//Classes Routes
Route::resource('/classes', ClasseController::class);
Route::get('getSection',[ClasseController::class, 'getSection'])->name('getSection');
Route::get('edit-classe/{id}', [ClasseController::class, 'edit']);
Route::put('update-classe/{id}', [ClasseController::class, 'update']);

//Salle Routes
Route::resource('/salles', SalleController::class);
Route::get('edit-salle/{id}', [SalleController::class, 'edit']);
Route::put('update-salle/{id}', [SalleController::class, 'update']);

//Subject(Matière) Routes
Route::resource('/matieres', MatiereController::class);
Route::get('edit-matiere/{id}', [MatiereController::class, 'edit']);
Route::put('update-matiere/{id}', [MatiereController::class, 'update']);

//Library(bibliothèque) Routes
Route::resource('/bibliotheques', BibliothequeController::class);
Route::get('edit-bibliotheque/{id}', [BibliothequeController::class, 'edit']);
Route::put('update-bibliotheque/{id}', [BibliothequeController::class, 'update']);

//Etudiants Routes
Route::resource('/etudiants', EtudiantController::class);
Route::get('edit-etudiant/{id}', [EtudiantController::class, 'edit']);
Route::put('update-etudiant/{id}', [EtudiantController::class, 'update']);

//Posts (Forums) Routes
Route::resource('/posts', PostController::class);
Route::get('edit-post/{id}', [PostController::class, 'edit']);
Route::put('update-post/{id}', [PostController::class, 'update']);

//Commentaires Routes
Route::get('/comments', [CommentController::class, 'index']);

//Profiles Routes
Route::get('/profiles', [ProfileController::class, 'index']);

//Courses Routes
Route::get('/courses', [CourseController::class, 'index']);

// Image intervention
Route::get('resizeimage', [ImageController::class, 'resizeImage']);
Route::post('add-image', [ImageController::class, 'convertImageTo64']);

// Route::get('getTodo', function () {
//     $response = Http::get('http://127.0.0.1:8000/events'); 
//     return ($response);
// });