<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class AdminController extends Controller
{
    public function contactUs(Request $req)
    {
    	$contact = ContactUs::where('type',0)->first();
    	return view('admin.contactUs',compact('contact'));
    }

    public function storeContactUs(Request $req)
    {
    	$req->validate([
    		'contactUsId' => 'required|min:1|numeric',
    		'title' => 'required|max:200|string',
	    	'mobile' => 'required',
	    	'email' => 'required',
	    	'address' => 'required',
	    	'twitterLink' => '',
	    	'instagramLink' => '',
	    	'facebookLink' => '',
	    	'linkedinLink' => '',	
    	]);
		$contact = ContactUs::where('id',$req->contactUsId)->where('type',0)->first();
		$contact->title = $req->title;
		$contact->mobile = $req->mobile;
		$contact->email = $req->email;
		$contact->address = $req->address;
		$contact->twitterLink = emptyCheck($req->twitterLink);
		$contact->instagramLink = emptyCheck($req->instagramLink);
		$contact->facebookLink = emptyCheck($req->facebookLink);
		$contact->linkedinLink = emptyCheck($req->linkedinLink);
		$contact->save();
		$error['success'] = 'Updated Success';
		return back()->withErrors($error);
    }
}
