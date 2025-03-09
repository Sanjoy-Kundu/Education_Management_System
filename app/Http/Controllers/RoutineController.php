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

         // Check for overlapping time slots
        $overlappingRoutine = Routine::where('student_class_id', $request->student_class_id)
        ->where('day_id', $request->day_id)
        ->where(function ($query) use ($request) {
                $query->whereBetween('starting_time', [$request->starting_time, $request->ending_time])
                     ->orWhereBetween('ending_time', [$request->starting_time, $request->ending_time])
                     ->orWhere(function ($query) use ($request) {
                         $query->where('starting_time', '<', $request->starting_time)
                               ->where('ending_time', '>', $request->ending_time);
                  });
         })->first();

         if($overlappingRoutine){
            return response()->json(["status" => "exists", "message" => "A class already exists in this time range. Please change the time."]);
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
     * Routine lists by class id
     */
    public function routine_lists_by_class(Request $request)
    {
        try{
            $class_id = $request->student_class_id;
            $existsRoutine = Routine::where('student_class_id', $class_id)->with(['className', 'subjectName', 'subjectPaper', 'day'])->get();
            return response()->json(['status' => 'success', 'routines' => $existsRoutine]);
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message' => 'Something went wrong: ' . $ex->getMessage()]);
        }
    }



    //routine delete by-id 
    public function routine_delete_by_id(Request $request){
        $request->validate([
            'id' => 'required|integer|exists:routines,id'
        ]);
        try{

            $routine = Routine::find($request->id);
            if(!$routine){
                return response()->json(['status' => 'error', 'message' => 'Routine not found']);
            }
            $routine->delete();
            return response()->json(['status' => 'success', 'message' => 'Routine deleted successfully']);
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message' => 'Something went wrong: ' . $ex->getMessage()]);
        }
    }






    /**
     * Show the form for editing the specified resource.
     */
    public function routine_detail_by_id(Request $request)
    {
        try{
            $id = $request->id;
            $routineExists = Routine::find($id);
            if(!$routineExists){
                return response()->json(['status' => 'error', 'message' => 'Routine not found']);
            }
            return response()->json(['status' => 'success', 'data' => $routineExists]);

          //show the view code ...

        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message' => 'Something went wrong: ' . $ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function routine_update(Request $request)
    {
        try {
            // Find the routine by ID
            $routine = Routine::findOrFail($request->id);
    
           
            $routineExists = Routine::where('student_class_id', $request->student_class_id)
                ->where('id', '=', $routine->id) 
                ->where('subject_id', $request->subject_id)
                ->where('sub_subject_id', $request->sub_subject_id)
                ->where('day_id', $request->day_id)
                ->where('date', $request->date)
                ->where('starting_time', $request->starting_time)
                ->where('ending_time', $request->ending_time) 
                ->exists();
    
            if ($routineExists) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Routine already exists'
                ], 409); // 409 Conflict status code
            }
    
            // Update the routine with the new data
            $routine->update([
                'subject_id' => $request->subject_id,
                'sub_subject_id' => $request->sub_subject_id,
                'day_id' => $request->day_id,
                'date' => $request->date,
                'starting_time' => $request->starting_time,
                'ending_time' => $request->ending_time,
            ]);
    
            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Routine updated successfully'
            ], 200);
    
        } catch (\Exception $ex) {
            // Handle exceptions
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ], 500);
        }
    }
    
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Routine $routine)
    {
        //
    }








}
