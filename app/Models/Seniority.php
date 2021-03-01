<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seniority extends Model
{
    protected $table = 'seniorities';

	protected $fillable = [
	   'title', 'status', 'is_deleted'
	];
}
