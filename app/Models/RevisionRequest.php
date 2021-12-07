<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read RevisionRequestCategory|null $revisionCategory
 * @property-read Collection|RevisionRequestComment[] $revisionComments
 * @property-read int|null $revision_comments_count
 * @property-read Collection|RevisionRequestDocument[] $revisionDocuments
 * @property-read int|null $revision_documents_count
 * @method static Builder|RevisionRequest newModelQuery()
 * @method static Builder|RevisionRequest newQuery()
 * @method static Builder|RevisionRequest query()
 * @method static Builder|RevisionRequest whereCategoryId($value)
 * @method static Builder|RevisionRequest whereCreatedAt($value)
 * @method static Builder|RevisionRequest whereFileId($value)
 * @method static Builder|RevisionRequest whereId($value)
 * @method static Builder|RevisionRequest whereName($value)
 * @method static Builder|RevisionRequest whereSubmitted($value)
 * @method static Builder|RevisionRequest whereTechnicianEmail($value)
 * @method static Builder|RevisionRequest whereTechnicianFirstName($value)
 * @method static Builder|RevisionRequest whereTechnicianLastName($value)
 * @method static Builder|RevisionRequest whereUpdatedAt($value)
 * @mixin Eloquent
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
        'submitted',
        'description'
    ];

    // Set default values for attributes.
    protected $attributes = [
        'submitted' => false
    ];

    /**
     * Get the revision category that this request has.
     * @return BelongsTo
     */
    public function file()
    {
        return $this->belongsTo(File::class, 'fileId');
    }

    /**
     * Get the revision category that this request has.
     * @return HasOne
     */
    public function revisionCategory()
    {
        // For some reason Laravel doesn't want to take categoryId.
        return $this->hasOne(RevisionRequestCategory::class, 'id', 'categoryId');
    }

    /**
     * Get the documents connected to this revision request.
     * @return HasMany
     */
    public function revisionDocuments()
    {
        return $this->hasMany(RevisionRequestDocument::class, 'revisionRequestId');
    }

    /**
     * Get the comments connected to this revision request.
     * @return HasMany
     */
    public function revisionComments()
    {
        return $this->hasMany(RevisionRequestComment::class, 'revisionRequestId');
    }
}
