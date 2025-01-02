<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
                'code' => 'required|unique:subjects,code',
                'full_marks' => 'required|integer',
            ]);
    
    
            Subject::create([
                'user_id' => Auth::id(),
                'name' => Str::upper($request->input('name')),
                'code' => Str::upper($request->input('code')),
                'student_class_id' => $request->input('student_class_id'),
                'full_marks' => $request->input('full_marks')
            ]);
            return response()->json(['status' => 'success', 'message' => 'Subject Added Successfully']);
        }catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message'=>$ex->getMessage()]);
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
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
