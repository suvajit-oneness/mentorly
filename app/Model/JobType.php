<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobType extends Model
{
    use SoftDeletes;

    public function job_details()
    {
        return $this->hasMany('App\Model\Job','jobTypeId','id');
    }
}
