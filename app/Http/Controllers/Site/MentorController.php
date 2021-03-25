<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;use Auth;
use App\Models\TimeZone;use App\Models\Mentor;
use App\Models\User;use Hash;use App\Models\MessageToMentor;
use App\Models\AvailableDay;use App\Models\MentorSlotBooked;
use App\Models\AvailableShift;use DB;
class MentorController extends Controller
{
    public function setting(Request $req)
    {
    	$guard = get_guard();
    	if($guard != '' && $guard != 'admin'){
    		$user = Auth::guard($guard)->user();
    		$timezone = TimeZone::get();
    		return view('mentor.setting',compact('user','timezone'));
    	}
    }

    public function settingAccountUpdate(Request $req)
    {
    	$guard = get_guard();
    	if($guard != ''){
    		$user = Auth::guard($guard)->user();
    		$firstName = emptyCheck($req->first_name);
    		$lastName = emptyCheck($req->last_name);
    		$user->name = trim($firstName.' '.$lastName);
    		$user->mobile = emptyCheck($req->mobile);
    		$user->timezone_id = $req->timezone;
    		if($req->hasFile('image')){
	        	$random = uniqueString();
	            $image = $req->file('image');
	            $image->move('upload/userProfile/',$random.'.'.$image->getClientOriginalExtension());
	            $imageurl = url('upload/userProfile/'.$random.'.'.$image->getClientOriginalExtension());
	            $user->image = $imageurl;
	        }
    		$user->save();
    		return back()->with('Success','Profile Updated SuccessFully');
    	}
    }

    public function settingEmail(Request $req)
    {
        $guard = get_guard();
        if($guard != '' && $guard != 'admin'){
            $user = Auth::guard($guard)->user();
            return view('mentor.settingEmail',compact('guard','user'));
        }
    }

    public function settingEmailUpdate(Request $req)
    {
        $req->validate([
            'guardType' => 'required|in:web,mentor',
            'authId' => 'required|min:1|numeric',
        ]);
        if($req->guardType == 'mentor'){
            $req->validate([
                'email' => 'required|string|email|unique:mentors,email,'.$req->authId,
            ]);
        }elseif($req->guardType == 'web'){
            $req->validate([
                'email' => 'required|string|email|unique:users,email,'.$req->authId,
            ]);
        }
        $user = Auth::guard($req->guardType)->user();
        $user->email = $req->email;
        $user->save();
        return back()->with('Success','Email Updated SuccessFully');
    }

    public function settingPassword(Request $req)
    {
        $guard = get_guard();
        if($guard != '' && $guard != 'admin'){
            $user = Auth::guard($guard)->user();
            return view('mentor.settingPassword',compact('guard','user'));
        }
    }

    public function messageSubmitToMentor(Request $req)
    {
        $rules = [
            'message' => 'required|string|max:255',
            'mentorId' => 'required|min:1|numeric',
        ];
        $validator = validator()->make($req->all(),$rules);
        if(!$validator->fails()){
            $user = Auth::guard(get_guard())->user();
            $message = new MessageToMentor();
            $message->mentorId = $req->mentorId;
            if(get_guard() == 'web'){
                $message->userId = $user->id;
                $message->mentorOrMentee = 'mentee,'.$user->id;
            }else{
                $message->mentorOrMentee = 'mentor,'.$user->id;
            }
            $message->message = $req->message;
            $message->save();
            return response()->json(['error'=>false,'message'=>'message Submitted Successfully']);
        }
        return response()->json(['error'=>true,'message'=>'Something went wrong please try after some time']);
    }

