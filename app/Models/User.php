<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $vat_number
 * @property string $name
 * @property string $remember_token
 * @property string $password_clear
 * @property string $company
 * @property string $locale
 * @property string $strippedUserName
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $approved_at
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'vat_number', 'role', 'password_clear', 'company', 'approved_at', 'allowed_a_is', 'a_is_running', 'locale',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
