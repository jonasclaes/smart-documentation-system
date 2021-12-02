<?php

namespace App\Models;

use Database\Factories\ClientFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Client
 *
 * @property int $id
 * @property string $clientNumber
 * @property string $name
 * @property string|null $contactEmail
 * @property string|null $contactPhoneNumber
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|File[] $files
 * @property-read int|null $files_count
 * @method static ClientFactory factory(...$parameters)
 * @method static Builder|Client newModelQuery()
 * @method static Builder|Client newQuery()
 * @method static Builder|Client query()
 * @method static Builder|Client whereClientNumber($value)
 * @method static Builder|Client whereContactEmail($value)
 * @method static Builder|Client whereContactPhoneNumber($value)
 * @method static Builder|Client whereCreatedAt($value)
 * @method static Builder|Client whereId($value)
 * @method static Builder|Client whereName($value)
 * @method static Builder|Client whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Client extends Model
{
    use HasFactory;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'clientNumber',
        'name',
        'contactEmail',
        'contactPhoneNumber',
    ];

    /**
     * Get the files that the client owns.
     * @return HasMany
     */
    public function contacts()
    {
        return $this->hasMany(ClientContact::class, 'clientId');
    }

    /**
     * Get the files that the client owns.
     * @return HasMany
     */
    public function files()
    {
        return $this->hasMany(File::class, 'clientId');
    }
}
