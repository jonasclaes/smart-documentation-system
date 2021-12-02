<?php

namespace App\Models;

use Database\Factories\FileFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\File
 *
 * @property int $id
 * @property string $fileId
 * @property string $name
 * @property string|null $enclosureId
 * @property string $uniqueId
 * @property int $clientId
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read QRCode|null $QRCode
 * @property-read Client $client
 * @property-read Collection|RevisionRequest[] $revisionRequests
 * @property-read int|null $revision_requests_count
 * @property-read Collection|Revision[] $revisions
 * @property-read int|null $revisions_count
 * @method static FileFactory factory(...$parameters)
 * @method static Builder|File newModelQuery()
 * @method static Builder|File newQuery()
 * @method static Builder|File query()
 * @method static Builder|File whereClientId($value)
 * @method static Builder|File whereCreatedAt($value)
 * @method static Builder|File whereEnclosureId($value)
 * @method static Builder|File whereFileId($value)
 * @method static Builder|File whereId($value)
 * @method static Builder|File whereName($value)
 * @method static Builder|File whereUniqueId($value)
 * @method static Builder|File whereUpdatedAt($value)
 * @mixin Eloquent
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
        return 'id';
    }

    /**
     * Get the client that owns the file.
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'clientId');
    }

    /**
     * Get the revisions belonging to the file.
     * @return HasMany
     */
    public function revisions()
    {
        return $this->hasMany(Revision::class, 'fileId');
    }

    /**
     * Get the revisions requests belonging to the file.
     * @return HasMany
     */
    public function revisionRequests()
    {
        return $this->hasMany(RevisionRequest::class, 'fileId');
    }

    /**
     * Get the QR-code belonging to the file.
     * @return HasOne
     */
    public function QRCode()
    {
        return $this->hasOne(QRCode::class, 'fileId');
    }
}
