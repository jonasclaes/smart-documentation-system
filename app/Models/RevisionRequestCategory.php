<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\RevisionRequestCategory
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|RevisionRequest[] $revisionRequests
 * @property-read int|null $revision_requests_count
 * @method static Builder|RevisionRequestCategory newModelQuery()
 * @method static Builder|RevisionRequestCategory newQuery()
 * @method static Builder|RevisionRequestCategory query()
 * @method static Builder|RevisionRequestCategory whereCreatedAt($value)
 * @method static Builder|RevisionRequestCategory whereId($value)
 * @method static Builder|RevisionRequestCategory whereName($value)
 * @method static Builder|RevisionRequestCategory whereUpdatedAt($value)
 * @mixin Eloquent
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
     * @return HasMany
     */
    public function revisionRequests()
    {
        return $this->hasMany(RevisionRequest::class, 'categoryId');
    }
}
