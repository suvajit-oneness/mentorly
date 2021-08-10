<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    public function job_details()
    {
        return $this->belongsTo('App\Model\Job','jobId','id');
    }
}
