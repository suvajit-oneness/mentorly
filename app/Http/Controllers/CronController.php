<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mentor;use App\Models\AvailableShift;

class CronController extends Controller
{
    public function teacherSlot($value='')
    {
    	$todayDate = date('Y-m-d');
    	$timeSlot = ['09:00','11:00','13:00','15:00','17:00','19:00','21:00'];
    	$mentor = Mentor::where('status',1)->where('is_verified',1)->where('is_deleted',0)->get();
    	foreach($mentor as $key => $ment){
    		for($loop = 0; $loop < 29; $loop++){
    			$nowDate = date('Y-m-d',strtotime($todayDate.'+'.$loop.' days'));
    			foreach($timeSlot as $index => $slot){
    				$slotCheck = AvailableShift::where('mentorId',$ment->id)->where('date',$nowDate)->where('time_shift',$slot)->first();
    				if(!$slotCheck){
    					$newSlot = new AvailableShift();
    					$newSlot->mentorId = $ment->id;
    					$newSlot->date = $nowDate;
    					$newSlot->time_shift = $slot;
    					$newSlot->available = 1;
    					$newSlot->save();
    				}
    			}
    		}
    	}
    	return response()->json(['error'=>false,'message'=>'Teacher Slot Creating Function Trigger Complete']);
    }
}
