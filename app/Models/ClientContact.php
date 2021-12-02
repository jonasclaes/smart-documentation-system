<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientContact extends Model
{
    use HasFactory;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'clientId',
        'firstName',
        'lastName',
        'role',
        'email',
        'phoneNumber'
    ];

    /**
     * Get the client that owns the file.
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'clientId');
    }
}
