<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'clientNumber',
        'name',
        'contactEmail',
        'contactPhoneNumber',
    ];

    /**
     * Get the files that the client owns.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(File::class, 'clientId');
    }
}
