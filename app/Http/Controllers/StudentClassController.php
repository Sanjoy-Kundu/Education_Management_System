<?php

namespace App\Http\Controllers;

use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
   public function student_class(Request $request){
    try{
        return view('pages.auth.classPage');
    }catch(Exception $ex){
        return response()->json(['status' => 'errors', 'message'=> $ex->getMessage()]);
    }
   }
}
