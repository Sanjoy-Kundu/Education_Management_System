<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubSubjectController;
use App\Http\Controllers\ExamScheduleController;
use App\Http\Controllers\StudentClassController;

Route::get('/login', [UserController::class, 'loginPage'])->name('login');
Route::get('/register', [UserController::class, 'registerPage']);

Route::post('/user-registration', [UserController::class, 'userRegistration']);
Route::post('/user-login', [UserController::class, 'userLogin']);



    Route::get('/dashboard', [DashboardController::class, 'adminDashboard']);
    Route::get('/class/lists', [StudentClassController::class, 'student_class']);
    Route::get('/subject/lists', [SubjectController::class, 'subject_lists']);
    Route::get('/class/routine', [RoutineController::class, 'class_routine_lists']);
    Route::get('/exam/schedule/lists', [ExamScheduleController::class, 'exam_schedule_lists_page']);





Route::middleware(['auth:sanctum'])->group(function () {
    //class routes
    Route::get('/student-class-lists', [StudentClassController::class, 'student_class_lists']);
    Route::post('/student-class-post', [StudentClassController::class, 'student_class_post']);
    Route::post('/student-class-delete-by-id', [StudentClassController::class, 'student_class_delete_by_id']);
    Route::post('/student-class-detail-by-id', [StudentClassController::class, 'student_class_detail_by_id']);
    Route::post('/student-class-update-by-id', [StudentClassController::class, 'student_class_update_by_id']);

    //subject routes
    Route::get('/subject-lists', [SubjectController::class, 'all_subject_lists']);
    Route::post('/subject-lists-by-class-id', [SubjectController::class, 'subject_lists_by_class_id']);
    Route::post('/subject-papers-by-subject-id', [SubjectController::class, 'subject_papers_by_subject_id']);
    Route::post('/subject-post', [SubjectController::class, 'subject_create']);
    Route::post('/subject-delete-by-id', [SubjectController::class, 'subject_delete_by_id']);
    Route::post('/subject-detail-by-id', [SubjectController::class, 'subject_detail_by_id']);
    Route::post('/subject-update-by-id', [SubjectController::class, 'subject_update_by_id']);

    //sub subject routes
    Route::post('/sub-subject-create', [SubSubjectController::class, 'sub_subject_create']);
    Route::post('/sub-subject-view-lists', [SubSubjectController::class, 'sub_subject_view_lists']);
    Route::post('/sub-subject-lists-by-subject-id', [SubSubjectController::class, 'sub_subject_lists_by_subject_id']);

    //exam schedule routes
    Route::get('/exam-schedule-lists', [ExamScheduleController::class, 'exam_schedule_lists']);
    Route::post('/exam-schedule-post', [ExamScheduleController::class, 'exam_schedule_post']);
    Route::post('/exam-schedule-delete-by-id', [ExamScheduleController::class, 'exam_schedule_delete_by_id']);
    Route::post('/exam-shedule-detail-by-id', [ExamScheduleController::class, 'exam_shedule_detail_by_id']);
    Route::get('/exam-schedule-lists-by-class-id/{id}', [ExamScheduleController::class, 'exam_schedule_lists_by_class_id']);
    // Route::post('/download-exam-schedule/{id}', [ExamScheduleController::class, 'download_exam_schedule_pdf']);

    //routine routes
    Route::post('/subject-lists-by-class-name-routine', [RoutineController::class, 'subject_lists_by_class_routine']);
    Route::post('/subject-papers-by-subject', [RoutineController::class, 'getSubjectPapersBySubject']);
    Route::post('/routine-create', [RoutineController::class, 'routine_create']);

});

