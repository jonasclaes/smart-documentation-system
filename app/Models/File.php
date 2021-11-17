<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\File
 *
 * @property int $id
 * @property string $fileId
 * @property string $name
 * @property string|null $enclosureId
 * @property string $uniqueId
 * @property int $clientId
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\QRCode|null $QRCode
 * @property-read \App\Models\Client $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RevisionRequest[] $revisionRequests
 * @property-read int|null $revision_requests_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Revision[] $revisions
 * @property-read int|null $revisions_count
 * @method static \Database\Factories\FileFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereEnclosureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUniqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uniqueId';
    }

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
