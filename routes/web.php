<?php

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
        Route::post('/add_lecturer', [UsersController::class, 'addLecturer']);
        Route::get('/list/lecturers', [UsersController::class, 'listUsers']);
        Route::get('/list/students', [UsersController::class, 'index']);
    });
