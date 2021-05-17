<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FrontendSetting extends Model
{
    use SoftDeletes;

    public static function get_data($key)
    {
    	$data = FrontendSetting::where('key',$key)->get();
    	return $data;
    }
}
