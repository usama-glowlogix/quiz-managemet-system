<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AttempQuizController;

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
Auth::routes();
/// category routes
Route::get('/admin', [AdminController::class,'dashboard']);
Route::group(['prefix' => 'admin'], function () {
    Route::get('/question', [QuestionController::class,'index']);
    Route::get('/question/create', [QuestionController::class,'create']);
    Route::post('/question/store', [QuestionController::class,'store']);
    Route::get('/question/{id}/edit', [QuestionController::class,'edit']);
    Route::patch('/question/update', [QuestionController::class,'update']);
    Route::delete('/question/{id}', [QuestionController::class,'destroy']);


    Route::get('/quiz', [QuizController::class,'index']);
    Route::get('/quiz/create', [QuizController::class,'create']);
    Route::post('/quiz/store', [QuizController::class,'store']);
    Route::get('/quiz/{id}/edit', [QuizController::class,'edit']);
    Route::patch('/quiz/update', [QuizController::class,'update']);
    Route::delete('/quiz/{id}', [QuizController::class,'destroy']);

    Route::get('/users', [UserController::class,'index']);
    Route::get('/attemp-quiz', [AttempQuizController::class,'index']);
    Route::get('/attempt-quiz/{id}', [AttempQuizController::class,'show']);
});
