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
    // public function routine_create(Request $request)
    // {
    //     $request->validate([
    //         'student_class_id' => 'required|exists:student_classes,id',
    //         'routines' => 'required|array',
    //         'routines.*.subject_id' => 'required|exists:subjects,id',
    //         'routines.*.sub_subject_id' => [
    //             'nullable',
    //             function ($attribute, $value, $fail) {
    //                 if (!empty($value) && $value != 0 && !SubSubject::where('id', $value)->exists()) {
    //                     $fail('Invalid sub_subject_id');
    //                 }
    //             }
    //         ],
    //         'routines.*.day' => 'required|string',
    //         'routines.*.starting_time' => 'required|date_format:H:i',
    //         'routines.*.ending_time' => [
    //             'required',
    //             'date_format:H:i',
    //             function ($attribute, $value, $fail) use ($request) {
    //                 $index = explode('.', $attribute)[1]; // Get array index
    //                 $startingTime = $request->routines[$index]['starting_time'] ?? null;
    
    //                 if ($startingTime && strtotime($value) <= strtotime($startingTime)) {
    //                     $fail('The ending time must be after the starting time.');
    //                 }
    //             },
    //         ],
    //     ]);
    
    //     try {
    //         foreach ($request->routines as $routineData) {
    //             Routine::create([
    //                 'student_class_id' => $request->student_class_id,
    //                 'subject_id' => $routineData['subject_id'],
    //                 'sub_subject_id' => $routineData['sub_subject_id'] == 0 ? null : $routineData['sub_subject_id'],
    //                 'day' => $routineData['day'],
    //                 'starting_time' => $routineData['starting_time'],
    //                 'ending_time' => $routineData['ending_time'],
    //             ]);
    //         }
    
    //         return response()->json(['status' => 'success', 'message' => 'Routine created successfully!']);
    //     } catch (Exception $e) {
    //         Log::error('Routine Create Error: ' . $e->getMessage());
    //         return response()->json(['status' => 'error', 'message' => 'Something went wrong!'], 500);
    //     }
    // }


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
        ]);
    
        try {
            foreach ($validateData['routines'] as $routineData) {
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
