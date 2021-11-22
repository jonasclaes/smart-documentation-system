<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Document
 *
 * @property int $id
 * @property string $fileName
 * @property string $path
 * @property int $size
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Revision[] $revisions
 * @property-read int|null $revisions_count
 * @method static Builder|Document newModelQuery()
 * @method static Builder|Document newQuery()
 * @method static Builder|Document query()
 * @method static Builder|Document whereCreatedAt($value)
 * @method static Builder|Document whereFileName($value)
 * @method static Builder|Document whereId($value)
 * @method static Builder|Document wherePath($value)
 * @method static Builder|Document whereSize($value)
 * @method static Builder|Document whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Document extends Model
{
    use HasFactory;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'fileName',
        'path',
        'size'
    ];

    public function revisions()
    {
        return $this->belongsToMany(Revision::class, 'revision_documents', 'documentId', 'revisionId');
    }
}
