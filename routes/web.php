<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentClassController;



Route::get('/login', [UserController::class, 'loginPage'])->name('login');

Route::post("/user-registration", [UserController::class, "userRegistration"]);
Route::post("/user-login", [UserController::class, "userLogin"]);



Route::get('/dashboard', [DashboardController::class, 'adminDashboard']);
Route::get('/student/class', [StudentClassController::class, 'student_class']);




Route::middleware(['auth:sanctum'])->group(function () {
Route::post('/student-class-post', [StudentClassController::class, 'student_class_post']);
Route::post('/student-class-delete-by-id', [StudentClassController::class, 'student_class_delete_by_id']);
Route::post('/student-class-detail-by-id', [StudentClassController::class, 'student_class_detail_by_id']);
Route::post('/student-class-update-by-id', [StudentClassController::class, 'student_class_update_by_id']);
Route::get('/student-class-lists', [StudentClassController::class, 'student_class_lists']);
});


