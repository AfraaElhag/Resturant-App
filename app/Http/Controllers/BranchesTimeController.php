<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\branchesTime;


class BranchesTimeController extends Controller
{
    //
    public function updateTime(Request $request){
    	$request->all();

    	$time=branchesTime::get()->first();
    	$time->opening_from=$request->opening_from;
    	$time->opening_to=$request->opening_to;
    	$time-> update();

return redirect()->back()->with('message', 'تم تعديل الزمن بنجاح');
    	
    }
}
