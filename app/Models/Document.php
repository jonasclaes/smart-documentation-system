<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    public function revisions()
    {
        return $this->belongsToMany(Revision::class, 'revision_documents', 'documentId', 'revisionId');
    }
}
