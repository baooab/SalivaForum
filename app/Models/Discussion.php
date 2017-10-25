<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    const TABLE = 'discussions';

    protected $table = self::TABLE;

    protected $fillable = [
        'title', 'slug', 'body', 'user_id', 'last_user_id',
    ];

    public static function findBySlug($slug)
    {
        return static::where('slug', $slug)->firstOrFail();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lastUser() {
        return $this->belongsTo(User::class, 'last_user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'discussion_category')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date);
    }
}
