<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StripeTransaction extends Model
{
    use SoftDeletes;

    public function slot()
    {
    	return $this->hasOne('App\Models\MentorSlotBooked','stripeTransactionId','id');
    }
}
