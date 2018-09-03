<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificato extends Model
{
    //
    protected $table = 'certificati';

    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}
