<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RevisionRequestDocument
 *
 * @property int $id
 * @property string $fileName
 * @property string $path
 * @property int $size
 * @property int $revisionRequestId
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestDocument whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestDocument wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestDocument whereRevisionRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestDocument whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequestDocument whereUpdatedAt($value)
 * @mixin \Eloquent
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
