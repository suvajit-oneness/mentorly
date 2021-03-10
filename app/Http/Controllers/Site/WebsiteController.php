<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;use App\Models\TimeZone;
use App\Models\User;use Hash;use App\Models\Review;
use App\Models\Mentor;use Auth;use App\Models\ContactUs;
use App\Models\Seniority;use App\Models\AvailableDay;
use App\Models\AvailableShift;

class WebsiteController extends Controller
{
    public function index(Request $req)
    {
    	return view('welcome');
    }

    public function showLoginFormForMentor(Request $req)
    {
        if(Auth::user()){
            return redirect('/');
        }
    	return view('website.mentorLogin');
    }

    public function showLoginFormForMentee(Request $req)
    {
        if(Auth::user()){
            return redirect('/');
        }
        return view('website.menteeLogin');
    }

    public function postLogin(Request $req)
    {
        $req->validate([
            'loginType' => 'required|in:mentee,mentor',
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);
        if($req->loginType == 'mentor'){
            $user = Mentor::where('email',$req->email)->first();
        }elseif($req->loginType == 'mentee'){
            $user = User::where('email',$req->email)->first();
        }
        if($user){
            if(Hash::check($req->password,$user->password)){
                if($req->loginType == 'mentor'){
                    Auth::guard('mentor')->login($user);
                }else{
                    Auth::login($user);
                }
                return redirect('/');
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
        $mentors = Mentor::orderBy('name')->with('reviews');
        if(!empty($req->seniority) &&  $req->seniority > 0){
            $mentors = $mentors->whereSeniorityId($req->seniority);
        }
        if(!empty($req->keyword)){
            $mentors = $mentors->where('mentors.name','like','%'.$req->keyword.'%');
        }
        $mentors = $mentors->whereStatus(1)->whereIsDeleted(0)->get();
        $days = AvailableDay::get();
        foreach ($mentors as $mentor) {
            $mentor->timeShift = $this->getShowTimeShift($mentor,$days);
        }
        $seniority = Seniority::whereStatus(1)->get();
        $request = $req->all();
    	return view('website.findMentors',compact('mentors','seniority','request','days'));
    }

    public function getShowTimeShift($mentor,$days)
    {
        $shifting = [];
        $time = ['Morning'=>['06:00','12:00'],'Afternoon' =>['12:00','18:00'],'Evening'=>['18:00','00:00'],'Night'=>['00:00','06:00']];
        foreach($time as $key => $t){
            $weeklyShift = [];
            foreach ($days as $day) {
                $getData = AvailableShift::where('mentorId',$mentor->id)->where('available_days_id',$day->id)->whereBetween('time_shift',$t)->where('available',1)->get();
                $weeklyShift[] = [
                    'day' => $day->day,
                    'short_day' => $day->short_day,
                    'available' => count($getData),
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

    public function mentorDetails(Request $req,$mentorId)
    {
        $mentor = Mentor::findorFail($mentorId);
        $mentor->review = Review::where('mentor_id',$mentor->id)->where('is_deleted',0)->with('user')->get();
        $timezone = TimeZone::get();
        return view('mentor.details',compact('mentor','timezone'));
    }

    public function aboutUs(Request $req)
    {
    	return view('website.aboutUs');
    }

    public function contactUs(Request $req)
    {
        $contact = ContactUs::whereType(0)->first();
    	return view('website.contactUs',compact('contact'));
    }

    public function showForgetPassword($userType)
    {
        return view('website.forget_password',compact('userType'));
    }

    public function postForgetPassword(Request $req,$userType)
    {
        $req->validate([
            'email' => 'required|email|string',
        ]);
        if($userType == 'mentor'){
            $user = Mentor::where('email',$req->email)->first();
        }
        elseif($userType == 'mentee'){
            $user = User::where('email',$req->email)->first();
        }
        if($user){
            // sendMail($user->name,$user->email,'email/forgot_password');
            $error['success'] = 'reset password mail has been sent';
            return back()->withInput($req->all())->withErrors($error);            
        }
        $error['email'] = 'the email provided is not registered with us';
        return back()->withInput($req->all())->withErrors($error);
    }

    public function logout(Request $req)
    {
    	$auth = $this->get_guard();
        Auth::guard($auth)->logout();
    	return redirect('/');
    }
}
