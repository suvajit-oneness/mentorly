<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model
{
    use SoftDeletes;
    
    public function job_details()
    {
        return $this->belongsTo('App\Model\Job','jobId','id');
    }
}
