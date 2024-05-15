<?php

use App\Http\Controllers\Api\CityObjectController;
use App\Http\Controllers\Api\LocationCategoryController;
use App\Http\Controllers\Api\ObjectCategoryController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\FirebaseController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('city-objects')->group(function () {
    Route::get('/{city_id}', [CityObjectController::class,'index']);
    Route::post('/store', [CityObjectController::class,'store']);
});


Route::get('entities/{city_id}', [CityObjectController::class,'detail']);

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class,'index']);
    Route::post('/store', [UserController::class,'store']);
    Route::put('/update/{id}', [UserController::class,'update']);
    Route::delete('/delete/{id}', [UserController::class,'destroy']);
});

Route::prefix('object-categories')->group(function () {
    Route::get('/', [ObjectCategoryController::class,'index']);
    Route::post('/store', [ObjectCategoryController::class,'store']);
    Route::put('/update/{id}', [ObjectCategoryController::class,'update']);
    Route::delete('/delete/{id}', [ObjectCategoryController::class,'destroy']);
});

Route::prefix('tasks')->group(function () {
    Route::get('/{task_type?}', [TaskController::class,'index']);
    Route::post('/target-reconnaissance/add/', [TaskController::class,'addTargetReconnaissance']);
    Route::delete('/target-reconnaissance/delete/{id}', [TaskController::class,'deleteTargetReconnaissance']);
});
Route::get('/ping', [FirebaseController::class,'addData']);

Route::prefix('location-categories')->group(function () {
    Route::get('/', [LocationCategoryController::class,'index']);
});
Route::get('/route/publish', [FirebaseController::class,'publish']);
Route::post('/route/publish', [FirebaseController::class,'publishRoute']);
