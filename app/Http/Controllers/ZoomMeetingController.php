<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ZoomMeetingController extends Controller
{
	public function generateToken()
	{
		$key = env('ZOOM_API_KEY');
        $secret = env('ZOOM_API_SECRET');
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
}
