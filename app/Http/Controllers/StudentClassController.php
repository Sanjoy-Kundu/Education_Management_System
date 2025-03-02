<?php

namespace App\Http\Controllers;

use Exception;
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







   public function student_class_detail_by_id(Request $request){
    try{
        $class_id = $request->id;
        $user_id = Auth::id();

        $classData = StudentClass::where('id',$class_id)->where("user_id",$user_id)->first();
        if($classData){
            return response()->json(['status' => 'success', 'classData' => $classData]);
        }else{
            return response()->json(['status' => 'fail', 'message' => 'invalid data']);
        }
    }catch(Exception $ex){
        return response()->json(['status' => 'errors', 'message'=>$ex->getMessage()]);
    }


   }






   public function student_class_update_by_id(Request $request){
    try{
        $id = $request->id;
        $user_id = Auth::id();
        $name = $request->name;
        $section = $request->section;
        $capacity = $request->capacity;

        $dataCheck = StudentClass::where('id',$id)->where('user_id',$user_id)->first();
        if($dataCheck){
            $dataCheck->name = Str::upper($request->name);
            $dataCheck->section = Str::upper($request->section);
            $dataCheck->capacity = $request->capacity;
            $dataCheck->save();
            return response()->json(["status" => "success", "message" => "Class Updated Successfully"]);
        }else{
            return response()->json(["status" => "fail", "message" => "Invalid Data"]);
        }
    }catch(Exception $ex){
        return response()->json(['status' => 'errors', 'message' => $ex->getMessage()]);
    }
   }
}
