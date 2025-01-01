<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentClassController;



Route::get('/login', [UserController::class, 'loginPage'])->name('login');

Route::post("/user-registration", [UserController::class, "userRegistration"]);
Route::post("/user-login", [UserController::class, "userLogin"]);


Route::middleware(['auth:sanctum'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'adminDashboard']);
Route::get('/student/class', [StudentClassController::class, 'student_class']);
Route::post('/student-class-post', [StudentClassController::class, 'student_class_post'])->middleware('auth:sanctum');
});


