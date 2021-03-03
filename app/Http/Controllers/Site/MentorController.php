<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;use Auth;
use App\Models\TimeZone;

class MentorController extends Controller
{
    public function setting(Request $req)
    {
    	$guard = get_guard();
    	if($guard != ''){
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
}
