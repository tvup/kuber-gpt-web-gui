<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'nome', 'cognome', 'cf', 'rule', 'password_clear', 'societa', 'tipo_vpn',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function certificati()
    {
        return $this->hasMany('\App\Certificato');
    }

    public function isAdmin()
    {

        if ($this->rule == 'admin') {
            return true;
        }

        return false;

    }

    public function isManagerRO()
    {

        if ($this->rule == 'manager_ro') {
            return true;
        }

        return false;

    }
}
