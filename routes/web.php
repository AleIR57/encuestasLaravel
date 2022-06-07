<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\MultipleQuestionController;
use App\Http\Controllers\AnswerController;

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
    return view('auth.login');
});

/*Route::get('/users', function () {
    return view('users.index');
});

Route::get('users/create', [UserController::class,'create']);
*/
Route::resource('users', UserController::class)->middleware(('auth'));
Auth::routes();

Route::get('/home', [UserController::class, 'index'])->name('home');

Route::get('/indexStudents', [UserController::class, 'indexStudents'])->name('indexStudents');

Route::get('indexStudents/{id}/answerStudents', [UserController::class, 'answerStudents'])->name('answerStudents');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [UserController::class, 'index'])->name('home');
});

Route::resource('polls', PollController::class)->middleware(('auth'));

Route::resource('questions', QuestionController::class)->middleware(('auth'));

Route::resource('multiple_questions', MultipleQuestionController::class)->middleware(('auth'));


Route::resource('answers', AnswerController::class)->middleware(('auth'));