    public function settingPasswordUpdate(Request $req,$userType)
    {
        $req->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:5|confirmed',
        ]);
        $user = Auth::guard($userType)->user();
        if(Hash::check($req->old_password,$user->password)){
            $user->password = Hash::make($req->password);
            $user->save();
            return back()->with('Success','Password Changed SuccessFully');    
        }
        $error['old_password'] = 'Password Mismatched';
        return back()->withErrors($error)->withInput($req->all());
    }

    public function mentorAvailabilitySettingView(Request $req)
    {
        if(get_guard() == 'mentor'){
            $days = AvailableDay::get();
            $mentor = Auth::guard('mentor')->user();
            $timeShift = AvailableShift::where('mentorId',$mentor->id)->groupBy('time_shift')->get();
            foreach($timeShift as $key => $data){
                $data->mainData = AvailableShift::with('day')->where('time_shift',$data->time_shift)->where('mentorId',$mentor->id)->groupBy('available_days_id')->get();
            }
            return view('mentor.ShiftAvailable',compact('days','timeShift'));
        }
        return back();
    }

    public function saveMentorAvailabilitySetting(Request $req)
    {
        $req->validate([
            'date' => ['required','array'],
            'date.*' => ['required','date'],
            'time' => ['required','array'],
            'time.*' => ['required'],
            'Monday' => ['required','array'],
            'Monday.*' => ['required','in:0,1'],
            'Tuesday' => ['required','array'],
            'Tuesday.*' => ['required','in:0,1'],
            'Wednesday' => ['required','array'],
            'Wednesday.*' => ['required','in:0,1'],
            'Thrusday' => ['required','array'],
            'Thrusday.*' => ['required','in:0,1'],
            'Friday' => ['required','array'],
            'Friday.*' => ['required','in:0,1'],
            'Saturday' => ['required','array'],
            'Saturday.*' => ['required','in:0,1'],
            'Sunday' => ['required','array'],
            'Sunday.*' => ['required','in:0,1'],
        ]);
        $data = [];
        if(get_guard() == 'mentor'){
            $mentor = Auth::guard('mentor')->user();
            $days = AvailableDay::get();
            AvailableShift::where('mentorId',$mentor->id)->delete();
            foreach ($days as $day) {
                $requestedDays = $day->day;
                foreach($req->$requestedDays as $key => $available){
                    $data[] = [
                        'available_days_id' => $day->id,
                        'mentorId' => $mentor->id,
                        'date' => $req->date[$key],
                        'time_shift' => $req->time[$key],
                        'available' => $available,
                    ];
                }   
            }
            if(count($data) > 0){
                AvailableShift::insert($data);
            }
        }
        return back()->with('success','Data Saved Success');
    }

    public function holdBookingRequest(Request $req)
    {
        $req->validate([
            'slotId' => 'required|numeric|min:1',
            'mentorId' => 'required|numeric|min:1',
        ]);
        $guard = get_guard();
        if($guard == '' || $guard == 'admin'){
            return response()->json(['error'=>true,'msg'=>'You have to perform login for booking']);
        }else{
            $slot = AvailableShift::where('id',$req->slotId)->where('mentorId',$req->mentorId)->where('available',1)->first();
            if($slot){
                if($guard == 'web'){$userType='mentee';}elseif($guard == 'mentor'){$userType='mentor';}
                $slot->available = 3;
                $slot->save();
                return response()->json(['error'=>false,'msg'=>'Your Booking Has Been On Hold','redirectURL'=>route('slot.booking.stripe').'?slotId='.base64_encode($slot->id).'&userType='.base64_encode($guard).'&mentorId='.base64_encode($req->mentorId)]);
            }
            return response()->json(['error'=>true,'msg'=>'This slot is not available']);
        }
    }

    public function stripeBookingConfirmed(Request $req)
    {
        $req->validate([
            'slotId' => 'required|numeric|min:1',
            'userType' => 'required|in:mentor,web',
            'transactionId' => 'required|min:1|numeric',
        ]);
        try{
            DB::beginTransaction();
                $slot = AvailableShift::where('id',$req->slotId)->first();
                $slotBooked = new MentorSlotBooked();
                $user = Auth::guard($req->userType)->user();
                $slotBooked->mentorId = $slot->mentorId;
                $slotBooked->stripeTransactionId = $req->transactionId;
                $slotBooked->availableShiftId = $slot->id;
                $slotBooked->userType = $req->userType;
                $slotBooked->bookedUserId = $user->id;
                $slotBooked->save();
                $slot->available = 2;
                $slot->save();
            DB::commit();
            return redirect(route('mentor.booked.success').'?transactionId='.$req->transactionId);
            // return redirect(route('mentor.details',base64_encode($slot->mentorId)))->with('Success','Booking Confirmed SuccessFully');
        }catch(Exception $e){
            DB::rollback();
            return response(['error'=>true,'message'=>'Something Went Wrong','data' => 
                [
                    'Note' => 'Please note the Transaction Id to claim',
                    'Transaction Id' => $req->transactionId,
                ],
            ]);
        }
    }

    public function seeBookingDetails(Request $req)
    {
        $guard = get_guard();
        if($guard == 'mentor'){
            $mentor = Auth::guard($guard)->user();
            $booking = MentorSlotBooked::where('mentorId',$mentor->id)->with('slot_details')->orderBy('id','desc')->get();
            foreach ($booking as $userType) {
                $user = [];
                if($userType->userType == 'mentee'){
                    $user = User::where('id',$userType->bookedUserId)->first();
                }elseif($userType->userType == 'mentor'){
                    $user = Mentor::where('id',$userType->bookedUserId)->first();
                }
                $userType->userDetails = $user;
            }
            return view('mentor.bookingConfirmedMentee',compact('mentor','booking'));
        }
    }
}
