<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RevisionRequestComment
 *
 * @property int $id
 * @property string $content
 * @property int $revisionRequestId
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestComment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestComment whereRevisionRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestComment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RevisionRequestComment extends Model
{
    use HasFactory;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'content',
        'revisionRequestId'
    ];
}
