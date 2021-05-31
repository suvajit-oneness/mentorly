<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageLog extends Model
{
    use SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class, 'message_from','id');
    }

    public function mentor(){
        return $this->belongsTo(Mentor::class, 'message_to', 'id');
    }
}
