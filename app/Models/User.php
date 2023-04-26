<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Cashier\Billable;

/**
 * @property int $id
 * @property string $user_name
 * @property string $email
 * @property string $password
 * @property string $vat_number
 * @property string $name
 * @property string $surname
 * @property string $remember_token
 * @property UserRoleEnum $role
 * @property string $password_clear
 * @property string $company
 * @property string $locale
 * @property string $strippedUserName
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $approved_at
 * @property CredentialsSet[] $credentialsSet
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use Billable;

    protected $casts = [
        'role' => UserRoleEnum::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_name', 'email', 'password', 'vat_number', 'name', 'surname', 'role', 'password_clear', 'company', 'approved_at', 'allowed_a_is', 'a_is_running',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return HasMany<CredentialsSet>
     */
    public function credentialsSet(): HasMany
    {
        return $this->hasMany(CredentialsSet::class);
    }

    public function isAdmin(): bool
    {

        if ($this->role == UserRoleEnum::Admin) {
            return true;
        }

        return false;

    }

    public function isManager(): bool
    {

        if ($this->role == UserRoleEnum::Manager) {
            return true;
        }

        return false;

    }

}
