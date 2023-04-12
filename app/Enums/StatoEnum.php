<?php

namespace App\Enums;

enum StatoEnum: string
{
     case V = 'valid';
     case R = 'revoked';
     case E = 'expired';
}
