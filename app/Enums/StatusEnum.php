<?php

namespace App\Enums;

enum StatusEnum: string
{
     case V = 'valid';
     case R = 'revoked';
     case E = 'expired';

     public static function to($string)
     {
         if (StatusEnum::V->name == $string) {
             return StatusEnum::V;
         } elseif (StatusEnum::R->name == $string) {
             return StatusEnum::R;
         } elseif (StatusEnum::E->name == $string) {
             return StatusEnum::E;
         }
     }
}
