<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RevisionRequestCategory
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RevisionRequest[] $revisionRequests
 * @property-read int|null $revision_requests_count
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RevisionRequestCategory extends Model
{
    use HasFactory;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'name'
    ];

    /**
     * Get all the revision requests with this category.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function revisionRequests()
    {
        return $this->hasMany(RevisionRequest::class, 'categoryId');
    }
}
