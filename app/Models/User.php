<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'firstName',
        'lastName',
        'username',
        'email',
        'phoneNumber',
        'password',
        'active',
        'rights'
    ];

    // Hide the following properties.
    protected $hidden = [
        'password',
        'remember_token'
    ];

    // Set default values for attributes.
    protected $attributes = [
        'active' => false,
        'rights' => 0
    ];
}
