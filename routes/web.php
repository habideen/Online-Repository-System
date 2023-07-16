<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Instructor\DashboardController as InstructorDashboardController;
use App\Http\Controllers\Instructor\ManageController;
use Illuminate\Http\Request;
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
    return view('upload');
});

Route::any('/upload', function (Request $request) {
    dd($request->all());
});

Route::get('/google', [GoogleController::class, 'google']);

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
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/add_lecturer', [UsersController::class, 'addLecturerView']);
        Route::get('/edit_lecturer/{user_id}', [UsersController::class, 'addLecturerView']);
        Route::post('/create_or_update_lecturer', [UsersController::class, 'addEditLecturer']);
        Route::get('/list/lecturers', [UsersController::class, 'listUsers']);
        Route::get('/list/students', [UsersController::class, 'listUsers']);

        Route::get('/add_course', [CourseController::class, 'addCourseView']);
        Route::get('/edit_course/{course_code}', [CourseController::class, 'addCourseView']);
        Route::post('/create_or_update_course', [CourseController::class, 'addEditCourse']);
        Route::get('/list/courses', [CourseController::class, 'listCourse']);

        Route::get('/instructor', [ManagementController::class, 'sessionCourseList']);
        Route::get('/course_info', [ManagementController::class, 'courseInfoView']);
        Route::post('/add_lecturer_to_course', [ManagementController::class, 'updateInstructor']);
        Route::get('/set_course_cordinator', [ManagementController::class, 'setCourseCordinate']);
        Route::get('/delete_course_instructor', [ManagementController::class, 'deleteCourseCordinate']);
        Route::get('/update_session', [ManagementController::class, 'updateSessionView']);
        Route::post('/update_session', [ManagementController::class, 'updateSession']);
        Route::get('/update_session_courses', [ManagementController::class, 'updateSessionCourses']);
    });


Route::prefix('/instructor')
    ->middleware(['auth', 'instructor'])
    ->group(function () {
        Route::get('/', [InstructorDashboardController::class, 'index']);
        Route::get('/current_session', [ManageController::class, 'currentSession']);
        Route::get('/all_session', [ManageController::class, 'allSessions']);
        Route::get('/course_info', [ManageController::class, 'courseInfoView']);
        Route::post('/update_course_metadata', [ManageController::class, 'updateCourseMetadata']);
    });
