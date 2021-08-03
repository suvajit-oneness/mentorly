<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    public function reshedule()
    {
    	return $this->belongsTo('App\Models\AvailableShift','reschduleslot','id');
    }

    public function existing_slot()
    {
    	return $this->belongsTo('App\Models\AvailableShift','existingSlotid','id');
    }
}
