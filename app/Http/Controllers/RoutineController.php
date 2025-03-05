<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Routine;
use App\Models\Subject;
use App\Models\SubSubject;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class RoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function class_routine_lists()
    {
        try {
            return view('pages.auth.routinePage');
        } catch (Exception $ex) {
           
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function subject_lists_by_class_routine(Request $request)
    {
        try {
           $student_class_id = $request->input('student_class_id');
           $subjectlistByClass = Subject::where('student_class_id',$student_class_id)->get();
           return response()->json(["status" => "success", "subjects"=>$subjectlistByClass]);
        } catch (Exception $ex) {
            return response()->json(['status' => "error", "message"=>$ex->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getSubjectPapersBySubject(Request $request)
    {
        try{
            $subject_id = $request->input('subject_id');
            $query = Subject::where('subject_id',$subject_id)->get();
            return response()->json(["status" => "succcess", "papers"=>$query]);
        }catch(Exception $ex){
            return response()->json(["stauts" => "error", "message"=>$ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */


    public function routine_create(Request $request)
    {
        try{
            $request->validate([
                'student_class_id' => 'required|exists:student_classes,id',
                'subject_id' => 'required|exists:subjects,id',
                'sub_subject_id' => 'required|exists:sub_subjects,id',
                'day_id' => 'required|exists:days,id',
                'date' => 'required|date',
                'starting_time' => 'required|date_format:H:i',
                'ending_time' => 'required|date_format:H:i|after:starting_time',
            ]);

            $exists = Routine::where('student_class_id', $request->student_class_id)
            ->where('subject_id', $request->subject_id)
            ->where('sub_subject_id', $request->sub_subject_id)
            ->where('day_id', $request->day_id)
            ->where('starting_time', $request->starting_time)
            ->where('ending_time', $request->ending_time)
            ->exists();

            if($exists){
                return response()->json(["status" => "exists", "message" => "Routine already exists. Upload new data."]);
            }

            Routine::create([
                'student_class_id' => $request->student_class_id,
                'subject_id' => $request->subject_id,
                'sub_subject_id' => $request->sub_subject_id,
                'day_id' => $request->day_id,
                'date' => $request->date,
                'starting_time' => $request->starting_time,
                'ending_time' => $request->ending_time,
            ]);
            return response()->json(['status' => 'success', 'message' => 'Routine created successfully']);
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }

    


    /**
     * Remove the specified class routine view 
     */
  
    public function class_routine_view($id){
        try{
            return $id;
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message' => 'Something went wrong: ' . $ex->getMessage()]);
        }
    }
    



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Routine $routine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Routine $routine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Routine $routine)
    {
        //
    }
}
