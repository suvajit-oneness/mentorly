<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZoomMeeting extends Model
{
    use SoftDeletes;

    public function mentor()
    {
    	return $this->belongsTo('App\Models\Mentor','mentorId','id');
    }
}
