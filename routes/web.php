<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentClassController;

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

Route::post("/user-registration", [UserController::class, "userRegistration"]);
Route::post("/user-login", [UserController::class, "userLogin"]);


Route::get('/dashboard', [DashboardController::class, 'adminDashboard']);
Route::get('/student/class', [StudentClassController::class, 'student_class']);