<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;use Auth;
use App\Models\TimeZone;use App\Models\Mentor;
use App\Models\User;use Hash;
use App\Models\Conversation;use App\Models\Message;
use App\Models\AvailableDay;use App\Models\MentorSlotBooked;
use App\Models\AvailableShift;use DB;use App\Models\ZoomMeeting;
use App\Models\MentorExperienceLog;
use App\Models\Review;
use App\Models\Notification;

class MentorController extends Controller
{
    public function inviteFriends(Request $req)
    {
        return view('invite-friends');
    }

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
          if($guard == 'mentor'){
            $user->charge_per_hour = ($req->price_per_hour) ? $req->price_per_hour : 40;
            $user->about = ($req->about) ? $req->about : '';
            $user->carrier_started = ($req->carrier_started) ? $req->carrier_started : date('Y-m-d');
            $user->designation = ($req->designation) ? $req->designation : '';
        }
        $user->save();
        return back()->with('Success','Profile Updated SuccessFully');
    }
}

public function yourExperience(Request $req)
{
    $mentor = Auth::guard('mentor')->user();
    return view('mentor.settingExperience',compact('mentor'));
}

public function yourExperienceSave(Request $req)
{
    $req->validate([
        'start' => ['required','array'],
        'start.*' => ['required','date'],
        'end' => ['required','array'],
        'end.*' => ['required','date'],
        'type' => ['required','array'],
        'type.*' => ['required','in:1,2'],
        'name' => ['required','array'],
        'name.*' => ['required','string','max:255'],
    ]);
    $insertData = [];
    if(get_guard() == 'mentor'){
        $mentor = Auth::guard('mentor')->user();
        MentorExperienceLog::where('mentorId',$mentor->id)->delete();
        foreach($req->start as $key => $data){
            $insertData[] = [
                'mentorId' => $mentor->id,
                'start' => date('Y-m-d',strtotime($req->start[$key])),
                'end' => date('Y-m-d',strtotime($req->end[$key])),
                'type' => $req->type[$key],
                'name' => $req->name[$key],
            ];
        }
        if(count($insertData) > 0){
            MentorExperienceLog::insert($insertData);
            return back()->with('Success','Data Saved Success');
        }
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
        $guard = get_guard();$user = Auth::guard($guard)->user();
        $request = new Request([
            'senderId'   => $user->id,
            'senderGuard'   => $guard,
            'receiverId'   => $req->mentorId,
            'receiverGuard'   => 'mentor',
            'message'   => $req->message,
        ]);
        return $this->sendMessageUniversal($request);
    }
    return response()->json(['error'=>true,'message'=>'Something went wrong please try after some time']);
}

public function sendMessageUniversal(Request $req)
{
    $rules = [
        'conversationId' => 'nullable|numeric|min:1',
        'senderId' => 'required|min:1|numeric',
        'senderGuard' => 'required|string|in:web,mentor',
        'receiverId' => 'required|min:1|numeric',
        'receiverGuard' => 'required|string|in:web,mentor',
        'message' => 'required|string|max:255',
    ];
    $validator = validator()->make($req->all(),$rules);
    if(!$validator->fails()){
        $conversation = Conversation::where('message_from',$req->senderId)->where('message_from_guard',$req->senderGuard)->where('message_to',$req->receiverId)->where('message_to_guard',$req->receiverGuard)->first();
        if(!$conversation){
            $conversation = Conversation::where('message_to',$req->senderId)->where('message_to_guard',$req->senderGuard)->where('message_from',$req->receiverId)->where('message_from_guard',$req->receiverGuard)->first();
            if(!$conversation){
                $conversation = new Conversation();
                $conversation->message_from = $req->senderId;
                $conversation->message_from_guard = $req->senderGuard;
                $conversation->message_to = $req->receiverId;
                $conversation->message_to_guard = $req->receiverGuard;
                $conversation->save();
            }
        }
        $message = new Message();
        $message->message = $req->message;
        $message->conversation_id = $conversation->id;
        $message->from_id = $req->senderId;
        $message->from_guard = $req->senderGuard;
        $message->save();
        return response()->json(['error'=>false,'message'=>'message Submitted Successfully','data'=>$message]);
    }
    return response()->json(['error'=>true,'message' => $validator->errors()->first()]);
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
        $timeShift = AvailableShift::where('mentorId',$mentor->id)->where('date','>=',date('Y-m-d'))->orderBy('date','ASC')->get();
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
            return back()->with('Success','Data Saved Success');
        }
    }
}

