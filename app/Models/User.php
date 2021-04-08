<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
	use SoftDeletes;
    protected $table = 'users';

	protected $fillable = [
	   'name', 'mobile', 'email', 'otp', 'country', 'city', 'address', 'is_verified', 'status', 'is_deleted'
	];
}
