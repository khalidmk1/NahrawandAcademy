<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GoalController;
use App\Http\Controllers\Api\CoursController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\ProgramController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProfileClientController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();

});


Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy_api'])->name('logout');
    Route::post('/update/client/{id}', [ProfileClientController::class, 'update_client'])->name('update.client');
    Route::post('update/password', [ProfileClientController::class, 'password_update'])->name('update.password');
    
});





Route::prefix('mobile')->group(function () {

    // Get client by id
    Route::get('/client/{id}', [ProfileClientController::class, 'getClientById'])->name('client');
    //api speaker populaire 
    Route::get('/populare/speaker', [ProfileClientController::class, 'populaire_speaker'])->name('populaire.speaker');

    //favoris Api
    Route::post('/cour/favoris/{id}/{cour}', [CoursController::class, 'Cour_Favoris'])->name('cour.favoris');
    Route::get('/cour/favoris/all/{id}', [CoursController::class, 'AllFavoris'])->name('cour.favoris.all');

    //all cours
    Route::get('/allCours', [CoursController::class, 'allCours'])->name('all.cours');

    //create personel cours
    Route::post('create/personel/cours/{user}/{cour}', [CoursController::class, 'personelCours'])->name('create.personel.cours');
    Route::get('personel/cours/{id}', [CoursController::class, 'getpersonelCours'])->name('personel.cours');

    //personel video podcast formation
    Route::post('personel/video/podcast/{user}/{video}', [CoursController::class, 'personelvideoPodcast'])->name('creat.personel.video.podcast');
    Route::post('personel/video/formation/{user}/{video}', [CoursController::class, 'personelvideoFormation'])->name('creat.personel.video.formation');


    Route::get('/short', [CoursController::class, 'CourShort'])->name('cours.short');


    //cours api
    Route::get('/cours/coming', [CoursController::class, 'coming_cours'])->name('cours.coming');

    Route::get('/Cour/Conference', [CoursController::class, 'Cour_Conference'])->name('cours.conference');
    Route::get('/Cour/Podcast', [CoursController::class, 'Cour_Podcast'])->name('cours.podcast');
    Route::get('/Cour/Formation', [CoursController::class, 'Cour_Formation'])->name('cours.formation');
    //get Cour Qsm
    Route::get('/Cour/Formation/Qsm/{id}', [CoursController::class, 'Cour_Fourmation_Qsm'])->name('cours.formation.Qsm');
    //create question answer for user
    Route::post('user/answer/{user}/{cour}/{questionId}', [CoursController::class, 'user_answer'])->name('user.question.answer');

    //cours tree 
    Route::get('/Cour/tree/Formation', [CoursController::class, 'treeCoursFormation'])->name('cours.tree.formation');
    
    Route::get('Cours/formation/detail/{id}', [CoursController::class, 'Cour_Formation_detail'])->name('formation.detail');
    //Cours Comment
    Route::post('/cours/comment/{id}/{cours}', [CoursController::class, 'CoursComment'])->name('cour.comment.create');
    //get Comment
    Route::get('/cours/comment/{cours}', [CoursController::class, 'getComment'])->name('cour.comment');
    
    //domain api
    Route::get('/domain', [GoalController::class, 'domain'])->name('domain');
    //program api
    Route::get('/program', [ProgramController::class, 'program'])->name('program');

    //get goals
    Route::get('/goals', [GoalController::class, 'getGoals'])->name('goals');
   // user goal
   Route::post('user/goal/{id}/{goal}', [GoalController::class, 'UserObjectif'])->name('user.goal');

   //cours goal
   Route::get('cours/goal/{id}', [GoalController::class, 'CoursGoal'])->name('cours.goal');

   //get user manager
   Route::get('manager', [TicketController::class, 'getmanager'])->name('manager');

   //store ticket
   Route::post('ticket/{id}', [TicketController::class, 'store_ticket'])->name('create.ticket');
   Route::get('ticket/user/{id}', [TicketController::class, 'get_ticket'])->name('ticket.user');

    Route::post('/login', [AuthenticatedSessionController::class, 'login_api'])
    ->middleware('guest')
    ->name('login.api');
    
    Route::post('/register', [RegisteredUserController::class, 'store_api'])
    ->middleware('guest')
    ->name('register.api');
});



