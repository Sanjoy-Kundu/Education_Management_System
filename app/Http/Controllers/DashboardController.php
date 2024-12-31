<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard(Request $request){
        try{
            return view('pages.auth.dashboardPage');
        }catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message'=>$ex->getMessage()]);
        }
    }
}
