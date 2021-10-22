<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use HasFactory;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'revisionNumber',
        'fileId'
    ];
    
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
