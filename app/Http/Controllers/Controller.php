<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Auth;use App\Model\Referral;use DB;
use App\User;use Hash;use App\Model\UserPoint;
use App\Model\MasterReferral;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Zoom Api Generate Token
    public function generateToken()
    {
        $key = 'yXj_ljMrR9mBMXUnpoWEBw';
        $secret = '4ILce1QmfZgKwLjIIr4ljMuLIDGPeI2FGzOy';
        $payload = [
            'iss' => $key,
            'exp' => strtotime('+1 minute'),
        ];
        return \Firebase\JWT\JWT::encode($payload, $secret, 'HS256');
    }

    protected function setPageTitle($title, $subTitle)
    {
        view()->share(['pageTitle' => $title, 'subTitle' => $subTitle]);
    }

    // Referral system
    public function generateUniqueReferral()
    {
        $random = generateUniqueAlphaNumeric(8);
        $referral = Referral::where('code',$random)->first();
        if(!$referral){
            $referral = new Referral();
            $referral->code = strtoupper($random);
            $referral->save();
            return $referral;
        }
        return $this->generateUniqueReferral();
    }

    // public function checkReferral($code) {
    //     $ref = Referral::where('code', $code)->get();
    //     return $ref;
    // }
}
