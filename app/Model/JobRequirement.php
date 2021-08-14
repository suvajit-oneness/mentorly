<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobRequirement extends Model
{
    use SoftDeletes;

    public function job_details()
    {
        return $this->belongsTo('App\Model\Job','jobId','id')->withTrashed();
    }
}
