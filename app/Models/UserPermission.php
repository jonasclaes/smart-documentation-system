<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserPermission extends Model
{
    use HasFactory;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'userId',
        'permissionName'
    ];

    /**
     * Get the User belonging to the UserPermission.
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'userId');
    }
}