public function messageLog(Request $req)
{
    $guard = get_guard();
    $user = Auth::guard($guard)->user();
    $data = Conversation::where(function ($query) use (&$user,&$guard) {
        $query->where('message_from', $user->id)->where('message_from_guard',$guard);
    })->orWhere(function($query) use (&$user,&$guard) {
        $query->where('message_to', $user->id)->where('message_to_guard',$guard);
    })->get();
    foreach ($data as $key => $msg) {
        if($msg->message_from == $user->id && $msg->message_from_guard == $guard){
            if($msg->message_to_guard == 'web'){
                $msg->opponent = User::where('id',$msg->message_to)->first();
                $msg->oppenentguard = 'web';
            }elseif($msg->message_to_guard == 'mentor'){
                $msg->opponent = Mentor::where('id',$msg->message_to)->first();
                $msg->oppenentguard = 'mentor';
            }else{
                $msg->opponent = (object)[];
                $msg->oppenentguard = '';
            }
        }elseif($msg->message_to == $user->id && $msg->message_to_guard == $guard){
            if($msg->message_from_guard == 'web'){
                $msg->opponent= User::where('id',$msg->message_from)->first();
                $msg->oppenentguard = 'web';
            }elseif($msg->message_from_guard == 'mentor'){
                $msg->opponent = Mentor::where('id',$msg->message_from)->first();
                $msg->oppenentguard = 'mentor';
            }else{
                $msg->opponent = (object)[];
                $msg->oppenentguard = '';
            }
        }
    }
        // dd($data);
    return view('mentee/messageLogs',compact('data','guard'));
}

public function getMessagesById(Request $req)
{
    $data = Message::where('conversation_id', $req->conversation_id)->get();
    foreach ($data as $key => $value) {
        $value->time = $value->created_at->diffForHumans();
        if($value->from_guard == 'web'){
            $value->userDetails = User::where('id',$value->from_id)->first();
            $value->userGuard = 'web';
        }elseif($value->from_guard == 'mentor'){
            $value->userDetails = Mentor::where('id',$value->from_id)->first();
            $value->userGuard = 'mentor';
        }else{
            $value->userDetails = (object)[];
            $value->userGuard = '';
        }
    }
    return response()->json(['error' => false, 'message' => 'Chats Data', 'data' => $data]);
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
            if($guard == 'web'){$userType='web';}elseif($guard == 'mentor'){$userType='mentor';}
            $slot->available = 3;
            $slot->save();
            return response()->json(['error'=>false,'msg'=>'Your Booking Has Been On Hold','redirectURL'=>route('slot.booking.stripe').'?slotId='.base64_encode($slot->id).'&userType='.base64_encode($guard).'&mentorId='.base64_encode($req->mentorId)]);
        }
        return response()->json(['error'=>true,'msg'=>'This slot is not available']);
    }
}




