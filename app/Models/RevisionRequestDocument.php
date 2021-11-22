<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\RevisionRequestDocument
 *
 * @property int $id
 * @property string $fileName
 * @property string $path
 * @property int $size
 * @property int $revisionRequestId
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|RevisionRequestDocument newModelQuery()
 * @method static Builder|RevisionRequestDocument newQuery()
 * @method static Builder|RevisionRequestDocument query()
 * @method static Builder|RevisionRequestDocument whereCreatedAt($value)
 * @method static Builder|RevisionRequestDocument whereFileName($value)
 * @method static Builder|RevisionRequestDocument whereId($value)
 * @method static Builder|RevisionRequestDocument wherePath($value)
 * @method static Builder|RevisionRequestDocument whereRevisionRequestId($value)
 * @method static Builder|RevisionRequestDocument whereSize($value)
 * @method static Builder|RevisionRequestDocument whereUpdatedAt($value)
 * @mixin Eloquent
 */
class RevisionRequestDocument extends Model
{
    use HasFactory;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'fileName',
        'path',
        'size',
        'revisionRequestId'
    ];
}
