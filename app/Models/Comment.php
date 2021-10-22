<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'content'
    ];

    public function revisions()
    {
        return $this->belongsToMany(Revision::class, 'revision_comments', 'commentId', 'revisionId');
    }
}
