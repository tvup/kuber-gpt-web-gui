<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use App\Enums\VPNTypeEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

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
 * @property VPNTypeEnum $vpn_type
 * @property string $locale
 * @property string $strippedUserName
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Certificate[] $certificates
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $casts = [
        'role' => UserRoleEnum::class,
        'vpn_type' => VPNTypeEnum::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'email', 'password', 'vat_number', 'name', 'surname', 'role', 'password_clear', 'company', 'vpn_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function certificates(): HasMany
    {
        return $this->hasMany('\App\Models\Certificate');
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

    public function getStrippedUserNameAttribute(): string
    {
        return Str::remove(PHP_EOL, Str::afterLast($this->user_name, '='));
    }
}
