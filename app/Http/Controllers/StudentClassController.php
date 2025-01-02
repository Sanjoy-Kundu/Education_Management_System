<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentClassController extends Controller
{
   public function student_class(Request $request){
    try{
        return view('pages.auth.classPage');
    }catch(Exception $ex){
        return response()->json(['status' => 'errors', 'message'=> $ex->getMessage()]);
    }
   }



   public function student_class_post(Request $request){
    try{
        
        $request->validate([
            'name' => 'required|max:255|unique:student_classes,name',
            'section' => 'required',
            'capacity' => 'required|integer',
        ]);


        StudentClass::create([
            'user_id' => Auth::id(),
            'name' => Str::upper($request->input('name')),
            'section' => Str::upper($request->input('section')),
            'capacity' => $request->input('capacity')
        ]);
        return response()->json(['status' => 'success', 'message' => 'Class Added Successfully']);
    }catch(Exception $ex){
        return response()->json(['status' => 'errors', 'message'=>$ex->getMessage()]);
    }
   }


   public function student_class_lists(Request $request){
    try{
        $classLists = StudentClass::all();
        if(!$classLists){
            return response()->json(['status' => 'fail', 'message' => "Data Error"]); 
        }
        return response()->json(['status' => 'success', 'classLists' => $classLists]);
    }catch(Exception $ex){
        return response()->json(['status' => 'errors', 'message'=>$ex->getMessage()]);
    }
   }


   public function student_class_delete_by_id(Request $request){
        try{
            $class_delete_id = $request->id;
            $user_id = Auth::id();
            $classData = StudentClass::where('id',$class_delete_id)->where("user_id",$user_id)->first();
            if($classData){
                $classData->delete();
                return response()->json(['status' => 'success', 'message' => 'Class Deleted Successfully']);
            }else{
                return response()->json(['status' => 'fail', 'message' => 'invalid data']);
            }

        }catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message'=>$ex->getMessage()]);
        }
   }
}
