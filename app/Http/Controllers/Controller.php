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
}
