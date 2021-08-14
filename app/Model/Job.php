<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    public function requirement()
    {
        return $this->hasMany('App\Model\JobRequirement','jobId','id')->withTrashed();
    }

    public function type()
    {
        return $this->belongsTo('App\Model\JobType','jobTypeId','id')->withTrashed();
    }
}
