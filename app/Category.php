<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public function discussions()
    {
        return $this->belongsToMany(Discussion::class, 'discussion_category')->withTimestamps();
    }
}
