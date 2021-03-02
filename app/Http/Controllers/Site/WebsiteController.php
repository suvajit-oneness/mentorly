<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;use Hash;
use App\Models\Mentor;use Auth;

class WebsiteController extends Controller
{
    public function index(Request $req)
    {
    	return view('welcome');
    }

    public function showLoginForm(Request $req)
    {
        if(Auth::user()){
            return redirect('/');
        }
    	return view('website.login');
    }

    public function postLogin(Request $req)
    {
    	$req->validate([
            'email' => 'required|email|string',
    		'password' => 'required|string',
        ]);
        $mentor = Mentor::where('email',$req->email)->first();
        if($mentor){
            if(Hash::check($req->password,$mentor->password)){
                auth()->login($mentor);
                return back();
            }else{
                $errors['password'] = 'you have entered wrong password';
            }
        }else{
            $errors['email'] = 'This Email is not registered with us';
        }
        return back()->withErrors($errors)->withInput($req->all());
    }

    public function signupFormMentee(Request $req)
    {
    	return view('website.singUpMentee');
    }

    public function signupFormMentor(Request $req)
    {
    	return view('website.singUpMentor');
    }

    public function signUpMentorAndMentee(Request $req)
    {
    	$req->validate([
    		'registration_type' => 'required|in:mentor,mentee',
    	]);
    	if($req->registration_type == 'mentor'){
    		$req->validate([
    			'email' => 'required|email|string|unique:mentors',
				'password' => 'required|confirmed|string',
    		]);
    		$mentor = new Mentor();
    		$mentor->email = $req->email;
    		$mentor->password = Hash::make($req->password);
    		$mentor->save();
    		$errors['signup'] = 'Registration Successfull';
    		return back()->withErrors($errors);
    	}
    	elseif($req->registration_type == 'mentee'){
    		$req->validate([
    			'first_name' => 'required|string',
				'last_name' => 'required|string',
				'email' => 'required|email|string|unique:users',
				'password' => 'required|confirmed|string',
    		]);
    		$mentee = new User();
    		$mentee->name = $req->first_name.' '.$req->last_name;
    		$mentee->email = $req->email;
    		$mentee->password = Hash::make($req->password);
    		$mentee->save();
    		$errors['signup'] = 'Registration Successfull';
    		return back()->withErrors($errors);
    	}
    }

    public function findMentors(Request $req)
    {
        $mentors = Mentor::get();
    	return view('website.findMentors',compact('mentors'));
    }

    public function aboutUs(Request $req)
    {
    	return view('website.aboutUs');
    }

    public function contactUs(Request $req)
    {
    	return view('website.contactUs');
    }

    public function logout(Request $req)
    {
    	Auth::logout();
    	return redirect('/login');
    }
}
