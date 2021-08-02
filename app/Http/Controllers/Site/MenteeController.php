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
                if($guard == 'web'){$userType = 'mentee';}
                elseif($guard == 'mentor'){$userType = 'mentor';}

                if($userType=="mentor")
                {

                    $recentlesson = DB::table('mentor_slot_bookeds')->select('*','mentor_slot_bookeds.id as slotbookid','mentor_slot_bookeds.created_at as classbooked')
                    ->join('stripe_transactions','mentor_slot_bookeds.stripeTransactionId','=','stripe_transactions.id')
                    ->join('available_shifts','mentor_slot_bookeds.availableShiftId','=','available_shifts.id')
                    ->join('users','mentor_slot_bookeds.mentorId','=','users.id')
                    ->where('mentor_slot_bookeds.mentorId',$user->id)->where('bookingStatus','!=','3')->limit('20')->get();


                    $today = date('Y-m-d');
                    $nextlesson = DB::table('mentor_slot_bookeds')
                    ->select('*','mentor_slot_bookeds.id as slotbookid','mentor_slot_bookeds.created_at as classbooked')
                    ->join('stripe_transactions','mentor_slot_bookeds.stripeTransactionId','=','stripe_transactions.id')
                    ->join('available_shifts','mentor_slot_bookeds.availableShiftId','=','available_shifts.id')
                    ->join('users','mentor_slot_bookeds.mentorId','=','users.id')
                    ->where('available_shifts.date','>',$today)
                    ->where('mentor_slot_bookeds.mentorId',$user->id)->where('bookingStatus','!=','3')->orderBy('slotbookid','desc')
                    ->limit('5')->get();

                    return view('mentor.myLesson',compact('recentlesson','nextlesson'));

                }elseif($userType=="mentee"){

                    $recentlesson = DB::table('mentor_slot_bookeds')->select('*','mentor_slot_bookeds.id as slotbookid',
                        'mentor_slot_bookeds.created_at as classbooked')
                    ->join('stripe_transactions','mentor_slot_bookeds.stripeTransactionId','=','stripe_transactions.id')
                    ->join('available_shifts','mentor_slot_bookeds.availableShiftId','=','available_shifts.id')
                    ->join('users','mentor_slot_bookeds.mentorId','=','users.id')
                    ->where('bookedUserId',$user->id)->where('bookingStatus','!=','3')->limit('20')->get();


                    $today = date('Y-m-d');
                    $nextlesson = DB::table('mentor_slot_bookeds')
                    ->select('*','mentor_slot_bookeds.id as slotbookid','mentor_slot_bookeds.created_at as classbooked')
                    ->join('stripe_transactions','mentor_slot_bookeds.stripeTransactionId','=','stripe_transactions.id')
                    ->join('available_shifts','mentor_slot_bookeds.availableShiftId','=','available_shifts.id')
                    ->join('users','mentor_slot_bookeds.mentorId','=','users.id')
                    ->where('available_shifts.date','>',$today)
                    ->where('bookedUserId',$user->id)->where('bookingStatus','!=','3')->orderBy('slotbookid','desc')->limit('5')->get();
                    return view('mentee.menteemyLesson',compact('recentlesson','nextlesson'));

                }


            }
        }



    }
