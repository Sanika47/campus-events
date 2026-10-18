<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable=[
        'title',
        'description',
        'category_id',
        'venue',
        'event_date',
        'start_time',
        'end_time',
        'organizer',
        'max_capacity',
        'status'
    ];
    //Event belongs to one Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //Event has many registrations
    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
