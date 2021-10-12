<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisionRequest extends Model
{
    use HasFactory;

    /**
     * Get the revision category that this request has.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function revisionCategory()
    {
        return $this->hasOne(RevisionRequestCategory::class, 'categoryId');
    }

    /**
     * Get the documents connected to this revision request.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function revisionDocuments()
    {
        return $this->hasMany(RevisionRequestDocument::class, 'revisionRequestId');
    }

    /**
     * Get the comments connected to this revision request.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function revisionComments()
    {
        return $this->hasMany(RevisionRequestComment::class, 'revisionRequestId');
    }
}
