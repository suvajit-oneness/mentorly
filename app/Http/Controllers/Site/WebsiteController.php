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
        $data = (object)[];
        $data->faq = \App\Models\Faq::where('forwhichpage','homepage')->get();
        $data->whereourmentor_work = \App\Models\FrontendSetting::where('key','where_our_mentor_work_at')->get();
        $data->whatwedo = \App\Models\FrontendSetting::where('key','what_we_do')->get();
        $data->focusonSkill = \App\Models\FrontendSetting::where('key','focus_ontheskill_you_need')->get();
        $data->story = \App\Models\FrontendSetting::where('key','our_sucess_story')->get();
        $data->howmentory_works = \App\Models\FrontendSetting::where('key','how_mentory_works')->get();
        $data->becomeMentor = \App\Models\FrontendSetting::where('key','become_mentor_home_page')->get();
        return view('welcome',compact('data'));
    }

    public function showLoginFormForMentor(Request $req)
    {
        $guard = get_guard();
        if($guard != ''){
            if($guard == 'admin'){
                return redirect('/admin');
            }
            return redirect('/');
        }
        return view('website.mentorLogin');
    }

    public function showLoginFormForMentee(Request $req)
    {
        $guard = get_guard();
        if($guard != ''){
            if($guard == 'admin'){
                return redirect('/admin');
            }
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
                $data = [
                    'name' => $user->name,
                    'content' => 'You have Successfully login to the Website',
                ];
                sendMail($data,'email/login',$user->email,'Login Success');
                if($req->loginType == 'mentor'){
                    Auth::guard('mentor')->login($user);
                    $mentor = Auth::guard('mentor')->user();
                    if($mentor->status == 1 && $mentor->is_verified == 1 && $mentor->is_deleted == 0){
                        return redirect(route('mentor.details',base64_encode($mentor->id)).'?date='.date('Y-m-d'));
                    }
                    return redirect(route('mentor.mentee.setting'));
                }else{
                    Auth::login($user);
                    return redirect(route('mentors.find'));
                    // return redirect('/');
                }
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
        $guard = get_guard();
        if($guard != ''){
            if($guard == 'admin'){
                return redirect('/admin');
            }
            return redirect('/');
        }
    	return view('website.singUpMentee');
    }

    public function signupFormMentor(Request $req)
    {
        $guard = get_guard();
        if($guard != ''){
            if($guard == 'admin'){
                return redirect('/admin');
            }
            return redirect('/');
        }
        $data = (object)[];
        $data->faq = \App\Models\Faq::where('forwhichpage','becomeonmentor')->get();
        $data->becomeMentor = \App\Models\FrontendSetting::where('key','become_mentor_page')->get();
        $data->mentor = Mentor::whereStatus(1)->where('is_verified',1)->whereIsDeleted(0)->limit(5)->get();
    	return view('website.singUpMentor',compact('data'));
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
            $mentor->status = 1;
            $mentor->charge_per_hour = 40;
            $mentor->carrier_started = date('Y-m-d');
    		$mentor->save();
            Auth::guard('mentor')->login($mentor);
            $data = [
                'name' => 'User',
                'content' => 'Please complete your profile to get started',
            ];
            sendMail($data,'email/mentorRegistration',$mentor->email,'Congratulation - Successful Registration !!!');
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
            Auth::guard('web')->login($mentee);
            $data = [
                'name' => 'User',
                'content' => 'Please complete your profile to get started',
            ];
            sendMail($data,'email/menteeRegistration',$mentee->email,'Congratulation - Successful Registration !!!');
    	}
        return redirect(route('mentor.mentee.setting'));
    }

    public function findMentors(Request $req)
    {
        $mentors = Mentor::with('reviews');
        if(!empty($req->seniority) &&  $req->seniority > 0){
            $mentors = $mentors->whereSeniorityId($req->seniority);
        }
        if(!empty($req->price)){
            $range = explode('-',removeDollerSign($req->price));
            $mentors = $mentors->whereBetween('mentors.charge_per_hour',$range);
        }
        if(!empty($req->keyword)){
            $mentors = $mentors->where('mentors.name','like','%'.$req->keyword.'%');
        }
        if(!empty($req->industry)){

        }
        if(!empty($req->timeoftheday)){
            $timeoftheday = $req->timeoftheday;
            $mentors = $mentors->leftjoin('available_shifts','mentors.id','=','available_shifts.mentorId')
                ->where(function ($query)use($timeoftheday){
                    $firstData = explode('-',$timeoftheday[0]);
                    $query->whereBetween('available_shifts.time_shift',$firstData)->where('available_shifts.date','>=',date('Y-m-d'));
                    foreach ($timeoftheday as $key => $time) {
                        if($key == 0){continue;}
                        $otherData = explode('-',$time);
                        $query->orWhereBetween('available_shifts.time_shift',$otherData)->where('available_shifts.date','>=',date('Y-m-d'));
                    }
                });
        }
        if(!empty($req->timeoftheweek)){

        }
        $mentors = $mentors->whereStatus(1)->whereIsDeleted(0)->whereIsVerified(1)->orderBy('mentors.name')->groupBy('mentors.id')->get();
        $days = AvailableDay::get();
        foreach ($mentors as $mentor) {
            $mentor->timeShift = $this->getIndivisualSlots($mentor);
        }
        $seniority = Seniority::whereStatus(1)->get();
        $request = $req->all();
        $industry = \App\Models\Industry::get();
    	return view('website.findMentors',compact('mentors','seniority','request','days','industry'));
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

    public function termsAndCondition(Request $req)
    {
        $data = (object)[];
        $data->terms_and_condition = \App\Models\FrontendSetting::where('key','terms_and_condition')->first();
        return view('website.termsandcondition',compact('data'));
    }

    public function policy(Request $req)
    {
        $data = (object)[];
        $data->policy = \App\Models\FrontendSetting::where('key','policy')->first();
        return view('website.policy',compact('data'));
    }

    public function mentorDetails(Request $req,$mentorId)
    {
        $date = date('Y-m-d');
        if(!empty($req->date)){
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
            return view('mentor.details',compact('mentor','daysData','days','originalDate','date','timezone'));
        }
        return 'Invalid Request <a href="/">Go back</a>';
    }

    public function aboutUs(Request $req)
    {
        $data = (object)[];
        $data->faq = \App\Models\Faq::get();
        $data->mentor = Mentor::whereStatus(1)->where('is_verified',1)->whereIsDeleted(0)->limit(4)->get();
        $data->news = \App\Models\News::limit(3)->orderBy('id','DESC')->get();
    	return view('website.aboutUs',compact('data'));
    }

    public function contactUs(Request $req)
    {
    	return view('website.contactUs');
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
            $data = [
                'name' => $user->name,
                'password_reset_link' => url('/'),
            ];
            sendMail($data,'email/forgot_password',$user->email,'Reset Password');
            $error['success'] = 'reset password mail has been sent';
            return back()->withInput($req->all())->withErrors($error);            
        }
        $error['email'] = 'the email provided is not registered with us';
        return back()->withInput($req->all())->withErrors($error);
    }

    public function logout(Request $req)
    {
    	$auth = get_guard();
        Auth::guard($auth)->logout();
    	return redirect('/');
    }
}
