<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nick_name
 * @property string $local_ip
 * @property string $public_ip
 * @property array $applications
 * @property array $tags
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method static create(array $array)
 */
class ServerAsset extends BaseModel
{
    use HasFactory;

    protected $casts = [
        'applications' => 'array',
        'tags' => 'array',
    ];
}