public function bookRescheduleClass(Request $req)
{
    DB::beginTransaction();
    try{
       $guard = get_guard();
       $oldSlotBooked = MentorSlotBooked::findOrFail($req->existingSlotId);
       $oldSlotBooked->bookingStatus = 3;
       $oldSlotBooked->save();
       $newBookingSlot = $oldSlotBooked->replicate();
       $newBookingSlot->bookingStatus = 1;
       $newBookingSlot->rescheduleStatus = 1;
       $newBookingSlot->availableShiftId = $req->slotId;
       $newBookingSlot->ReschduleAgainstClassid = $oldSlotBooked->id;
       $newBookingSlot->created_at = date('Y-m-d H:i:s');
       $newBookingSlot->updated_at = date('Y-m-d H:i:s');
       $newBookingSlot->save();
        $oldShiftDetails = AvailableShift::find($oldSlotBooked->availableShiftId);
        $newshiftDetails = AvailableShift::find($req->slotId);
        $userid =   $oldSlotBooked->bookedUserId;
        if($oldSlotBooked->userType=='mentor')
        {
            $userDetails = Mentor::find($userid);
        }elseif($oldSlotBooked->userType=='web')
        {
            $userDetails = User::find($userid);
        }
        $data = array(
            'userId' => $oldSlotBooked->bookedUserId,
            'userType' => $oldSlotBooked->userType,
            'mentorId' =>  $oldSlotBooked->mentorId,
            'msg' => 'R',
            'reschduleslot' =>  $req->slotId,
            'existingSlotid' =>  $oldSlotBooked->availableShiftId,
            'isread' =>0
        );
        DB::table('notifications')->insert($data);
        $dataMentee = [
            'name' => $userDetails->name,
            'todayDate' => date('M-d-y'),
            'content' => 'Your booking for the mentorly session of dated '.date('M d,Y',strtotime($oldShiftDetails->date)).' at '.date('H:i:s',strtotime($oldShiftDetails->time_shift)).' has been reschdules to '.date('M d,Y',strtotime($newshiftDetails->date)). ' at '.date('H:i:s',strtotime($newshiftDetails->time_shift)),
        ];
        sendMail($dataMentee,'email/reschduleBooking',$userDetails->email,'Your class booking has been Rescheduled !!');
        $this->deleteZoomMeeting($oldSlotBooked->id);
        $zoomMeeting = $this->crateZoomMeeting($newshiftDetails,$userDetails,$newBookingSlot);
        DB::commit();
        return response()->json(['error'=>false,'msg'=>'Your Booking Has Been On Hold','redirectURL'=>route('mentor.booking.request')]);

    

    

    // zoom meet create //
    // $slot = AvailableShift::where('id',$newshiftId)->first();
    // $user = Auth::guard($req->userType)->user();
    // $slotBooked = new MentorSlotBooked();
    // $slotBooked->mentorId = $slot->mentorId;
    // $zoomMeeting = $this->crateZoomMeeting($slot,$user,$slotBooked,$newshiftId);

    // DB::delete('zoom_meetings')->where('mentorId', $oldSlotBooked->mentorId)->where('slotid',$oldshiftid)->delete();
    // zoom meeting end //
     

   // Db::table('zoom_meetings')->where('mentorId',$oldSlotBooked->mentorId)->orderBy('id','asc')->delete();
   // $zoomMeeting = $this->crateZoomMeeting($slot,$user,$slotBooked);

       
      
   }catch(Exception $e){
    DB::rollback();
    return response()->json(['error'=> true,'message'=>'Something went wrong please try after some time']);
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
        $mentor = Mentor::where('id',$slot->mentorId)->first();
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
                // notification tbl insert //
        $data = array(
            'userId' => $user->id,
            'userType' => $req->userType,
            'mentorId' => $slot->mentorId,
            'msg' => ' on '.date('M d,Y',strtotime($slot->date)).' at '.date('H:i:s',strtotime($slot->time_shift)).'.',
            'isread' => 0
        );
        DB::table('notifications')->insert($data);
        $newRequest = new Request([
            'senderId' => $user->id,
            'senderGuard' => $req->userType,
            'receiverId' => $mentor->id,
            'receiverGuard' => 'mentor',
            'message' => 'I have sent you the booking request against '.date('M d,Y',strtotime($slot->date)).' at '.date('H:i:s',strtotime($slot->time_shift)),
        ]);
        $this->sendMessageUniversal($newRequest);
        $requestedSlotid = $req->slotId;
        $zoomMeeting = $this->crateZoomMeeting($slot,$user,$slotBooked,$requestedSlotid);

        $dataMentee = [
            'name' => $user->name,
            'content' => 'Your mentorly session has been booked with "Mr.'.$mentor->name.'" on '.date('M d,Y',strtotime($slot->date)).' at '.date('H:i:s',strtotime($slot->time_shift)).'.',
        ];
        sendMail($dataMentee,'email/menteeBooking',$user->email,'Session Booked successfully !!!');

        $dataMentor = [
            'name' => $mentor->name,
            'content' => 'Your Have been booked for a mentorly session by '.$user->name.'.',
            'content2' => 'The session is scheduled on '.date('M d,Y',strtotime($slot->date)).' at '.date('H:i:s',strtotime($slot->time_shift)).'.',
        ];
        sendMail($dataMentor,'email/mentorBooking',$mentor->email,'New Session Booked - confirmed');
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

public function deleteZoomMeeting($bookedslotId)
    {
        $zoom = ZoomMeeting::where('mentorSlotBookedId',$bookedslotId)->first();
        $meeting_id = $zoom->meetingId;
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
        $response = $client->request("DELETE", "/v2/meetings/$meeting_id", [
            "headers" => [
                "Authorization" => "Bearer " . $this->generateToken(),
            ]
        ]);
        if (204 == $response->getStatusCode()) {
            $zoom->delete();
        }
    }

public function crateZoomMeeting($slot,$user,$slotBooked,$requestedSlotid=0)
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
        $newMeeting->mentorSlotBookedId = $slotBooked->id;
        $newMeeting->save();
    }
    return $newMeeting;
}

