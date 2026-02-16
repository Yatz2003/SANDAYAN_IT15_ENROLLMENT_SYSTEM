<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard/enroll', [DashboardController::class, 'enroll'])->name('dashboard.enroll');
Route::post('/dashboard/drop', [DashboardController::class, 'drop'])->name('dashboard.drop');

Route::resource('students', StudentController::class)->only(['index', 'show']);
Route::resource('courses', CourseController::class)->only(['index', 'show']);
Route::post('students/{student}/enroll', [EnrollmentController::class, 'store'])->name('students.enroll');

