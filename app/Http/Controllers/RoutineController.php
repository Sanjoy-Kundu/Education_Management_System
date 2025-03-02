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
        $validateData = $request->validate([
            'student_class_id' => ['required', 'exists:student_classes,id'],
            'routines' => ['required', 'array'],
            'routines.*.subject_id' => ['required', 'exists:subjects,id'],
            'routines.*.sub_subject_id' => ['nullable', 'exists:sub_subjects,id'],
            'routines.*.day' => ['required', 'string'],
            'routines.*.date' => ['required', 'date'],
            'routines.*.starting_time' => ['required', 'date_format:H:i'],
            'routines.*.ending_time' => [
            'required',
            'date_format:H:i',
            function ($attribute, $value, $fail) use ($request) {
                $index = str_replace('routines.', '', explode('.', $attribute)[1]);
                $starting_time = $request->input("routines.$index.starting_time");
        
                if ($starting_time && $value <= $starting_time) {
                $fail('The ending time must be after the starting time.');
                }
            }
            ],
        ], [
            'student_class_id.required' => 'The student class id is required.',
            'student_class_id.exists' => 'The selected student class id is invalid.',
            'routines.required' => 'The routines field is required.',
            'routines.array' => 'The routines field must be an array.',
            'routines.*.subject_id.required' => 'The subject id is required.',
            'routines.*.subject_id.exists' => 'The selected subject id is invalid.',
            'routines.*.sub_subject_id.exists' => 'The selected sub subject id is invalid.',
            'routines.*.day.required' => 'The day is required',
            'routines.*.day.string' => 'The day must be a required.',
            'routines.*.date.required' => 'The date is required.',
            'routines.*.date.date' => 'The date must be a valid date.',
            'routines.*.starting_time.required' => 'The starting time is required.',
            'routines.*.starting_time.date_format' => 'The starting time must be in the format HH:MM.',
            'routines.*.ending_time.required' => 'The ending time is required.',
            'routines.*.ending_time.date_format' => 'The ending time must be in the format HH:MM.',
        ]);

        try {
            foreach ($validateData['routines'] as $routineData) {
                $existingRoutine = Routine::where('student_class_id', $validateData['student_class_id'])
                    ->where('subject_id', $routineData['subject_id'])
                    ->where('sub_subject_id', $routineData['sub_subject_id'] ?? null)
                    ->where('day', $routineData['day'])
                    ->where('date', $routineData['date'])
                    ->where('starting_time', $routineData['starting_time'])
                    ->where('ending_time', $routineData['ending_time'])
                    ->first();

                if ($existingRoutine) {
                    return response()->json(['status' => 'error', 'message' => 'Routine already exists for the given inputs.']);
                }

                Routine::create([
                    'student_class_id' => $validateData['student_class_id'],
                    'subject_id' => $routineData['subject_id'],
                    'sub_subject_id' => $routineData['sub_subject_id'] ?? null,
                    'day' => $routineData['day'],
                    'date' => $routineData['date'],
                    'starting_time' => $routineData['starting_time'],
                    'ending_time' => $routineData['ending_time'],
                ]);
            }
            return response()->json(['status' => 'success', 'message' => 'Routine created successfully!']);
        } catch (QueryException $ex) {
            return response()->json(['status' => 'error', 'message' => 'Database error: ' . $ex->getMessage()]);
        } catch (Exception $ex) {
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
