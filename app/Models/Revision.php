<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Revision
 *
 * @property int $id
 * @property string $revisionNumber
 * @property int $fileId
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Document[] $documents
 * @property-read int|null $documents_count
 * @property-read \App\Models\File $file
 * @method static \Database\Factories\RevisionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Revision newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Revision newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Revision query()
 * @method static \Illuminate\Database\Eloquent\Builder|Revision whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revision whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revision whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revision whereRevisionNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revision whereUpdatedAt($value)
 * @mixin \Eloquent
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
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
