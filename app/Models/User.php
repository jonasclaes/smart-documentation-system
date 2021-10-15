<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'firstName',
        'lastName',
        'username',
        'email',
        'password'
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
