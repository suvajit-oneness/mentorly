<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller,Auth,Hash;
use Socialite,App\Models\Mentor,App\Models\User;

class SocialiteController extends Controller
{
    public function socialiteLogin(Request $req,$userType,$socialite)
    {
        session()->put(['userType'=> $userType]);
        return Socialite::driver($socialite)->redirect();
    }

    public function socialiteLoginRedirect(Request $req,$socialite)
    {
        $userType = session()->get('userType');
        // session()->remove('userType');
        $socialiteUser = Socialite::driver($socialite)->user();
        $user = (object)[];
        if($userType == 'web'){
            $user = User::where('email',$socialiteUser->email)->first(); 
            if(!$user){
                $user = new User();
                $user->email = $socialiteUser->email;
                $user->save();
            }
        }elseif($userType == 'mentor'){
            $user = Mentor::where('email',$socialiteUser->email)->first();
            if(!$user){
                $user = new Mentor();
                $user->email = $socialiteUser->email;
                $mentor->status = 1;
                $mentor->is_verified = 0;
                $mentor->carrier_started = date('Y-m-d');
                $mentor->charge_per_hour = 40;
                $user->save();
            }
        }
        Auth::guard($userType)->login($user);
        if($userType == 'mentor'){
            return redirect(route('mentor.mentee.setting'));
        }
        return redirect(route('mentors.find'));
    }
}
