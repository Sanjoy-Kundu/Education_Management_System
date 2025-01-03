<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentClassController;



Route::get('/login', [UserController::class, 'loginPage'])->name('login');

Route::post("/user-registration", [UserController::class, "userRegistration"]);
Route::post("/user-login", [UserController::class, "userLogin"]);



Route::get('/dashboard', [DashboardController::class, 'adminDashboard']);
Route::get('/student/class', [StudentClassController::class, 'student_class']);
Route::get('/subject/lists', [SubjectController::class, 'subject_lists']);



Route::middleware(['auth:sanctum'])->group(function () {
Route::get('/student-class-lists', [StudentClassController::class, 'student_class_lists']);
Route::post('/student-class-post', [StudentClassController::class, 'student_class_post']);
Route::post('/student-class-delete-by-id', [StudentClassController::class, 'student_class_delete_by_id']);
Route::post('/student-class-detail-by-id', [StudentClassController::class, 'student_class_detail_by_id']);
Route::post('/student-class-update-by-id', [StudentClassController::class, 'student_class_update_by_id']);



Route::get('/subject-lists', [SubjectController::class, 'all_subject_lists']);
Route::post('/subject-post', [SubjectController::class, 'subject_create']);
Route::post('/subject-delete-by-id', [SubjectController::class, 'subject_delete_by_id']);
Route::post('/subject-detail-by-id', [SubjectController::class, 'subject_detail_by_id']);
Route::post('/subject-update-by-id', [SubjectController::class, 'subject_update_by_id']);
});


