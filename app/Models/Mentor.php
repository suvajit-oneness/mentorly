<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Mentor extends Model
{
    protected $table = 'mentors';

	protected $fillable = [
	   'name', 'mobile', 'email', 'otp', 'password', 'designation', 'image', 'about', 'country', 'city', 'address', 'industry_id', 'seniority_id', 'slug', 'is_verified', 'status', 'is_deleted'
	];

	//hasOne relation with Industry Model
	public function industry(){
	    return $this->hasOne(Industry::class, 'id', 'industry_id');
	}

	//hasOne relation with Seniority Model
	public function seniority(){
	    return $this->hasOne(Seniority::class, 'id', 'seniority_id');
	}

	protected static function boot(){
        parent::boot();

        static::created(function ($mentor) {
            $mentor->update(['slug' => $mentor->title]);
        });
    }

    public function setSlugAttribute($value)
    {
        if (static::whereSlug($slug = str_slug($value))->exists()) {
            $slug = $this->incrementSlug($slug);
        }
        $this->attributes['slug'] = $slug;
    }

    public function incrementSlug($slug)
    {
        // get the slug of the latest created post
        $max = static::whereTitle($this->title)->latest('id')->skip(1)->value('slug');
        if (is_numeric($max[-1])) {
            return preg_replace_callback('/(\d+)$/', function ($mathces) {
                return $mathces[1] + 1;
            }, $max);
        }

        return "{$slug}-2";
    }
}
