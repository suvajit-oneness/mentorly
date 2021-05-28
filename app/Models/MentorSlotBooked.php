<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MentorSlotBooked extends Model
{
    use SoftDeletes;

    public function slot_details()
    {
    	return $this->belongsTo('App\Models\AvailableShift','availableShiftId','id');
    }

    public function mentor()
    {
    	return $this->belongsTo('App\Models\Mentor','mentorId','id');
    }

    public function transaction_detail()
    {
    	return $this->belongsTo('App\Models\StripeTransaction','stripeTransactionId','id');
    }
    public function users(){
        return $this->belongsTo(User::class, 'bookedUserId');
    }
}