public function seeBookingDetails(Request $req)
{
    $guard = get_guard();
    if($guard == 'mentor'){
        $mentor = Auth::guard($guard)->user();
        $booking = MentorSlotBooked::where('mentorId',$mentor->id)->where('bookingStatus','!=','3')->orderBy('id','desc')->get();
        foreach ($booking as $userType) {
            $user = [];
            if($userType->userType == 'web'){
                $user = User::where('id',$userType->bookedUserId)->first();
            }elseif($userType->userType == 'mentor'){
                $user = Mentor::where('id',$userType->bookedUserId)->first();
            }
            $userType->userDetails = $user;
        }
        return view('mentor.bookingConfirmedMentee',compact('mentor','booking'));
    }
}



public function approveBookingrequest(Request $req,$id)
{
    $bookingStatus = 1;
    $data = array(
        'bookingStatus' => 1
    );
    $slotdetails = MentorSlotBooked::find($id);
    $userid =  $slotdetails->bookedUserId; 
    $availableShiftId =  $slotdetails->availableShiftId; 
    $shiftDetails = AvailableShift::find($availableShiftId);
    $userDetails = User::find($userid);

    DB::table('mentor_slot_bookeds')->where('id',$id)->update($data); 
    $dataMentee = [
                'name' => $userDetails->name,
                'todayDate' => date('M-d-y'),
                'content' => 'Your booking for the mentorly session dated '.date('M d,Y',strtotime($shiftDetails->date)).' at '.date('H:i:s',strtotime($shiftDetails->time_shift)).' has been approved.',
            ];
    sendMail($dataMentee,'email/approveBooking',$userDetails->email,'Your class booking has been Approved !!');

    return redirect(route('mentor.booking.request'));

}


public function rejectBookingrequest(Request $req,$id)
{
    $bookingStatus = 1;
    $data = array(
        'bookingStatus' => 2
    );
    $slotdetails = MentorSlotBooked::find($id);
    $userid =  $slotdetails->bookedUserId; 
    $availableShiftId =  $slotdetails->availableShiftId; 
    $shiftDetails = AvailableShift::find($availableShiftId);
    $userDetails = User::find($userid);

    DB::table('mentor_slot_bookeds')->where('id',$id)->update($data);   
    $dataMentee = [
                'name' => $userDetails->name,
                'todayDate' => date('M-d-y'),
                'content' => 'Your booking for the mentorly session dated '.date('M d,Y',strtotime($shiftDetails->date)).' at '.date('H:i:s',strtotime($shiftDetails->time_shift)).' has been Rejected.',
            ];
    sendMail($dataMentee,'email/rejectedBooking',$userDetails->email,'Your class booking has been Rejected !!');
    return redirect(route('mentor.booking.request'));
}



