<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
    use SoftDeletes;

    public function messages()
    {
        return $this->hasMany('App\Models\Message', 'conversation_id', 'id');
    }
    public function last_message()
    {
        return $this->hasOne('App\Models\Message', 'conversation_id', 'id')->latest();
    }
}
