<?php

namespace App\Models;

use App\Enums\CredentialTypeEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property CredentialTypeEnum|null $credentialTypeEnum
 * @property string|null $name
 * @property string|null $key
 * @property string|null $value
 * @property CredentialsSet $credentialsSets
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Credential extends BaseModel
{
    use HasFactory;

    protected $casts = [
        '$credentialType' => CredentialTypeEnum::class,
    ];

    /**
     * @return BelongsTo<CredentialsSet, Credential>
     */
    public function credentialsSet(): BelongsTo
    {
        return $this->belongsTo(CredentialsSet::class);
    }
}
