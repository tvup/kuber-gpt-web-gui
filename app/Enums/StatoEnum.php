<?php

namespace App\Enums;

enum StatoEnum: string
{
     case V = 'valid';
     case R = 'revoked';
     case E = 'expired';

     public static function to($string) {
         if (StatoEnum::V->name == $string) {
             return StatoEnum::V;
         } elseif (StatoEnum::R->name == $string) {
             return StatoEnum::R;
         } elseif (StatoEnum::E->name == $string) {
             return StatoEnum::E;
         }
     }
}
