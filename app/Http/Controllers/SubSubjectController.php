<?php

namespace App\Http\Controllers;

use App\Models\SubSubject;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubSubjectController extends Controller
{
    // sub subject 
    public function sub_subject_create(Request $request)
    {
        try{

            $request->validate([
                'sub_subject_code' => 'required|max:255',
                'full_marks' => 'required|max:255',
            ]);

        
            $checkUnique = SubSubject::where('subject_id',$request->subject_id)->where('student_class_id',$request->student_class_id)->where('sub_subject_name',$request->sub_subject_name)->where('sub_subject_code',$request->sub_subject_code)->where('full_marks',$request->full_marks)->first();

            if($checkUnique){
                return response()->json(['status' => 'errors', 'message' => 'Sub Subject Already Exists']);
            }
            
            SubSubject::create([
                "user_id"=> Auth::id(),
                "subject_id" => $request->subject_id,
                "student_class_id" => $request->student_class_id,
                "sub_subject_name"=> Str::upper($request->sub_subject_name),
                "sub_subject_code" =>$request->sub_subject_code,
                "full_marks"=> $request->full_marks
            ]);

            return response()->json(['status' => 'success', 'message' => 'Sub Subject Added Successfully']);
        } catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message' => $ex->getMessage()]);
        }
    }


    public function sub_subject_view_lists(Request $request)
    {
        try{
            $sub_subjects = SubSubject::where('subject_id',$request->subject_id)->with('subject')->get();
            return response()->json(['status' => 'success', 'sub_subjects_lists' => $sub_subjects]);
        } catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message' => $ex->getMessage()]);
        }
    }



}
