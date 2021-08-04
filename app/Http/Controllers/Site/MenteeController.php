<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MentorSlotBooked;
use Auth;
use DB;
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
                $lession = MentorSlotBooked::select('*');
                $lession = $lession->where('bookedUserId',$user->id)->where('userType',$guard);
                $lession = $lession->where('bookingStatus','!=',3)->orderBy('id','desc')->get();
                return view('mentee.menteemyLesson',compact('lession'));
            }
        }



    }
