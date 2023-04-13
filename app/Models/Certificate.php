<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property StatusEnum|null $status
 * @property Carbon|null $expires_at
 * @property Carbon|null $revoked_at
 * @property string $idcert
 * @property string $cert
 * @property User $user
 * @property array<int, string> $link_conf
 * @property string $strippedUserName;
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Certificate extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => StatusEnum::class,
        'link_conf' => 'array',
    ];

    /**
     * @return BelongsTo<User, Certificate>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStrippedUserNameAttribute(): string
    {
        return Str::afterLast($this->cert, '=');
    }
}
