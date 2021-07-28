<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MentorSlotBooked;
use Auth;

class MenteeController extends Controller
{
    public function purchasHistory(Request $req)
    {
    	$guard = get_guard();
    	if($guard == '' || $guard == 'admin'){}
    	else{
    		$user = Auth::guard($guard)->user();
    		if($guard == 'web'){$userType = 'mentee';}
    		elseif($guard == 'mentor'){$userType = 'mentor';}
    		$purchase = MentorSlotBooked::where('bookedUserId',$user->id)->where('userType',$userType);
	    	$purchase = $purchase->with('slot_details')->with('mentor')->orderBy('id','Desc')->get();
	    	return view('mentee.purchaseHistory',compact('purchase'));
    	}
    }


    public function myLesson(Request $req)
    {
        $guard = get_guard();
        if($guard == '' || $guard == 'admin'){}
        else{
            $user = Auth::guard($guard)->user();
            if($guard == 'web'){$userType = 'mentee';}
            elseif($guard == 'mentor'){$userType = 'mentor';}
            $recentlesson = MentorSlotBooked::where('bookedUserId',$user->id)->where('userType',$userType);
            $recentlesson = $recentlesson->with('slot_details')->with('mentor')->orderBy('id','asc')->limit('1')->get();
            $nextlesson = MentorSlotBooked::where('bookedUserId',$user->id)->where('userType',$userType);
            $nextlesson = $nextlesson->with('slot_details')->with('mentor')->orderBy('id','desc')->limit('1')->get();
            return view('mentee.myLesson',compact('recentlesson','nextlesson'));
        }
    }


    
}
