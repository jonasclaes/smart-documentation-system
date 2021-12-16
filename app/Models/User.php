<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $firstName
 * @property string $lastName
 * @property string $username
 * @property string $email
 * @property string|null $phoneNumber
 * @property string $password
 * @property int $active
 * @property int $rights
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereActive($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereFirstName($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLastName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhoneNumber($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRights($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereUsername($value)
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'firstName',
        'lastName',
        'username',
        'email',
        'phoneNumber',
        'password',
        'active',
    ];

    // Hide the following properties.
    protected $hidden = [
        'password',
        'remember_token'
    ];

    // Set default values for attributes.
    protected $attributes = [
        'active' => false,
    ];

    /**
     * Get the user full name
     *
     * @return string
     */
    public function name(): string
    {
        if ($this->firstName === "") {
            return $this->lastName;
        }

        if ($this->lastName === "") {
            return $this->firstName;
        }

        return "{$this->lastName}, {$this->firstName}";
    }

    /**
     * Get the user full name
     *
     * @return string
     */
    public function fullName(): string
    {
        return $this->name();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * Get the UserPermissions belonging to the User.
     * @return HasMany
     */
    public function permissions()
    {
        return $this->hasMany(UserPermission::class, 'userId');
    }
}
