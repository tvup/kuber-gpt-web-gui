<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $nick_name
 * @property string $local_ip
 * @property string $public_ip
 * @property array $applications
 * @property array $tags
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $user
 * @property CredentialsSet $credentialsSet
 */
class RunSet extends BaseModel
{
    use HasFactory;

    protected $casts = [
        'applications' => 'array',
        'tags' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, RunSet>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<CredentialsSet>
     */
    public function credentialsSet() : BelongsTo
    {
        return $this->belongsTo(CredentialsSet::class);
    }
}
