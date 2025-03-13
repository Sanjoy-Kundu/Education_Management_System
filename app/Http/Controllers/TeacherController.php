<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\AccountCreation;
use Illuminate\Support\Facades\DB;
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
         ], [
             'name.required' => 'Name is required',
             'email.required' => 'Email is required',
             'email.unique' => 'Email is already taken',
         ]);
     
         try {
             DB::beginTransaction(); // Transaction Start
     
             $randomPassword = Str::random(8);
     
             // Step 1: User Insert
             $user = User::create([
                 'user_id' => Auth::id(),
                 'name' => $request->name,
                 'email' => $request->email,
                 'password' => Hash::make($randomPassword),
                 'role' => 'teacher',
             ]);
     
             //  Step 2: Teacher Insert (Linked with `user_id`)
             Teacher::create([
                 'user_id' => $user->id, // ✅ Newly created user's ID
                 'phone' => $request->phone ?? null,
                 'gender' => $request->gender ?? 'other',
                 'dob' => $request->dob ?? null,
                 'address' => $request->address ?? null,
                 'qualification' => $request->qualification ?? null,
                 'institution' => $request->institution ?? null,
                 'duration' => $request->duration ?? null,
                 'year_of_graduation' => $request->year_of_graduation ?? null,
                 'result' => $request->result ?? null,
                 'experience' => $request->experience ?? null,
                 'subject' => $request->subject ?? null,
                 'joining_date' => $request->joining_date ?? now(),
                 'salary' => $request->salary ?? null,
                 'status' => 'active',
                 'profile_picture' => $request->profile_picture ?? null,
                 'cv' => $request->cv ?? null,
                 'id_card' => $request->id_card ?? null,
                 'passport' => $request->passport ?? null,
                 'bank_account' => $request->bank_account ?? null,
                 'tin' => $request->tin ?? null,
                 'nid' => $request->nid ?? null,
                 'driving_license' => $request->driving_license ?? null,
                 'description' => $request->description ?? null,
             ]);
     
             // Step 3: Send Email
             $data = [
                 'name' => $request->name,
                 'email' => $request->email,
                 'password' => $randomPassword,
                 'role' => 'teacher',
             ];
             Mail::to($request->email)->send(new AccountCreation($randomPassword, $data));
     
             DB::commit(); 
     
             return response()->json(['status' => 'success', 'message' => 'Teacher created successfully']);
         } catch (Exception $ex) {
             DB::rollBack(); 
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
