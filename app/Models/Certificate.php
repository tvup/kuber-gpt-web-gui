<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property StatusEnum $status
 * @property Carbon $expires_at
 * @property Carbon $revoked_at
 * @property string $idcert
 * @property string $cert
 * @property User $user
 * @property string $link_conf
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Certificate extends Model
{
    protected $casts = [
        'status' => StatusEnum::class,
        'link_conf' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('\App\Models\User');
    }
}
