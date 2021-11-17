<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RevisionRequest
 *
 * @property int $id
 * @property string $name
 * @property string|null $technicianFirstName
 * @property string|null $technicianLastName
 * @property string|null $technicianEmail
 * @property int $submitted
 * @property int $fileId
 * @property int $categoryId
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RevisionRequestCategory|null $revisionCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RevisionRequestComment[] $revisionComments
 * @property-read int|null $revision_comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RevisionRequestDocument[] $revisionDocuments
 * @property-read int|null $revision_documents_count
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequest whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequest whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequest whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequest whereSubmitted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequest whereTechnicianEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequest whereTechnicianFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequest whereTechnicianLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionRequest whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RevisionRequest extends Model
{
    use HasFactory;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'name',
        'technicianFirstName',
        'technicianLastName',
        'technicianEmail',
        'fileId',
        'categoryId',
        'submitted'
    ];

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
