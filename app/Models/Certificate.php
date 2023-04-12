<?php

namespace App\Models;

use App\Enums\StatoEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property StatoEnum $stato
 * @property Carbon $dt_scadenza
 * @property Carbon $dt_revoca
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
        'stato' => StatoEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('\App\Models\User');
    }
}
