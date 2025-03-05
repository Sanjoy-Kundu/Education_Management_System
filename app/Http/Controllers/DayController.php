<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Day;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function day_lists_page()
    {
        try{
            return view('pages.auth.dayPage');
        }catch(Exception $e){
            return response()->json(['status' => 'error','message' => $e->getMessage(), 500]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function day_lists()
    {
        try{
            $dayLists = Day::all();
            if(!$dayLists){
                return response()->json(['status' => 'fail', 'message' => "Data Error"]); 
            }
            return response()->json(['status' => 'success', 'dayLists' => $dayLists]);

        }catch(Exception $e){
            return response()->json(['status' => 'error','message' => $e->getMessage(), 500]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       try{
        $request->validate([
            'name' => 'required|max:255|unique:days,name',
        ]);


        Day::create([
            'user_id' => Auth::id(),
            'name' => Str::upper($request->input('name'))
        ]);
        return response()->json(['status' => 'success', 'message' => 'Day Added Successfully']);
       }catch(Exception $e){
            return response()->json(['status' => 'error','message' => $e->getMessage(), 500]);
        }
       }
    

    /**
     * Display the specified resource.
     */
    public function show(Day $day)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function day_details_by_id(Request $request)
    {
        $day_id = $request->id;
        $user_id = Auth::id();

        $dayData = Day::where('id',$day_id)->where("user_id",$user_id)->first();
        if($dayData){
            return response()->json(['status' => 'success', 'dayData' => $dayData]);
        }else{
            return response()->json(['status' => 'fail', 'message' => 'invalid data']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function day_update_by_id(Request $request)
    {
        try{
            $id = $request->id;
            $user_id = Auth::id();
            $name = $request->name;
      
    
            $dataCheck = Day::where('id',$id)->where('user_id',$user_id)->first();
            if($dataCheck){
                $dataCheck->name = Str::upper($request->name);
                $dataCheck->save();
                return response()->json(["status" => "success", "message" => "Day Updated Successfully"]);
            }else{
                return response()->json(["status" => "fail", "message" => "Invalid Data"]);
            }
        }catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message' => $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function day_delete(Request $request)
    {
        try{
            $day_id = $request->id;
            $user_id = Auth::id();
            $dayData = Day::where('id',$day_id)->where("user_id",$user_id)->first();
            if($dayData){
                $dayData->delete();
                return response()->json(['status' => 'success', 'message' => 'Day Deleted Successfully']);
            }else{
                return response()->json(['status' => 'fail', 'message' => 'invalid data']);
            }

        }catch(Exception $ex){
            return response()->json(['status' => 'errors', 'message'=>$ex->getMessage()]);
        }
    }
}
