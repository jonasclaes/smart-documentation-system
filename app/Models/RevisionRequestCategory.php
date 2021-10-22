<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisionRequestCategory extends Model
{
    use HasFactory;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'name'
    ];

    /**
     * Get all the revision requests with this category.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function revisionRequests()
    {
        return $this->hasMany(RevisionRequest::class, 'categoryId');
    }
}
