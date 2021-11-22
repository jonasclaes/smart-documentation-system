<?php

namespace App\Models;

use Database\Factories\RevisionFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Revision
 *
 * @property int $id
 * @property string $revisionNumber
 * @property int $fileId
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read Collection|Document[] $documents
 * @property-read int|null $documents_count
 * @property-read File $file
 * @method static RevisionFactory factory(...$parameters)
 * @method static Builder|Revision newModelQuery()
 * @method static Builder|Revision newQuery()
 * @method static Builder|Revision query()
 * @method static Builder|Revision whereCreatedAt($value)
 * @method static Builder|Revision whereFileId($value)
 * @method static Builder|Revision whereId($value)
 * @method static Builder|Revision whereRevisionNumber($value)
 * @method static Builder|Revision whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Revision extends Model
{
    use HasFactory;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'revisionNumber',
        'fileId'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'revisionNumber';
    }

    /**
     * Get the file that owns this revision.
     * @return BelongsTo
     */
    public function file() {
        return $this->belongsTo(File::class, 'fileId');
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'revision_documents', 'revisionId', 'documentId');
    }

    public function comments()
    {
        return $this->belongsToMany(Comment::class, 'revision_comments', 'revisionId', 'commentId');
    }
}
