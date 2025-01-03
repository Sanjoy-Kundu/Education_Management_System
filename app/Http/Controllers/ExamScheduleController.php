<?php

namespace App\Http\Controllers;

use App\Models\ExamSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function exam_schedule_lists_page()
    {
        try{
            return view('pages.auth.examShedulePage');
        }catch(Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }


    public function exam_schedule_lists()
    {
        try{
            $exam_schedules = ExamSchedule::with('subject', 'studentClass')->get();
            return response()->json(['status' => 'success', 'exam_schedules' => $exam_schedules]);
        }catch(Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }




    public function exam_schedule_post(Request $request)
    {
        try{

            $request->validate([
                'subject_id' => 'required|exists:subjects,id',
                'student_class_id' => 'required|exists:student_classes,id', 
                'name' => 'required|string|max:255',
                'exam_date' => 'required|date_format:Y-m-d', 
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
            ]);


            ExamSchedule::create([
                'user_id'=> Auth::id(),
                'subject_id' => $request->subject_id,
                'student_class_id' => $request->student_class_id,
                'name' => $request->name,
                'exam_date' => $request->exam_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time
            ]);
            return response()->json(['status' => 'success', 'message' => 'Exam Schedule created successfully']);
        }
        catch(Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ExamSchedule $examSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamSchedule $examSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExamSchedule $examSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamSchedule $examSchedule)
    {
        //
    }
}
