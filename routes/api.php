<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Get list of meetings.
Route::get('/meetings', 'ZoomMeetingController@list');

// Create meeting room using topic, agenda, start_time.
Route::post('/meetings', 'ZoomMeetingController@create');

// Get information of the meeting room by ID.
Route::get('/meetings/{id}', 'ZoomMeetingController@get')->where('id', '[0-9]+');
Route::patch('/meetings/{id}', 'ZoomMeetingController@update')->where('id', '[0-9]+');
Route::delete('/meetings/{id}', 'ZoomMeetingController@delete')->where('id', '[0-9]+');
