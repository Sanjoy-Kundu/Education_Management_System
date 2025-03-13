<?php

namespace App\Http\Controllers;

use App\Mail\AccountCreation;
use Exception;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function teacher_lists_page()
    {
        try{
            return view('pages.auth.teacherPage');
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */

    public function teacher_create(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already taken',
        ]);
        try{
         
                $randomPassword = Str::random(8);
                User::create([
                    'user_id' => Auth::id(),
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($randomPassword),
                    'role' => 'teacher',
                ]);

                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $randomPassword,
                    'role' => 'teacher',
                ];

                Mail::to($request->email)->send(new AccountCreation($randomPassword, $data));


                return response()->json(['status' => 'success', 'message' => 'Teacher created successfully']);
         
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
