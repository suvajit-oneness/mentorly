<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function get_guard(){
    	if(Auth::guard('admin')->check()){
    		return 'admin';
    	}elseif(Auth::guard('web')->check()){
    		return 'web';
    	}elseif(Auth::guard('mentor')->check()){
    		return 'mentor';
    	}else{
    		return '';
    	}
    }

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
}
