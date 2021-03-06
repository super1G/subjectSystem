<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('student');
});

Auth::routes();

Route::get('/students', function () {
    return view('student');
})->name('students');

Route::get('/teachers', function () {
    return view('teacher');
})->name('teachers');

Route::get('/curriculums', function () {
    return view('curriculum');
})->name('curriculums');    

Route::get('/electives', function () {
    return view('elective');
})->name('electives');   

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
