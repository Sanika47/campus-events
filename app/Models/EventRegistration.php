<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $fillable = [
        'user_id',
        'event_id'
    ];
//Registration belongs to event
public function event()
{
    return $this->belongsTo(Event::class);
}
//Registration belong to user
public function user()
{
    return $this->belongsTo(User::class);
}
}

