<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;use Auth;
use App\Models\TimeZone;use App\Models\Mentor;
use App\Models\User;use Hash;use App\Models\MessageToMentor;
use App\Models\AvailableDay;use App\Models\MentorSlotBooked;
use App\Models\AvailableShift;use DB;use App\Models\ZoomMeeting;
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
            $message->userId = $user->id;
            if(get_guard() == 'web'){
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
            $mentor = Auth::guard('mentor')->user();
            $timeShift = AvailableShift::where('mentorId',$mentor->id)->orderBy('date','DESC')->get();
            return view('mentor.ShiftAvailable',compact('timeShift'));
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
            'available' => ['required','array'],
            'available.*' => ['required','in:0,1,2,3'],
        ]);
        $insertData = [];
        if(get_guard() == 'mentor'){
            $mentor = Auth::guard('mentor')->user();
            AvailableShift::where('mentorId',$mentor->id)->where('available','!=',2)->delete();
            foreach($req->date as $key => $data){
                $insertData[] = [
                    'mentorId' => $mentor->id,
                    'date' => $req->date[$key],
                    'time_shift' => $req->time[$key],
                    'available' => $req->available[$key],
                ];
            }
            if(count($insertData) > 0){
                AvailableShift::insert($insertData);
                return back()->with('success','Data Saved Success');
            }
        }
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
                $user = Auth::guard($req->userType)->user();
                $slotBooked = new MentorSlotBooked();
                $slotBooked->mentorId = $slot->mentorId;
                $slotBooked->stripeTransactionId = $req->transactionId;
                $slotBooked->availableShiftId = $slot->id;
                $slotBooked->userType = $req->userType;
                $slotBooked->bookedUserId = $user->id;
                $slotBooked->save();
                $slot->available = 2;
                $slot->save();
                $zoomMeeting = $this->crateZoomMeeting($slot,$user,$slotBooked);
            DB::commit();
            return redirect(route('mentor.booked.success').'?transactionId='.$req->transactionId);
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

    public function crateZoomMeeting($slot,$user,$slotBooked)
    {
        $mentor = Mentor::where('id',$slotBooked->mentorId)->first();
        $topic = 'Meeting with '.$mentor->name.' at '.$slot->date. ' '.$slot->time_shift;
        $startTime = date('Y-m-d',strtotime($slot->date)).' '.date('h:i:s',strtotime($slot->time_shift));

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
        $response = $client->request('POST', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer " . $this->generateToken(),
            ],
            'json' => [
                "topic" => $topic,
                "type" => 2,
                "start_time" => $startTime,
                "duration" => "30", // 30 mins
                "password" => "123456",
                "agenda" => 'Scheduled Class',
            ],
        ]);
        $data = json_decode($response->getBody());
        $newMeeting = new ZoomMeeting;
        if($data){
            $newMeeting->mentorId = $mentor->id;
            $newMeeting->menteeId = $user->id;
            $newMeeting->userType = $slotBooked->userType;
            $newMeeting->uuid = $data->uuid;
            $newMeeting->meetingId = $data->id;
            $newMeeting->host_id = $data->host_id;
            $newMeeting->host_email = $data->host_email;
            $newMeeting->topic = $data->topic;
            $newMeeting->start_time = $data->start_time;
            $newMeeting->agenda = !empty($data->agenda) ? $data->agenda : '';
            $newMeeting->join_url = $data->join_url;
            $newMeeting->password = !empty($data->password) ? $data->password : '';
            $newMeeting->encrypted_password = !empty($data->encrypted_password) ? $data->encrypted_password : '';
            $newMeeting->status = $data->status;
            $newMeeting->type = $data->type;
            $newMeeting->start_url = !empty($data->start_url) ? $data->start_url : '';
            $newMeeting->save();
        }
        return $newMeeting;
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
