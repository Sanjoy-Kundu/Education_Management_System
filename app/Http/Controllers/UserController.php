<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function loginPage(Request $request){
        try{
            return view('pages.login.loginPage');
        }catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message'=>$ex->getMessage()]);
        }
    }


    public function userRegistration(Request $request){
        try{
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|min:8|confirmed',
            ]);

            User::create([
                'name'=> Str::upper($request->input('name')),
                'email' => Str::lower($request->input('email')),
                'password' => Hash::make($request->input('password'))
            ]);
            return response()->json(['status' => 'success', 'message'=>'User Registration Successfully']);
        }catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message'=>$ex->getMessage()]);
        }
    }



    public function userLogin(Request $request){
        try{
            $request->validate([
                'email' => 'required',
                'password' => 'required|min:8'
            ]);
            $login_password = $request->input('password');
            $login_email = $request->input('email');

            $user = User::where('email',$login_email)->first();

            if($user && Hash::check($login_password,$user->password)){
              $token = $user->createToken('authToken')->plainTextToken;
              return response()->json(['status' => 'success', 'message'=>'User Login Successfully', 'token'=>$token, 'role'=>$user->role]);
            }else{
               return response()->json(['status' => 'fail', 'message' => 'Invalid User']);
            }
        }catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message' => $ex->getMessage()]);
        }
    }

}
