<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'fileId',
        'name',
        'enclosureId',
        'uniqueId',
        'clientId'
    ];

    /**
     * Get the client that owns the file.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'clientId');
    }

    /**
     * Get the revisions belonging to the file.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function revisions()
    {
        return $this->hasMany(Revision::class, 'fileId');
    }

    /**
     * Get the revisions requests belonging to the file.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function revisionRequests()
    {
        return $this->hasMany(RevisionRequest::class, 'fileId');
    }

    /**
     * Get the QR-code belonging to the file.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function QRCode()
    {
        return $this->hasOne(QRCode::class, 'fileId');
    }
}
