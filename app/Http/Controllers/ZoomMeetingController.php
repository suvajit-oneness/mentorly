<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;use Auth;
use Illuminate\Http\Request;use App\Models\ZoomMeeting;
use App\Models\User;use App\Models\Mentor;use App\Models\Admin;

class ZoomMeetingController extends Controller
{
	public function list(Request $req)
	{
		$data = ZoomMeeting::select('*')->with('mentor');
		$guard = get_guard();
		$user = Auth::guard($guard)->user();
		switch ($guard) {
			case 'admin':break;
			case 'web':
				$data = $data->where('menteeId',$user->id);
				break;
			case 'mentor':
				$data = $data->where('mentorId',$user->id);
				break;
		}
		$data = $data->where('over',0)->orderBy('id','DESC')->paginate(10);
		foreach($data as $newData){
			if($newData->userType == 'web'){
				$newData->mentee = User::where('id',$newData->menteeId)->first();
			}elseif($newData->userType == 'mentor'){
				$newData->mentee = Mentor::where('id',$newData->menteeId)->first();
			}elseif($newData->userType == 'admin'){
				$newData->mentee = Admin::where('id',$newData->menteeId)->first();
			}else{
				$newData->mentee = new User;
			}
		}
		if($guard == 'admin'){
			$mentor = Mentor::where('is_verified',1)->where('status',1)->orderBy('name')->get();
			$mentee = User::where('is_verified',1)->where('status',1)->orderBy('name')->get();
			return view('zoom.meetings',compact('data','guard','mentor','mentee'));
		}elseif($guard == 'web'){
			return view('zoom.zoomMentorMentee',compact('data'));
		}elseif($guard == 'mentor'){
			return view('zoom.zoomMentorMentee',compact('data'));
		}
	}

	public function create(Request $req)
	{
		$req->validate([
			'topic' => 'required|string',
			'start_time' => 'required|date',
			'agenda' => 'string|nullable',
			'mentor' => 'required|min:1|numeric',
			'mentee' => 'required|min:1|numeric',
		]);
		$client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
		$response = $client->request('POST', '/v2/users/me/meetings', [
	        "headers" => [
	            "Authorization" => "Bearer " . $this->generateToken(),
	        ],
	        'json' => [
	            "topic" => $req->topic,
	            "type" => 2,
	            "start_time" => $req->start_time,
	            "duration" => "30", // 30 mins
	            "password" => "123456",
	            "agenda" => $req->agenda,
	        ],
	    ]);
	    $data = json_decode($response->getBody());
	    if($data){
	    	$newMeeting = new ZoomMeeting;
	    	$newMeeting->mentorId = $req->mentor;
            $newMeeting->menteeId = $req->mentee;
            $newMeeting->userType = 'web';
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
            return redirect(route('admin.zoom.meeting'))->with('Status','Meeting Create Success');
	    }
	    $error['topic'] = 'Something went wrong please try after some time';
	    return back()->withInput($req->all())->withErrors($error);
	}

	public function cancelMeeting(Request $req,$zoomMeetingId)
	{
		try {
			$zoom = ZoomMeeting::findOrFail($zoomMeetingId);
			$client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
			$response = $client->request("DELETE", "/v2/meetings/$zoom->meetingId", [
		        "headers" => [
		            "Authorization" => "Bearer " . $this->generateToken(),
		        ]
		    ]);
		    if (204 == $response->getStatusCode()) {
		    	$zoom->delete();
		    	return back()->with('Status','Meeting Cancelled Success');
		    }
		} catch (Exception $e) {
			return back()->with('Status','Something went wrong please try after some time');
		}
	}

	public function deleteZoomMeeting(Request $req,$meeting_id)
	{
		$client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
		$response = $client->request("DELETE", "/v2/meetings/$meeting_id", [
	        "headers" => [
	            "Authorization" => "Bearer " . $this->generateToken(),
	        ]
	    ]);

	    if (204 == $response->getStatusCode()) {
	    	ZoomMeeting::where('meetingId',$meeting_id)->delete();
        	return redirect(route('admin.zoom.meeting'))->with('Status','Meeting Deleted Success');
    	}
	}
}
