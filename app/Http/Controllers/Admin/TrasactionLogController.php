<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StripeTransaction;
use App\Models\MentorSlotBooked;
use App\Models\Mentor;use App\Models\User;

class TrasactionLogController extends Controller
{
    public function index(Request $req)
    {
    	$data = StripeTransaction::with('slot')->get();
    	// $data = MentorSlotBooked::select('*')->with(['transaction_detail','mentor','slot_details'])
    	// 	->where('stripeTransactionId','!=',0)->get();
    	// foreach ($data as $key => $value) {
    	// 	if($value->userType == 'mentor'){
    	// 		$value->user_details = Mentor::where('id',$value->bookedUserId)->first();
    	// 	}elseif($value->userType == 'mentee'){
    	// 		$value->user_details = User::where('id',$value->bookedUserId)->first();
    	// 	}else{
    	// 		$value->user_details = [];
    	// 	}
    	// }
    	// dd($data);
    	return view('admin.transaction.index',compact('data'));
    }
}
