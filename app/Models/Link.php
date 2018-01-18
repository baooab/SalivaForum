<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }
}
