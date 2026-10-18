<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        Notifiable;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * Hidden fields
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * Cast attributes
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed'
        ];
    }

    /**
     * User belongs to a role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * User event registrations
     */
    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
