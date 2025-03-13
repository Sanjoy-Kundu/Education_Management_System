<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function authCheck(){
        try{    
            $userDetails = Auth::user();
            return response()->json(['status' => 'success', 'users' => $userDetails]);
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message'=>$ex->getMessage()]);
        }
    }




    public function adminDashboard(Request $request){
        try{    
            return view('pages.auth.dashboardPage');
              
        }catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message'=>$ex->getMessage()]);
        }
    }
}
