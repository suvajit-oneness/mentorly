<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

	protected $fillable = [
	   'title', 'description', 'image', 'slug', 'status', 'is_deleted'
	];

	protected static function boot(){
        parent::boot();

        static::created(function ($news) {
            $news->update(['slug' => $news->title]);
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
