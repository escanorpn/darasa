<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KidatoController;


use App\Http\Controllers\RoleController;
// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\CompanyController;
// use App\Http\Controllers\ServiceController;
// use App\Http\Controllers\ProjectController;
// use App\Http\Controllers\RecipeController;
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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/new_register', [AuthController::class, 'register']);
    Route::post('/signup', [AuthController::class, 'signup']);
    // Route::get('/hod', [HodController::class, 'index']); 
    // Route::post('/logout', [AuthController::class, 'logout']);
    // Route::post('/refresh', [AuthController::class, 'refresh']);
    // Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});
Route::group(['middleware' => ['jwt.verify'],
'prefix' => 'auth'], function() {

});
Route::group(['middleware' => ['role:admin'],
'prefix' => 'auth'], function() {
    Route::post('/role', [RoleController::class, 'create']); 
});
Route::group(['middleware' => ['role:rec'],
'prefix' => 'auth'], function() {
    Route::get('/rec', [HodController::class, 'index']);
    Route::get('/rcleared_user', [HodController::class, 'cleared_user']);  
    Route::post('/rec_u', [HodController::class, 'rupdate']); 
});

Route::group(['middleware' => ['role:hod'],
'prefix' => 'auth'], function() {
    Route::get('/kidato', [KidatoController::class, 'index']);
    Route::post('/kidato', [KidatoController::class, 'create']);
    Route::get('/students', [KidatoController::class, 'students']);
    Route::post('/admited', [KidatoController::class, 'admited']);
    Route::post('/admiting', [KidatoController::class, 'admiting']);
    
    Route::post('/addSubject', [KidatoController::class, 'addSubject']);
    Route::get('/showSubjects', [KidatoController::class, 'showSubjects']);
    Route::post('/mSubjects', [KidatoController::class, 'mSubjects']);
    Route::post('/aSubjects', [KidatoController::class, 'aSubjects']);
    Route::post('/aMarks', [KidatoController::class, 'aMarks']);
    Route::post('/gMarks', [KidatoController::class, 'gMarks']);
});

// Route::post('/gMarks1', [KidatoController::class, 'gMarks']);
Route::group(['middleware' => ['role:student'],
'prefix' => 'auth'], function() {
    Route::post('/gMarks1', [KidatoController::class, 'gMarks']);
});


// Route::get('/students', [KidatoController::class, 'students']);

Route::get('/', function()
{
    return 'Hello World';
});
