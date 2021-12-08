<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\RevisionRequestComment
 *
 * @property int $id
 * @property string $content
 * @property int $revisionRequestId
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|RevisionRequestComment newModelQuery()
 * @method static Builder|RevisionRequestComment newQuery()
 * @method static Builder|RevisionRequestComment query()
 * @method static Builder|RevisionRequestComment whereContent($value)
 * @method static Builder|RevisionRequestComment whereCreatedAt($value)
 * @method static Builder|RevisionRequestComment whereId($value)
 * @method static Builder|RevisionRequestComment whereRevisionRequestId($value)
 * @method static Builder|RevisionRequestComment whereUpdatedAt($value)
 * @mixin Eloquent
 */
class RevisionRequestComment extends Model
{
    use HasFactory;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'content',
        'revisionRequestId'
    ];

    public function revisionRequest()
    {
        return $this->belongsTo(RevisionRequest::class, 'revisionRequestId');
    }
}
