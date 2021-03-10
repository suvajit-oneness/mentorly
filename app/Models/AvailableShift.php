<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AvailableShift extends Model
{
    use SoftDeletes;

    public function day()
    {
    	return $this->belongsTo('App\Models\AvailableDay','available_days_id','id');
    }
}
