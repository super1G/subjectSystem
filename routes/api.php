<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\ElectiveController;
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

Route::apiResource('students',StudentController::class);
Route::apiResource('teachers',TeacherController::class);
Route::apiResource('curriculums',CurriculumController::class);
Route::apiResource('electives',ElectiveController::class);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
