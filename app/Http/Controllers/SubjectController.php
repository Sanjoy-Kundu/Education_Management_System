<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\SubSubject;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function subject_lists(Request $request){
        try{
            return view('pages.auth.sujectListsPage');
        }catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message'=> $ex->getMessage()]);
        }
       }


    public function subject_create(Request $request)
    {
        try{
        
            $request->validate([
                'student_class_id' => 'required',
                'name' => 'required|max:255',
            ]);
    
            $checkUnique = Subject::where('student_class_id', $request->input('student_class_id'))->where('name',$request->input('name'))->first();
            if($checkUnique){
                return response()->json(['status' => 'errors', 'message' => 'Subject Code Already Exists']);
            }else{
                Subject::create([
                    'user_id' => Auth::id(),
                    'name' => Str::upper($request->input('name')),
                    'student_class_id' => $request->input('student_class_id'),
                ]);
                return response()->json(['status' => 'success', 'message' => 'Subject Added Successfully']);
            }
        }
        catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message'=>$ex->getMessage()]);
        }
    }


    public function all_subject_lists(Request $request){
        try{
            $subjectLists = Subject::with('studentClass')->get();
            return response()->json(['status' => 'success', 'subjectLists' => $subjectLists]);
        }catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message'=> $ex->getMessage()]);
        }
    }

    
    public function subject_delete_by_id(Request $request)
    {
        try{
            $subject = Subject::find($request->id);
            if (!$subject) {
                return response()->json(['status' => 'error', 'message' => 'Subject not found'], 404);
            }
            $subject->delete();
            return response()->json(['status' => 'success', 'message' => 'Subject deleted successfully']);
        }catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message'=> $ex->getMessage()]);
        }
    }


    public function subject_detail_by_id(Request $request)
    {
        try{
            $sbuject_id = $request->id;
            $subject = Subject::where('id', $sbuject_id)->with('studentClass')->first();
            if ($subject) {
                return response()->json(['status' => 'success', 'subject' => $subject]);
            }else{
                return response()->json(['status' => 'fail', 'message' => 'invalid data']);
            }
            
        }catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message'=> $ex->getMessage()]);
        }
    }


    public function subject_update_by_id(Request $request)
    {
        try{
            $request->validate([
                'student_class_id' => 'required',
                'name' => 'required|max:255',
            ]);

            $data_check = Subject::where('student_class_id', $request->input('student_class_id'))->where('name',$request->input('name'))->first();
            if($data_check){
                return response()->json(['status' => 'errors', 'message' => 'Input Field Already Exists']);
            }
    
            $subject = Subject::find($request->id);
            if (!$subject) {
                return response()->json(['status' => 'error', 'message' => 'Subject not found'], 404);
            }
            $subject->update([
                'user_id' => Auth::id(),
                'name' => Str::upper($request->input('name')),
                'student_class_id' => $request->input('student_class_id'),
            ]);
            return response()->json(['status' => 'success', 'message' => 'Subject Updated Successfully']);
        }catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message'=> $ex->getMessage()]);
        }
    }


    public function subject_lists_by_class_id(Request $request)
    {
        try{
            $student_class_id = $request->student_class_id;
            $subjectLists = Subject::where('student_class_id', $student_class_id)->get();
            return response()->json(['status' => 'success', 'subjectLists' => $subjectLists]);
        }catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message'=> $ex->getMessage()]);
        }
    }
    
}
