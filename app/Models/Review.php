<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

	protected $fillable = [
	   'review', 'mentor_id', 'user_id', 'status', 'is_deleted'
	];

	//hasOne relation with User Model
	public function user(){
	    return $this->hasOne(User::class, 'id', 'user_id');
	}

	//hasOne relation with Mentor Model
	public function mentor(){
	    return $this->hasOne(Mentor::class, 'id', 'mentor_id');
	}
}
