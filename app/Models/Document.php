<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
