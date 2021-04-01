<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
// use App\Traits\ZoomMeetingTrait;
use Illuminate\Http\Request;

class ZoomMeetingController extends Controller
{
	public function generateToken()
	{
		$key = env('ZOOM_API_KEY', '');
        $secret = env('ZOOM_API_SECRET', '');
        $payload = [
            'iss' => $key,
            'exp' => strtotime('+1 minute'),
        ];
        return \Firebase\JWT\JWT::encode($payload, $secret, 'HS256');
	}

	public function list(Request $req)
	{
		$client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
		$response = $client->request('GET', '/v2/users/me/meetings', [
		    "headers" => [
		        "Authorization" => "Bearer ". $this->generateToken(),
		    ]
		]);
		$data = json_decode($response->getBody());
		return view('zoom.meetings',compact('data'));
	}

	public function create(Request $req)
	{
		$req->validate([
			'topic' => 'required|string',
			'start_time' => 'required|date',
			'agenda' => 'string|nullable',
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
	    return redirect(route('admin.zoom.meeting'))->with('Status','Meeting Create Success');
	}

	// public function participants(Request $req,$meetingId)
	// {
	// 	$client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
	// 	$response = $client->request('GET', '/v2/past_meetings/'.$meetingId.'/participants', [
	// 	    "headers" => [
	// 	        "Authorization" => "Bearer ". $this->generateToken(),
	// 	    ]
	// 	]);
	// 	$data = json_decode($response->getBody());
	// 	dd($data);
	// }

	public function deleteZoomMeeting(Request $req,$meeting_id)
	{
		$client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
		$response = $client->request("DELETE", "/v2/meetings/$meeting_id", [
	        "headers" => [
	            "Authorization" => "Bearer " . $this->generateToken(),
	        ]
	    ]);

	    if (204 == $response->getStatusCode()) {
        	return redirect(route('admin.zoom.meeting'))->with('Status','Meeting Deleted Success');
    	}
	}

	// use ZoomMeetingTrait;

	// const MEETING_TYPE_INSTANT = 1;
	// const MEETING_TYPE_SCHEDULE = 2;
	// const MEETING_TYPE_RECURRING = 3;
	// const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;


	// public function show($id)
 //    {
 //        $meeting = $this->get($id);
 //        return view('meetings.index', compact('meeting'));
 //    }

 //    public function store(Request $request)
 //    {
 //        $this->create($request->all());
 //        return redirect()->route('meetings.index');
 //    }

 //    public function update($meeting, Request $request)
 //    {
 //        $this->update($meeting->zoom_meeting_id, $request->all());
 //        return redirect()->route('meetings.index');
 //    }

 //    public function destroy(ZoomMeeting $meeting)
 //    {
 //        $this->delete($meeting->id);
 //        return $this->sendSuccess('Meeting deleted successfully.');
 //    }

 //    public function list(Request $request)
 //    {
 //    	$path = 'users/me/meetings';
	//     $response = $this->get($path);
	//     $data = json_decode($response->body(), true);
	//     $data['meetings'] = array_map(function (&$m) {
	//         $m['start_at'] = $this->toUnixTimeStamp($m['start_time'], $m['timezone']);
	//         return $m;
	//     }, $data['meetings']);
	//     return [
	//         'success' => $response->ok(),
	//         'data' => $data,
	//     ];
	// }

 //    public function create(Request $request)
 //    {
 //    	$validator = Validator::make($request->all(), [
	//         'topic' => 'required|string',
	//         'start_time' => 'required|date',
	//         'agenda' => 'string|nullable',
	//     ]);
	//     if ($validator->fails()) {
	//         return [
	//             'success' => false,
	//             'data' => $validator->errors(),
	//         ];
	//     }
	//     $data = $validator->validated();
	//     $path = 'users/me/meetings';
	//     $response = $this->zoomPost($path, [
	//         'topic' => $data['topic'],
	//         'type' => self::MEETING_TYPE_SCHEDULE,
	//         'start_time' => $this->toZoomTimeFormat($data['start_time']),
	//         'duration' => 30,
	//         'agenda' => $data['agenda'],
	//         'settings' => [
	//             'host_video' => false,
	//             'participant_video' => false,
	//             'waiting_room' => true,
	//         ]
	//     ]);
	//     return [
	//         'success' => $response->status() === 201,
	//         'data' => json_decode($response->body(), true),
	//     ];
 //    }

 //    public function get(Request $request, string $id)
 //    {
 //    	$path = 'meetings/' . $id;
	//     $response = $this->zoomGet($path);

	//     $data = json_decode($response->body(), true);
	//     if ($response->ok()) {
	//         $data['start_at'] = $this->toUnixTimeStamp($data['start_time'], $data['timezone']);
	//     }
	    
	//     return [
	//         'success' => $response->ok(),
	//         'data' => $data,
	//     ];
 //    }

 //    public function update(Request $request, string $id)
 //    {
 //    	$validator = Validator::make($request->all(), [
	//         'topic' => 'required|string',
	//         'start_time' => 'required|date',
	//         'agenda' => 'string|nullable',
	//     ]);

	//     if ($validator->fails()) {
	//         return [
	//             'success' => false,
	//             'data' => $validator->errors(),
	//         ];
	//     }
	//     $data = $validator->validated();

	//     $path = 'meetings/' . $id;
	//     $response = $this->zoomPatch($path, [
	//         'topic' => $data['topic'],
	//         'type' => self::MEETING_TYPE_SCHEDULE,
	//         'start_time' => (new \DateTime($data['start_time']))->format('Y-m-d\TH:i:s'),
	//         'duration' => 30,
	//         'agenda' => $data['agenda'],
	//         'settings' => [
	//             'host_video' => false,
	//             'participant_video' => false,
	//             'waiting_room' => true,
	//         ]
	//     ]);

	//     return [
	//         'success' => $response->status() === 204,
	//         'data' => json_decode($response->body(), true),
	//     ];
 //    }

 //    public function delete(Request $request, string $id)
 //    {
 //    	$path = 'meetings/' . $id;
	//     $response = $this->zoomDelete($path);

	//     return [
	//         'success' => $response->status() === 204,
	//         'data' => json_decode($response->body(), true),
	//     ];
 //    }
}
