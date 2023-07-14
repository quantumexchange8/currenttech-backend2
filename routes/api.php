<?php

use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\CheckinController;
use App\Http\Controllers\Api\ClaimController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\LeaveController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', 'AuthController@login');

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::controller(DepartmentController::class)->group(function () {
        Route::get('/departments', 'index');
        Route::get('/departments/{id}', 'show');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index');
        Route::get('/users/{id}', 'show');
        Route::post('/users_profile', 'update');
    });

    Route::controller(AnnouncementController::class)->group(function () {
        Route::get('/announcements', 'index');
    });

    Route::controller(ProjectController::class)->group(function () {
        Route::get('/projects', 'index');
        Route::get('/projects/{id}', 'show');
        Route::post('/tasks/{id}', 'complete');
    });

    Route::controller(FeedbackController::class)->group(function () {
        Route::post('/feedbacks', 'store');
    });

    Route::controller(CheckinController::class)->group(function () {
        Route::get('/checkins', 'index');
        Route::post('/checkins', 'store');
    });

    Route::controller(LeaveController::class)->group(function () {
        Route::get('/leaves', 'index');
        Route::get('/leaves/{id}', 'show');
        Route::post('/leaves', 'store');
        Route::post('/leaves_update/{id}', 'update');
        Route::delete('/leaves/{id}', 'delete');
    });

    Route::controller(ClaimController::class)->group(function () {
        Route::get('/claims', 'index');
        Route::post('/claims', 'store');
    });

    //Auth
    Route::post('/logout', 'AuthController@logout');
});

Route::fallback(function(){
    return response()->json([
        'success' => 'false',
        'message' => 'Page Not Found. If error persists, contact admin!'
    ], 404);

});
