<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', function () {
    return view('index');
});

Route::get('/', function () {
    return view('index');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/logout', [LogoutController::class, 'logout']);
Route::post('/logout', [LogoutController::class, 'logout']);


Route::prefix('/admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/add_lecturer', [UsersController::class, 'addLecturerView']);
        Route::get('/edit_lecturer/{user_id}', [UsersController::class, 'addLecturerView']);
        Route::post('/create_or_update_lecturer', [UsersController::class, 'addEditLecturer']);
        Route::get('/list/lecturers', [UsersController::class, 'listUsers']);
        Route::get('/list/students', [UsersController::class, 'listUsers']);

        Route::get('/add_course', [CourseController::class, 'addCourseView']);
        Route::get('/edit_course/{course_id}', [CourseController::class, 'addCourseView']);
        Route::post('/create_or_update_course', [CourseController::class, 'addEditCourse']);
        Route::get('/list/students', [CourseController::class, 'listCourse']);
    });