public function getIndivisualSlots($mentor)
{
    $shifting = [];
    $time = ['Morning'=>['06:00','11:59'],'Afternoon' =>['12:00','17:59'],'Evening'=>['18:00','23:59'],'Night'=>['00:00','05:59']];
    $originalDate = date('Y-m-d');
    foreach($time as $key => $t){
        $weeklyShift = [];
        for ($loop=0; $loop < 7; $loop++) {
            $date = date('Y-m-d',strtotime($originalDate.'+'.$loop.' days'));
            $day = date('D',strtotime($originalDate.'+'.$loop.' days'));
            $getData = AvailableShift::where('mentorId',$mentor->id)->where('date',$date)->whereBetween('time_shift',$t)->get();
            $weeklyShift[] = [
                'day' => $day,
                'date' => $date,
                'short_day' => $day,
                'available' => count($getData),
                'data' => $getData,
            ];
        }
        $shifting[]=[
            'mentorId' => $mentor->id,
            'shift' => $t[0].'-'.$t[1],
            'shift_name' => $key,
            'days' => $weeklyShift,
        ];
    }
    return $shifting;
}

public function reviewpost(Request $req)
{
    $req->validate([
        'review' => 'required|string',
        'rating' => 'required|numeric|min:1|max:5',
        'mentor_id' => 'required|numeric|min:1',
    ]);
    $guard = get_guard();
    if($guard != '' && $guard != 'admin'){
        $user = Auth::guard($guard)->user();
        $review = new Review();
        $review->review = $req->review;
        $review->rating = $req->rating;
        $review->user_type = $guard;
        $review->user_id = $user->id;
        $review->mentor_id = $req->mentor_id;
        $review->status = 1;
        $review->save();
        $mentor = Mentor::find($req->mentor_id);
        $msg = $user->name." has post a ".$review->rating. " star rating for you .";

        $notification = new Notification();
        $notification->userId = $user->id;
        $notification->userType = $guard;
        $notification->mentorId = $mentor->id;
        $notification->msg = "N";
        $notification->reviewmsg = $msg;
        $notification->save();

        $dataMentee = [
            'name' => $mentor->name,
            'content' => $msg,
        ];
        sendMail($dataMentee,'email/reviewemail',$mentor->email,'You got an review');
        return redirect()->back()->with('Success','Review Submitted Success');
    }
    return redirect()->back()->with('Error','Please Login to Continue');
    
}



public function rescheduleBookingrequest(Request $req,$id,$mentorId)
{
    $date = date('Y-m-d');
    if(!empty($req->date) && (date('Y-m-d',strtotime($req->date)) > $date)){
        $date = date('Y-m-d',strtotime($req->date));
    }
    $originalDate = date('Y-m-d',strtotime($date));$originalDay = date('D',strtotime($date));
    $mentorId = base64_decode($mentorId);
    $mentor = Mentor::where('id',$mentorId)->with('reviews')->whereStatus(1)->where('is_verified',1)->whereIsDeleted(0)->first();
    if($mentor){
        $days = AvailableDay::get();
        $mentor->timeShift = $this->getIndivisualSlots($mentor);
        $daysData = [];$timezone = TimeZone::get();
        for($i = 0; $i < 7;$i++){
            $date = date('Y-m-d',strtotime($originalDate.'+'.$i.' days'));
            $day = date('D',strtotime($originalDay.'+'.$i.' days'));
            $getSlots = AvailableShift::where('mentorId',$mentor->id)->whereIn('available',[1,2])->where('date',$date)->get();
            $daysData[] = [
                'date' => $date,
                'day' => $day,
                'short_date' => date('d',strtotime($date)),
                'available' => $getSlots,
            ];
        }
        return view('mentor.reschduleclass',compact('mentor','daysData','days','originalDate','date','timezone'));
    }
    return 'Invalid Request <a href="/">Go back</a>';
}





























}
